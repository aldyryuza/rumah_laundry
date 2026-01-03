@extends('web.template.main')
@php $title = 'Pembayaran Order'; @endphp

@section('content')
    <div class="row">

        {{-- INFO ORDER --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Informasi Order</h3>
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <tr>
                            <th>No Order</th>
                            <td>{{ $order->no_order }}</td>
                        </tr>
                        <tr>
                            <th>Pelanggan</th>
                            <td>{{ $order->user->name }}</td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <td>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Sudah Dibayar</th>
                            <td>
                                Rp {{ number_format($order->payments->sum('amount'), 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <th>Sisa</th>
                            <td>
                                Rp
                                {{ number_format($order->subtotal - $order->payments->sum('amount'), 0, ',', '.') }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        {{-- FORM PEMBAYARAN --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Input Pembayaran</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('payments.store', $order->id) }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label>Jumlah Bayar</label>
                            <input type="number" name="amount" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Metode</label>
                            <select name="method" class="form-control" required>
                                <option value="cash">Cash</option>
                                <option value="transfer">Transfer</option>
                                <option value="qris">QRIS</option>
                            </select>
                        </div>

                        <button class="btn btn-success">Bayar</button>
                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
