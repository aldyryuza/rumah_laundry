@extends('web.template.main')
@php
    $title = 'Users';
@endphp

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data User</h3>
                    <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary float-right">Add User</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="data-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Nama</th>
                                <th>Role</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->role }}</td>
                                    <td>
                                        <a href="{{ route('users.edit', $item->id) }}"
                                            class="btn btn-sm btn-primary">Edit</a>
                                        <a href="{{ route('users.destroy', $item->id) }}" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin hapus?')">
                                            Delete
                                        </a>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
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
