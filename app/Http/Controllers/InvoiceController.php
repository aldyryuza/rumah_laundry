<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Invoice;
use DB;
use Carbon\Carbon;

class InvoiceController extends Controller
{
    public function generate($orderId)
    {
        $order = Order::with('payments')->findOrFail($orderId);

        if ($order->payments->count() == 0) {
            return back()->with('error', 'Belum ada pembayaran');
        }
        // jika invoice sudah ada
        if ($order->invoice) {
            return redirect()->route('invoices.show', $orderId);
        }

        DB::beginTransaction();
        try {

            $paid = $order->payments->sum('amount');

            Invoice::create([
                'order_id'         => $order->id,
                'invoice_number'   => $this->generateInvoiceNumber(),
                'invoice_date'     => Carbon::now()->toDateString(),
                'total_amount'     => $order->subtotal,
                'paid_amount'      => $paid,
                'remaining_amount' => $order->subtotal - $paid,
            ]);

            DB::commit();
            return redirect()->route('invoices.show', $orderId);
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors($e->getMessage());
        }
    }

    public function show($orderId)
    {
        $order = Order::with([
            'user',
            'laundryType',
            'laundryPackage',
            'payments',
            'invoice'
        ])->findOrFail($orderId);

        if (!$order->invoice) {
            return redirect()
                ->route('orders.show', $orderId)
                ->with('error', 'Invoice belum dibuat');
        }

        return view('web.invoices.show', compact('order'));
    }

    private function generateInvoiceNumber()
    {
        $date = date('Ym');
        $count = Invoice::where('created_at', '>=', date('Y-m-d') . ' 00:00:00')
            ->where('created_at', '<=', date('Y-m-d') . ' 23:59:59')
            ->count() + 1;

        // contoh: INV-202006-0001

        return 'INV-' . $date . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
    }
}
