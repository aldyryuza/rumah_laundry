<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Payment;
use App\Invoice;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == "pelanggan") {
            return redirect('/orders');
        }

        $today = Carbon::today();

        // ORDER
        $totalOrderToday = Order::where('created_at', '>=', $today)
            ->where('created_at', '<=', $today->copy()->endOfDay())
            ->count();
        $orderProcess = Order::whereIn('status', [
            'dalam_antrian',
            'dikerjakan'
        ])->count();

        $orderFinished = Order::where('status', 'selesai_dikerjakan')->count();

        // PAYMENT
        $paymentToday = Payment::where('payment_date', '>=', $today)
            ->where('payment_date', '<=', $today->copy()->endOfDay())
            ->where('status', 'paid')
            ->sum('amount');

        // INVOICE
        $invoiceUnpaid = Invoice::where('remaining_amount', '>', 0)->count();

        // ORDER BELUM LUNAS
        $orderUnpaid = Order::whereIn('status', [
            'menunggu_pembayaran'
        ])->count();

        // ===== GRAFIK ORDER STATUS =====
        $orderStatusChart = Order::select(
            'status',
            DB::raw('COUNT(*) as total')
        )
            ->groupBy('status')
            ->get();

        // ===== GRAFIK INCOME BULANAN =====
        $incomeChart = Payment::select(
            DB::raw('MONTH(payment_date) as month'),
            DB::raw('SUM(amount) as total')
        )
            ->where('status', 'paid')
            ->whereRaw('YEAR(payment_date) = ?', [date('Y')])
            ->groupBy(DB::raw('MONTH(payment_date)'))
            ->orderBy('month')
            ->get();


        return view('web.dashboard.index', compact(
            'totalOrderToday',
            'orderProcess',
            'orderFinished',
            'paymentToday',
            'invoiceUnpaid',
            'orderUnpaid',
            'orderStatusChart',
            'incomeChart'
        ));
    }
}
