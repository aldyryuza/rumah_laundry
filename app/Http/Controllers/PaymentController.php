<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Payment;
use DB;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function create($orderId)
    {
        $order = Order::with('payments')->findOrFail($orderId);

        if (!in_array($order->status, ['selesai_dikerjakan', 'menunggu_pembayaran'])) {
            abort(403, 'Order belum selesai dikerjakan');
        }

        return view('web.payments.create', compact('order'));
    }

    public function store(Request $request, $orderId)
    {
        $order = Order::with('payments')->findOrFail($orderId);

        $this->validate($request, [
            'amount' => 'required|numeric|min:1',
            'method' => 'required'
        ]);

        DB::beginTransaction();
        try {

            Payment::create([
                'order_id'     => $order->id,
                'payment_date' => Carbon::now(),
                'amount'       => $request->amount,
                'method'       => $request->method,
                'status'       => 'paid'
            ]);

            $totalPaid = $order->payments->sum('amount') + $request->amount;

            // update status order
            if ($totalPaid >= $order->subtotal) {
                $order->status = 'selesai';
            } else {
                $order->status = 'menunggu_pembayaran';
            }

            $order->save();

            // UPDATE INVOICE JIKA ADA
            if ($order->invoice) {
                $order->invoice->update([
                    'paid_amount'      => $totalPaid,
                    'remaining_amount' => $order->subtotal - $totalPaid
                ]);
            }

            DB::commit();
            return redirect()
                ->route('orders.show', $order->id)
                ->with('success', 'Pembayaran berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors($e->getMessage());
        }
    }
}
