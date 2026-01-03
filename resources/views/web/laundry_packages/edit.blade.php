@extends('web.template.main')
@php $title = 'Edit Paket Laundry'; @endphp

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('laundry-packages.update', $data->id) }}" method="POST">
                {{ csrf_field() }}

                <div class="form-group">
                    <label>Nama Paket</label>
                    <input type="text" name="name" value="{{ $data->name }}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Estimasi Hari</label>
                    <input type="number" name="duration_day" value="{{ $data->duration_day }}" class="form-control"
                        required>
                </div>

                <div class="form-group">
                    <label>Harga per KG</label>
                    <input type="number" name="price_per_kg" value="{{ $data->price_per_kg }}" class="form-control">
                </div>

                <div class="form-group">
                    <label>Harga per PCS</label>
                    <input type="number" name="price_per_pcs" value="{{ $data->price_per_pcs }}" class="form-control">
                </div>

                <button class="btn btn-primary">Update</button>
                <a href="{{ route('laundry-packages.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
@endsection
