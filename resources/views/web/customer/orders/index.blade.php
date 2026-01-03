@extends('web.template.customer.main')
@php $title = 'Order Laundry Customer'; @endphp

@section('content-customer')
<div class="row mb-3">

    <div class="col-md-2">
        <select id="filter-type" class="form-control">
            <option value="">-- Semua Tipe --</option>
            @foreach ($types as $type)
            <option value="{{ $type->name }}">{{ $type->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-2">
        <select id="filter-package" class="form-control">
            <option value="">-- Semua Paket --</option>
            @foreach ($packages as $pkg)
            <option value="{{ $pkg->name }}">{{ $pkg->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-2">
        <select id="filter-status" class="form-control">
            <option value="">-- Semua Status --</option>
            <option value="dalam antrian">Dalam Antrian</option>
            <option value="dikerjakan">Dikerjakan</option>
            <option value="selesai dikerjakan">Selesai Dikerjakan</option>
            <option value="menunggu pembayaran">Menunggu Pembayaran</option>
            <option value="selesai">Selesai</option>
        </select>
    </div>
    {{-- button refresh --}}
    <div class="col-md-1">
        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Refresh</a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Order Laundry</h3>
        <a href="{{ route('order-customer-create') }}" class="btn btn-sm btn-primary float-right">Tambah Order</a>
    </div>

    <div class="card-body">
        <table id="data-table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No Order</th>
                    <th>Pelanggan</th>
                    <th>Tipe</th>
                    <th>Paket</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td>{{ $item->no_order }}</td>
                    <td>{{ $item->nama_user }}</td>
                    <td>{{ $item->laundryType->name }}</td>
                    <td>{{ $item->laundryPackage->name }}</td>
                    <td>{{ ucfirst(str_replace('_', ' ', $item->status)) }}</td>
                    <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('order-customer-show', $item->id) }}" class="btn btn-sm btn-info">Detail</a>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts-customer')
<script>
    $(function() {
            var table = $('#data-table').DataTable();

            $('#filter-user').on('change', function() {
                table.column(1).search(this.value).draw();
            });

            $('#filter-type').on('change', function() {
                table.column(2).search(this.value).draw();
            });

            $('#filter-package').on('change', function() {
                table.column(3).search(this.value).draw();
            });

            $('#filter-status').on('change', function() {
                table.column(4).search(this.value).draw();
            });
        });
</script>
@endsection