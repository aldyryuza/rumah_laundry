@extends('web.template.customer.main')
@php $title = 'Tambah Order Customer'; @endphp

@section('content-customer')
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('order-customer-store') }}">
            {{ csrf_field() }}

            {{-- <div class="form-group">
                <label>Pelanggan</label>
                <select name="user_id" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    @foreach ($customers as $c)
                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                    @endforeach
                </select>
            </div> --}}


            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="no_hp" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <input type="text" name="alamat" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Tanggal Order</label>
                <input type="date" name="date_in" class="form-control" required value="{{ date('Y-m-d') }}" readonly>
            </div>

            <div class="form-group">
                <label>Tipe Laundry</label>
                <select name="laundry_type_id" id="type" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    @foreach ($types as $t)
                    <option value="{{ $t->id }}" data-weight="{{ $t->is_weight_based }}">
                        {{ $t->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Paket</label>
                <select name="laundry_package_id" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    @foreach ($packages as $p)
                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group" id="weight-box">
                <label>Berat (KG)</label>
                <input type="number" step="0.1" name="weight" class="form-control">
            </div>

            <div class="form-group" id="qty-box" style="display:none">
                <label>Jumlah PCS</label>
                <input type="number" name="qty" class="form-control">
            </div>

            <div class="form-group">
                <label>Keterangan</label>
                <textarea name="notes" class="form-control"></textarea>
            </div>

            <button class="btn btn-primary">Simpan Order</button>
            <a href="{{ route('order-customer') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $('#type').change(function() {
            var isWeight = $('option:selected', this).data('weight');
            if (isWeight) {
                $('#weight-box').show();
                $('#qty-box').hide();
            } else {
                $('#weight-box').hide();
                $('#qty-box').show();
            }
        });
</script>
@endsection