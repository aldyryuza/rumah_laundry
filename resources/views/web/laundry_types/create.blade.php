@extends('web.template.main')
@php $title = 'Tambah Tipe Laundry'; @endphp

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('laundry-types.store') }}" method="POST">
                {{ csrf_field() }}

                <div class="form-group">
                    <label>Kode</label>
                    <input type="text" name="code" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Jenis Hitung</label>
                    <select name="is_weight_based" class="form-control">
                        <option value="1">Berat (KG)</option>
                        <option value="0">Satuan (PCS)</option>
                    </select>
                </div>

                <button class="btn btn-primary">Simpan</button>
                <a href="{{ route('laundry-types.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
@endsection
