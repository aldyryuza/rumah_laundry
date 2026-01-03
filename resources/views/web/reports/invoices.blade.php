@extends('web.template.main')
@php $title = 'Invoice Report'; @endphp

@section('content')
<form method="GET" class="mb-3">
    <div class="row">

        <div class="col-md-3">
            <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
        </div>

        <div class="col-md-3">
            <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
        </div>

        <div class="col-md-3">
            <select name="status" class="form-control">
                <option value="all">-- Semua Invoice --</option>
                <option value="lunas" {{ request('status')=='lunas' ? 'selected' : '' }}>
                    Lunas
                </option>
                <option value="belum_lunas" {{ request('status')=='belum_lunas' ? 'selected' : '' }}>
                    Belum Lunas
                </option>
            </select>
        </div>

        <div class="col-md-2">
            <button class="btn btn-primary">Filter</button>
        </div>

    </div>
</form>
<div class="row mb-3">
    <div class="col-md-3">
        <div class="info-box bg-info">
            <span class="info-box-text">Total Invoice</span>
            <span class="info-box-number">{{ $totalInvoice }}</span>
        </div>
    </div>

    <div class="col-md-3">
        <div class="info-box bg-primary">
            <span class="info-box-text">Total Tagihan</span>
            <span class="info-box-number">
                Rp {{ number_format($totalTagihan, 0, ',', '.') }}
            </span>
        </div>
    </div>

    <div class="col-md-3">
        <div class="info-box bg-success">
            <span class="info-box-text">Terbayar</span>
            <span class="info-box-number">
                Rp {{ number_format($totalTerbayar, 0, ',', '.') }}
            </span>
        </div>
    </div>

    <div class="col-md-3">
        <div class="info-box bg-danger">
            <span class="info-box-text">Sisa Tagihan</span>
            <span class="info-box-number">
                Rp {{ number_format($totalSisa, 0, ',', '.') }}
            </span>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Invoice Report</h3>
    </div>

    <div class="card-body">

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>No Invoice</th>
                    <th>No Order</th>
                    <th>Pelanggan</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Terbayar</th>
                    <th>Sisa</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoices as $inv)
                <tr>
                    <td>{{ $inv->invoice_date }}</td>
                    <td>{{ $inv->invoice_number }}</td>
                    <td>{{ $inv->order->no_order }}</td>
                    <td>{{ $inv->order->nama_user }}</td>
                    <td>
                        @if ($inv->remaining_amount == 0)
                        <span class="badge badge-success">Lunas</span>
                        @else
                        <span class="badge badge-danger">Belum Lunas</span>
                        @endif
                    </td>
                    <td>Rp {{ number_format($inv->total_amount, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($inv->paid_amount, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($inv->remaining_amount, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('invoices.show', $inv->order_id) }}" class="btn btn-sm btn-info">
                            Lihat
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
@endsection
@section('scripts')
<script>
    $(function() {
            $('.table').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'excelHtml5',
                        text: 'Download Excel',
                        title: 'Report Laundry'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: 'Download PDF',
                        title: 'Report Laundry',
                        orientation: 'landscape',
                        pageSize: 'A4'
                    },
                    {
                        extend: 'print',
                        text: 'Print'
                    }
                ]
            });
        });
</script>
@endsection