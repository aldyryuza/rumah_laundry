@extends('web.template.main')
@php $title = 'Invoice'; @endphp

@section('content')
<div class="card">

    <div class="card-header">
        <h3 class="card-title">INVOICE</h3>
        <button onclick="window.print()" class="btn btn-sm btn-secondary float-right no_print">
            Print
        </button>
    </div>

    <div class="card-body">

        {{-- HEADER --}}
        <div class="row">
            <div class="col-md-6">
                <h4>BEEEBERSIHJASA LAUNDRY</h4>
                <p>
                    Jl. Prabu Kian Santang No.80, Kota Tangerang <br>
                    Telp: 0822-1061-0646
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
                <strong>Nama Pelanggan: </strong> {{ $order->nama_user }}<br>
                <strong>No Telp:</strong> {{ $order->no_hp }}<br>
                <strong>Alamat: </strong> {{ $order->alamat }}
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
                    <th>No</th>
                    <th>Deskripsi</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
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
                        {{ number_format($order->weight ? $order->laundryPackage->price_per_kg :
                        $order->laundryPackage->price_per_pcs, 0, ',', '.') }}
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
            <tr>
                <th>Estimasi Selesai</th>
                <td>{{ $order->date_out }}</td>
            </tr>
            <tr>
                <th>Metode Pembayaran</th>
                <td>
                    @foreach ($order->payments as $item)
                    {{ $item->method }} : Rp {{ number_format($item->amount, 0, ',', '.') }} <br>
                    @endforeach
                </td>
            </tr>
        </table>

        {{-- Catatan --}}
        <div class="row">
            <div class="col-md-12">
                <strong>Catatan:</strong><br>
                <p>
                    Terima kasih telah menggunakan layanan BEEBERSIHJASA LAUNDRY. <br>
                    Simpan invoice ini sebagai bukti pembayaran.
                </p>
            </div>
        </div>

    </div>
</div>
@endsection

<style>
    @media print {

        .main-footer,
        .no_print {
            display: none !important;
        }
    }
</style>