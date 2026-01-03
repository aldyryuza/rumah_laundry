@extends('web.template.main')
@php $title = 'Payment Report'; @endphp

@section('content')
<form method="GET" class="mb-3">
    <div class="row">

        <div class="col-md-3">
            <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
        </div>

        <div class="col-md-3">
            <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
        </div>

        <div class="col-md-2">
            <select name="method" class="form-control">
                <option value="all">-- Metode --</option>
                <option value="cash" {{ request('method')=='cash' ? 'selected' : '' }}>Cash</option>
                <option value="transfer" {{ request('method')=='transfer' ? 'selected' : '' }}>Transfer</option>
                <option value="ewallet" {{ request('method')=='ewallet' ? 'selected' : '' }}>E-Wallet</option>
            </select>
        </div>

        <div class="col-md-2">
            <button class="btn btn-primary">Filter</button>
        </div>

    </div>
</form>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Payment Detail</h3>
    </div>

    <div class="card-body">

        <p>
            Total Pembayaran:
            <strong>Rp {{ number_format($totalPaid, 0, ',', '.') }}</strong>
        </p>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>No Order</th>
                    <th>Pelanggan</th>
                    <th>Metode</th>
                    <th>Status</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payments as $p)
                <tr>
                    <td>{{ $p->payment_date }}</td>
                    <td>{{ $p->order->no_order }}</td>
                    <td>{{ $p->order->nama_user }}</td>
                    <td>{{ strtoupper($p->method) }}</td>
                    <td>
                        @if ($p->status == 'paid')
                        <span class="badge badge-success">Paid</span>
                        @else
                        <span class="badge badge-warning">Pending</span>
                        @endif
                    </td>
                    <td>
                        Rp {{ number_format($p->amount, 0, ',', '.') }}
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