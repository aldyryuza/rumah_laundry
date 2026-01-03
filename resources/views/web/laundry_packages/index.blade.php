@extends('web.template.main')
@php $title = 'Paket Laundry'; @endphp

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Master Paket Laundry</h3>
                    <a href="{{ route('laundry-packages.create') }}" class="btn btn-sm btn-primary float-right">Add</a>
                </div>

                <div class="card-body">
                    <table id="data-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Paket</th>
                                <th>Estimasi (Hari)</th>
                                <th>Harga / KG</th>
                                <th>Harga / PCS</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $no => $item)
                                <tr>
                                    <td>{{ $no + 1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->duration_day }}</td>
                                    <td>{{ number_format($item->price_per_kg, 0, ',', '.') }}</td>
                                    <td>{{ number_format($item->price_per_pcs, 0, ',', '.') }}</td>
                                    <td>
                                        <a href="{{ route('laundry-packages.edit', $item->id) }}"
                                            class="btn btn-sm btn-primary">Edit</a>
                                        <a href="{{ route('laundry-packages.destroy', $item->id) }}"
                                            class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function() {
            $("#data-table").DataTable();
        });
    </script>
@endsection
