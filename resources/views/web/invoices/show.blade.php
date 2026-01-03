@extends('web.template.main')
@php $title = 'Invoice'; @endphp

@section('content')
    <div class="card">

        <div class="card-header">
            <h3 class="card-title">INVOICE</h3>
            <button onclick="window.print()" class="btn btn-sm btn-secondary float-right">
                Print
            </button>
        </div>

        <div class="card-body">

            {{-- HEADER --}}
            <div class="row">
                <div class="col-md-6">
                    <h4>Rumah Laundry</h4>
                    <p>
                        Jl. Contoh Alamat<br>
                        Telp: 08xxxxxxxx
                    </p>
                </div>
                <div class="col-md-6 text-right">
                    <strong>No Invoice:</strong> {{ $order->invoice->invoice_number }}<br>
                    <strong>Tanggal:</strong> {{ $order->invoice->invoice_date }}
                </div>
            </div>

            <hr>

            {{-- CUSTOMER --}}
            <div class="row">
                <div class="col-md-6">
                    <strong>Pelanggan:</strong><br>
                    {{ $order->user->name }}<br>
                    {{ $order->user->phone }}<br>
                    {{ $order->user->address }}
                </div>
                <div class="col-md-6">
                    <strong>No Order:</strong> {{ $order->no_order }}<br>
                    <strong>Status:</strong> {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                </div>
            </div>

            <hr>

            {{-- DETAIL --}}
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Deskripsi</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            {{ $order->laundryType->name }} -
                            {{ $order->laundryPackage->name }}
                        </td>
                        <td>
                            @if ($order->weight)
                                {{ $order->weight }} KG
                            @else
                                {{ $order->qty }} PCS
                            @endif
                        </td>
                        <td>
                            Rp
                            {{ number_format($order->weight ? $order->laundryPackage->price_per_kg : $order->laundryPackage->price_per_pcs, 0, ',', '.') }}
                        </td>
                        <td>
                            Rp {{ number_format($order->subtotal, 0, ',', '.') }}
                        </td>
                    </tr>
                </tbody>
            </table>

            {{-- TOTAL --}}
            <table class="table">
                <tr>
                    <th>Total</th>
                    <td>Rp {{ number_format($order->invoice->total_amount, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Dibayar</th>
                    <td>Rp {{ number_format($order->invoice->paid_amount, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Sisa</th>
                    <td>Rp {{ number_format($order->invoice->remaining_amount, 0, ',', '.') }}</td>
                </tr>
            </table>

        </div>
    </div>
@endsection
