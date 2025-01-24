@extends('dashboard.layouts.main')

@section('container')
<div class="container">
    <br>
    <h1>Hasil Pesanan</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Nama Menu</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Nama Pemesan</th>
                <th>Alamat</th>
                <th>No. HP\WA</th>
                <th>Email</th>
                <th>Tanggal Pesan</th>
                <th hidden>Status</th>
                @can('admin')
                <th>Opsi</th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr>
                <td>{{ $order->menu ? $order->menu->name : 'Menu tidak ditemukan' }}</td>
                <td>{{ $order->quantity }}</td>
                <td>Rp. {{ $order ? number_format($order->grand_total, 2, ',', '.') : '0' }}</td>
                <td>{{ $order->name }}</td>
                <td>{{ $order->address }}</td>
                <td>{{ $order->phone }}</td>
                <td>{{ $order->email }}</td>
                <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                <td hidden>
                    @can('admin')
                    <form action="{{ route('dashboard.admin.orders.updateStatus', $order) }}" method="POST">
                        @csrf
                        <select name="status" onchange="this.form.submit()">
                            <option value="Baru" {{ $order->status == 'Baru' ? 'selected' : '' }}>Baru</option>
                            <option value="Diproses" {{ $order->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="Diantar" {{ $order->status == 'Diantar' ? 'selected' : '' }}>Diantar</option>
                            <option value="Dilokasi" {{ $order->status == 'Dilokasi' ? 'selected' : '' }}>Dilokasi</option>
                            <option value="Selesai" {{ $order->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </form>
                    @else
                    <span>{{ ucfirst($order->status) }}</span>
                    @endcan
                </td>
                @can('admin')
                <td>
                    <form action="{{ route('dashboard.admin.orders.destroy', $order) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                    <a href="{{ route('dashboard.admin.orders.nota', $order) }}" class="btn btn-info">Nota</a> <!-- Tambahkan tombol Nota -->
                </td>
                @endcan
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
