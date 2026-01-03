<?php

namespace App\Http\Controllers;

use App\Order;
use App\Payment;
use App\Invoice;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function orders(Request $request)
    {
        $query = Order::with('user');

        // filter tanggal
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('date_in', [
                $request->start_date,
                $request->end_date
            ]);
        }

        // filter status
        if ($request->status && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        $orders = $query->orderBy('date_in', 'desc')->get();

        $totalOrder = $orders->count();
        $totalRevenue = $orders->sum('subtotal');

        return view('web.reports.orders', compact(
            'orders',
            'totalOrder',
            'totalRevenue'
        ));
    }



    public function payments(Request $request)
    {
        $query = Payment::with([
            'order.user'
        ]);

        // filter tanggal
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('payment_date', [
                $request->start_date,
                $request->end_date
            ]);
        }

        // filter metode pembayaran
        if ($request->method && $request->method != 'all') {
            $query->where('method', $request->method);
        }

        // // filter status pembayaran
        // if ($request->status && $request->status != 'all') {
        //     $query->where('status', $request->status);
        // }

        $payments = $query->orderBy('payment_date', 'desc')->get();

        $totalPaid = $payments->sum('amount');

        return view('web.reports.payments', compact(
            'payments',
            'totalPaid'
        ));
    }



    public function invoices(Request $request)
    {
        $query = Invoice::with('order.user');

        // filter tanggal invoice
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('invoice_date', [
                $request->start_date,
                $request->end_date
            ]);
        }

        // filter status invoice
        if ($request->status && $request->status != 'all') {
            if ($request->status == 'lunas') {
                $query->where('remaining_amount', 0);
            } else {
                $query->where('remaining_amount', '>', 0);
            }
        }

        $invoices = $query->orderBy('invoice_date', 'desc')->get();

        $totalInvoice = $invoices->count();
        $totalTagihan = $invoices->sum('total_amount');
        $totalTerbayar = $invoices->sum('paid_amount');
        $totalSisa = $invoices->sum('remaining_amount');

        return view('web.reports.invoices', compact(
            'invoices',
            'totalInvoice',
            'totalTagihan',
            'totalTerbayar',
            'totalSisa'
        ));
    }
}
