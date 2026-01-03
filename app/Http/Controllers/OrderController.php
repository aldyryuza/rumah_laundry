<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\User;
use App\LaundryType;
use App\LaundryPackage;
use Carbon\Carbon;
use DB;

class OrderController extends Controller
{
    public function index()
    {
        $data = Order::with(['user', 'laundryType', 'laundryPackage'])->get();

        // jika user adalah pelanggan, tampilkan hanya order miliknya
        if (auth()->user()->role == 'pelanggan') {
            $data = $data->where('user_id', auth()->user()->id);
        }

        $users = User::where('role', 'pelanggan')->get();
        $types = LaundryType::all();
        $packages = LaundryPackage::all();

        return view('web.orders.index', compact(
            'data',
            'users',
            'types',
            'packages'
        ));
    }


    public function create()
    {
        $customers = User::where('role', 'pelanggan')->get();
        $types     = LaundryType::all();
        $packages  = LaundryPackage::all();

        return view('web.orders.create', compact(
            'customers',
            'types',
            'packages'
        ));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $type = LaundryType::findOrFail($request->laundry_type_id);
            $pkg  = LaundryPackage::findOrFail($request->laundry_package_id);
            // hitung subtotal
            if ($type->is_weight_based) {
                $subtotal = $request->weight * $pkg->price_per_kg;
            } else {
                $subtotal = $request->qty * $pkg->price_per_pcs;
            }

            // generate no order
            $noOrder = $this->generateOrderNumber($type->code);

            Order::create([
                'no_order'            => $noOrder,
                'user_id'             => $request->user_id,
                'laundry_type_id'     => $request->laundry_type_id,
                'laundry_package_id'  => $request->laundry_package_id,
                'weight'              => $request->weight,
                'qty'                 => $request->qty,
                'date_in'             => Carbon::now()->toDateString(),
                'date_out'            => Carbon::now()->addDays($pkg->duration_day),
                'status'              => 'antrian',
                'notes'               => $request->notes,
                'subtotal'            => $subtotal,
            ]);

            DB::commit();
            return redirect()->route('orders.index')
                ->with('success', 'Order berhasil dibuat');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors($e->getMessage());
        }
    }

    private function generateOrderNumber($code)
    {
        $date = date('dmY');

        $last = Order::where('created_at', '>=', date('Y-m-d') . ' 00:00:00')
            ->where('created_at', '<=', date('Y-m-d') . ' 23:59:59')
            ->where('no_order', 'like', $code . '-' . $date . '-%')
            ->count() + 1;

        return $code . '-' . $date . '-' . str_pad($last, 4, '0', STR_PAD_LEFT);
    }


    public function show($id)
    {
        $data = Order::with([
            'user',
            'laundryType',
            'laundryPackage',
            'payments',
            'invoice'
        ])->findOrFail($id);

        return view('web.orders.show', compact('data'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $order->status = $request->status;

        // logic otomatis
        if ($request->status == 'selesai_dikerjakan') {
            // contoh: auto set tanggal selesai
            $order->finished_at = date('Y-m-d H:i:s');
        }

        // kalau sudah lunas
        if ($request->status == 'selesai') {
            $order->paid_at = date('Y-m-d H:i:s');
        }

        $order->save();

        return back()->with('success', 'Status order berhasil diupdate');
    }
}
