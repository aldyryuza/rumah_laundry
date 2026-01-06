@extends('web.template.main')
@php $title = 'Laporan Order'; @endphp

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
                <option value="all">-- Semua Status --</option>
                <option value="antrian" {{ request('status')=='antrian' ? 'selected' : '' }}>
                    Dalam Antrian
                </option>
                <option value="dikerjakan" {{ request('status')=='dikerjakan' ? 'selected' : '' }}>
                    Dikerjakan
                </option>
                <option value="selesai_dikerjakan" {{ request('status')=='selesai_dikerjakan' ? 'selected' : '' }}>
                    Selesai Dikerjakan
                </option>
                <option value="menunggu_pembayaran" {{ request('status')=='menunggu_pembayaran' ? 'selected' : '' }}>
                    Menunggu Pembayaran
                </option>
                <option value="selesai" {{ request('status')=='selesai' ? 'selected' : '' }}>
                    Selesai
                </option>
            </select>
        </div>

        <div class="col-md-2">
            <button class="btn btn-primary">Filter</button>
        </div>

    </div>
</form>


<div class="card">
    <div class="card-header">
        <h2 class="card-title">Laporan Order</h2>
        <br>
        {{-- Nama & alamat laundry --}}
        <p>
            <strong>BEEBERSIHJASA LAUNDRY</strong><br>
            Jl. Prabu Kian Santang No.80, Kota Tangerang
        </p>
    </div>
    <div class="card-body">

        <p>
            Total Order: <strong>{{ $totalOrder }}</strong><br>
            Total Revenue: <strong>Rp {{ number_format($totalRevenue, 0, ',', '.') }}</strong>
        </p>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No Order</th>
                    <th>No Invoice</th>
                    <th>Pelanggan</th>
                    <th>Nomor HP</th>
                    <th>Alamat</th>
                    <th>Tanggal Order</th>
                    <th>Tipe Laundry</th>
                    <th>Paket Laundry</th>
                    <th>Estimasi Selesai</th>
                    <th>Status</th>
                    <th>Metode Pembayaran</th>
                    <th>Subtotal</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($orders as $o)

                <tr>
                    <td>{{ $o->no_order }}</td>
                    <td>{{ $o->invoice['invoice_number'] }}</td>
                    <td>{{ $o->nama_user }}</td>
                    <td>{{ $o->no_hp }}</td>
                    <td>{{ $o->alamat }}</td>
                    <td>{{ $o->date_in }}</td>
                    <td>{{ $o->laundryType->name }}</td>
                    <td>{{ $o->laundryPackage->name }}</td>
                    <td>{{ $o->laundryPackage->duration_day }} Hari</td>
                    <td>
                        @if ($o->status == 'antrian')
                        <span class="badge badge-secondary">Dalam Antrian</span>
                        @elseif($o->status == 'dikerjakan')
                        <span class="badge badge-warning">Dikerjakan</span>
                        @elseif($o->status == 'selesai_dikerjakan')
                        <span class="badge badge-info">Selesai Dikerjakan</span>
                        @elseif($o->status == 'menunggu_pembayaran')
                        <span class="badge badge-danger">Menunggu Pembayaran</span>
                        @else
                        <span class="badge badge-success">Selesai</span>
                        @endif
                    </td>
                    <td>
                        @foreach ($o->payments as $item)
                        {{ $item->method }} : Rp {{ number_format($item->amount, 0, ',', '.') }} <br>
                        @endforeach
                    </td>


                    <td>Rp {{ number_format($o->subtotal, 0, ',', '.') }}</td>
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
        buttons: [
            {
                extend: 'excelHtml5',
                text: 'Download Excel',
                title: 'Laporan Order',
                messageTop: 'BEEBERSIHJASA LAUNDRY\nJl. Prabu Kian Santang No.80, Kota Tangerang'
            },
            {
                extend: 'pdfHtml5',
                text: 'Download PDF',
                title: 'Laporan Order',
                messageTop: 'BEEBERSIHJASA LAUNDRY\nJl. Prabu Kian Santang No.80, Kota Tangerang',
                orientation: 'landscape',
                pageSize: 'A4'
            },
            {
                extend: 'print',
                text: 'Print',
                title: 'Laporan Order',
                messageTop: `<strong>BEEBERSIHJASA LAUNDRY</strong><br>
                    Jl. Prabu Kian Santang No.80, Kota Tangerang`,
                orientation: 'landscape',
                pageSize: 'A4'
            }
        ]
    });
});

</script>
@endsection