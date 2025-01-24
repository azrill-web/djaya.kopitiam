@extends('dashboard.layouts.main')

@section('container')
<div class="nota-container">
    <div class="nota-header">
        <h2>Nota Pesanan</h2>
        <p><strong>Tanggal:</strong> {{ $order->created_at->format('d-m-Y H:i') }}</p>
    </div>
    <div class="nota-body">
        <table>
            <tr>
                <th>Nama Menu:</th>
                <td>{{ $order->menu ? $order->menu->name : 'Menu tidak ditemukan' }}</td>
            </tr>
            <tr>
                <th>Jumlah:</th>
                <td>{{ $order->quantity }}</td>
            </tr>
            <tr>
                <th>Harga:</th>
                <td>Rp. {{ number_format($order->grand_total, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Nama Pemesan:</th>
                <td>{{ $order->name }}</td>
            </tr>
            <tr>
                <th>Alamat:</th>
                <td>{{ $order->address }}</td>
            </tr>
            <tr>
                <th>No. HP/WA:</th>
                <td>{{ $order->phone }}</td>
            </tr>
            <tr>
                <th>Email:</th>
                <td>{{ $order->email }}</td>
            </tr>
        </table>
    </div>
    <div class="nota-footer">
        <button onclick="window.print();" class="btn btn-primary">Cetak Nota</button>
    </div>
</div>
@endsection
