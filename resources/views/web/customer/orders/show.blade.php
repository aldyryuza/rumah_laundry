@extends('web.template.customer.main')
@php $title = 'Detail Order Customer'; @endphp

@section('content-customer')
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


<a href="{{ route('order-customer') }}" class="btn btn-secondary">
    Kembali
</a>

@if (in_array($data->status, ['selesai_dikerjakan', 'menunggu_pembayaran']))
<a href="{{ route('payments.create', $data->id) }}" class="btn btn-success">
    Bayar
</a>
@endif
@if ($data->invoice)
<a href="{{ route('invoices.show', $data->id) }}" class="btn btn-info">
    Lihat Invoice
</a>
@endif
@endsection