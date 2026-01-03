@extends('web.template.main')
@php $title = 'Edit Tipe Laundry'; @endphp

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('laundry-types.update', $data->id) }}" method="POST">
                {{ csrf_field() }}

                <div class="form-group">
                    <label>Kode</label>
                    <input type="text" name="code" value="{{ $data->code }}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="name" value="{{ $data->name }}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Jenis Hitung</label>
                    <select name="is_weight_based" class="form-control">
                        <option value="1" {{ $data->is_weight_based ? 'selected' : '' }}>Berat (KG)</option>
                        <option value="0" {{ !$data->is_weight_based ? 'selected' : '' }}>Satuan (PCS)</option>
                    </select>
                </div>

                <button class="btn btn-primary">Update</button>
                <a href="{{ route('laundry-types.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
@endsection
