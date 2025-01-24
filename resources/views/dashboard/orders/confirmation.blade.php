@extends('dashboard.layouts.main')

@section('container')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <h1>Konfirmasi Pesanan</h1>
    <div class="card mb-4" style="width: 100%; max-width: 500px; margin: auto;">
        <img src="{{ asset('images/' . $orderDetails['menu']->image) }}" class="card-img-top" alt="{{ $orderDetails['menu']->name }}" style="width: 100%; height: auto;">
        <div class="card-body">
            <h5 class="card-title">{{ $orderDetails['menu']->name }}</h5>
            <p class="card-text"><strong>Jumlah: </strong>{{ $orderDetails['quantity'] }}</p>
            <p class="card-text">{{ $orderDetails['menu']->description }}</p>
            <p class="card-text"><strong>Harga: </strong>Rp {{ number_format($orderDetails['menu']->price, 2, ',', '.') }}</p>
            <p class="card-text"><strong>Nama Pemesan: </strong>{{ $orderDetails['name'] }}</p>
            <p class="card-text"><strong>Alamat: </strong>{{ $orderDetails['address'] }}</p>
            <p class="card-text"><strong>Nomor HP: </strong>{{ $orderDetails['phone'] }}</p>
            <p class="card-text"><strong>Email: </strong>{{ $orderDetails['email'] }}</p>
            <p class="card-text"><strong>Harga Total: </strong>Rp {{ number_format($orderDetails['grand_total'], 2, ',', '.') }}</p>
            <p class="card-text" hidden><strong>Status: </strong>{{ $orderDetails['status'] }}</p>
        </div>
    </div>
    <a href="{{ route('dashboard.orders.index') }}" class="btn btn-primary">Kembali ke Menu</a>
    <a href="{{ route('dashboard.admin.orders.index') }}" class="btn btn-success">Cek Hasil Pesanan</a>
</div>
@endsection
