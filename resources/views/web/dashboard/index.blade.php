@extends('web.template.main')
@php $title = 'Dashboard'; @endphp

@section('content')
    <div class="row">

        {{-- ORDER HARI INI --}}
        <div class="col-md-3">
            <div class="info-box bg-info">
                <span class="info-box-icon"><i class="fas fa-box"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Order Hari Ini</span>
                    <span class="info-box-number">{{ $totalOrderToday }}</span>
                </div>
            </div>
        </div>

        {{-- ORDER PROSES --}}
        <div class="col-md-3">
            <div class="info-box bg-warning">
                <span class="info-box-icon"><i class="fas fa-sync"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Dalam Proses</span>
                    <span class="info-box-number">{{ $orderProcess }}</span>
                </div>
            </div>
        </div>

        {{-- SIAP DIAMBIL --}}
        <div class="col-md-3">
            <div class="info-box bg-primary">
                <span class="info-box-icon"><i class="fas fa-check"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Siap Diambil</span>
                    <span class="info-box-number">{{ $orderFinished }}</span>
                </div>
            </div>
        </div>

        {{-- PEMBAYARAN HARI INI --}}
        <div class="col-md-3">
            <div class="info-box bg-success">
                <span class="info-box-icon"><i class="fas fa-money-bill"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Pembayaran Hari Ini</span>
                    <span class="info-box-number">
                        Rp {{ number_format($paymentToday, 0, ',', '.') }}
                    </span>
                </div>
            </div>
        </div>

    </div>

    <div class="row">

        {{-- INVOICE BELUM LUNAS --}}
        <div class="col-md-6">
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title">Invoice Belum Lunas</h3>
                </div>
                <div class="card-body">
                    <h3>{{ $invoiceUnpaid }} Invoice</h3>
                    <a href="{{ route('reports.invoices', ['status' => 'belum_lunas']) }}" class="btn btn-light btn-sm">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>

        {{-- ORDER MENUNGGU PEMBAYARAN --}}
        <div class="col-md-6">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Order Menunggu Pembayaran</h3>
                </div>
                <div class="card-body">
                    <h3>{{ $orderUnpaid }} Order</h3>
                    <a href="{{ route('reports.orders', ['status' => 'menunggu_pembayaran']) }}"
                        class="btn btn-light btn-sm">
                        Lihat Order
                    </a>
                </div>
            </div>
        </div>

    </div>

    <div class="row">

        {{-- GRAFIK STATUS ORDER --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Order Berdasarkan Status</h3>
                </div>
                <div class="card-body">
                    <canvas id="orderStatusChart"></canvas>
                </div>
            </div>
        </div>

        {{-- GRAFIK INCOME --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Income Bulanan</h3>
                </div>
                <div class="card-body">
                    <canvas id="incomeChart"></canvas>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        /* ===== ORDER STATUS CHART ===== */
        var orderStatusCtx = document.getElementById('orderStatusChart').getContext('2d');

        new Chart(orderStatusCtx, {
            type: 'pie',
            data: {
                labels: {!! json_encode($orderStatusChart->pluck('status')) !!},
                datasets: [{
                    data: {!! json_encode($orderStatusChart->pluck('total')) !!},
                    backgroundColor: [
                        '#17a2b8',
                        '#ffc107',
                        '#28a745',
                        '#dc3545'
                    ]
                }]
            }
        });

        /* ===== INCOME CHART ===== */
        var incomeCtx = document.getElementById('incomeChart').getContext('2d');

        new Chart(incomeCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($incomeChart->pluck('month')) !!},
                datasets: [{
                    label: 'Total Income',
                    data: {!! json_encode($incomeChart->pluck('total')) !!},
                    backgroundColor: '#28a745'
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
@endsection
