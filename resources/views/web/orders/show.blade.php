@extends('web.template.main')
@php $title = 'Detail Order'; @endphp

@section('content')
<div class="row">

    {{-- INFO ORDER --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Informasi Order</h3>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr>
                        <th>No Order</th>
                        <td>{{ $data->no_order }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <span class="badge badge-info">
                                {{ ucfirst(str_replace('_', ' ', $data->status)) }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Tanggal Masuk</th>
                        <td>{{ $data->date_in }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Keluar</th>
                        <td>{{ $data->date_out }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    {{-- INFO CUSTOMER --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Pelanggan</h3>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr>
                        <th>Nama</th>
                        <td>{{ $data->nama_user }}</td>
                    </tr>
                    <tr>
                        <th>No Telp</th>
                        <td>{{ $data->no_hp }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $data->alamat }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

</div>

<div class="row">

    {{-- DETAIL LAUNDRY --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Laundry</h3>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr>
                        <th>Tipe Laundry</th>
                        <td>{{ $data->laundryType->name }}</td>
                    </tr>
                    <tr>
                        <th>Paket</th>
                        <td>{{ $data->laundryPackage->name }}</td>
                    </tr>
                    <tr>
                        <th>Berat / PCS</th>
                        <td>
                            @if ($data->weight)
                            {{ $data->weight }} KG
                            @else
                            {{ $data->qty }} PCS
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Keterangan</th>
                        <td>{{ $data->notes }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    {{-- RINGKASAN BIAYA --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Ringkasan Biaya</h3>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr>
                        <th>Total</th>
                        <td>Rp {{ number_format($data->subtotal, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Sudah Dibayar</th>
                        <td>
                            Rp {{ number_format($data->payments->sum('amount'), 0, ',', '.') }}
                        </td>
                    </tr>
                    <tr>
                        <th>Sisa</th>
                        <td>
                            Rp
                            {{ number_format($data->subtotal - $data->payments->sum('amount'), 0, ',', '.') }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

</div>

<hr>


@if (Auth::user()->role == 'admin')
<h5>Update Status Order</h5>
<form action="{{ route('orders.updateStatus', $data->id) }}" method="POST">
    {{ csrf_field() }}

    <select name="status" class="form-control" required>
        <option value="antrian" {{ $data->status == 'dalam_antrian' ? 'selected' : '' }}>
            Dalam Antrian
        </option>
        <option value="dikerjakan" {{ $data->status == 'dikerjakan' ? 'selected' : '' }}>
            Dikerjakan
        </option>
        <option value="selesai_dikerjakan" {{ $data->status == 'selesai_dikerjakan' ? 'selected' : '' }}>
            Selesai Dikerjakan
        </option>
        <option value="menunggu_pembayaran" {{ $data->status == 'menunggu_pembayaran' ? 'selected' : '' }}>
            Menunggu Pembayaran
        </option>
        <option value="selesai" {{ $data->status == 'selesai' ? 'selected' : '' }}>
            Selesai
        </option>
    </select>

    <button class="btn btn-success mt-2">
        Update Status
    </button>
</form>
<hr>

{{-- ACTION BUTTONS --}}

<a href="{{ route('orders.index') }}" class="btn btn-secondary">
    Kembali
</a>

@if (in_array($data->status, ['selesai_dikerjakan', 'menunggu_pembayaran']))
<a href="{{ route('payments.create', $data->id) }}" class="btn btn-success">
    Bayar
</a>
@endif


@if (in_array($data->status, ['menunggu_pembayaran', 'selesai']) && !$data->invoice)
<form action="{{ route('invoices.generate', $data->id) }}" method="POST" style="display:inline">
    {{ csrf_field() }}
    <button class="btn btn-primary">
        Generate Invoice
    </button>
</form>
@endif

@if ($data->invoice)
<a href="{{ route('invoices.show', $data->id) }}" class="btn btn-info">
    Lihat Invoice
</a>
@endif
@else
<a href="{{ route('orders.index') }}" class="btn btn-secondary">
    Kembali
</a>
@endif
@endsection