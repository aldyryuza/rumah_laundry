@extends('web.template.main')
@php $title = 'Tipe Laundry'; @endphp

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Master Tipe Laundry</h3>
                    <a href="{{ route('laundry-types.create') }}" class="btn btn-sm btn-primary float-right">Add</a>
                </div>

                <div class="card-body">
                    <table id="data-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Jenis</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $no => $item)
                                <tr>
                                    <td>{{ $no + 1 }}</td>
                                    <td>{{ $item->code }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        {{ $item->is_weight_based ? 'Berat (KG)' : 'Satuan (PCS)' }}
                                    </td>
                                    <td>
                                        <a href="{{ route('laundry-types.edit', $item->id) }}"
                                            class="btn btn-sm btn-primary">Edit</a>
                                        <a href="{{ route('laundry-types.destroy', $item->id) }}"
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
