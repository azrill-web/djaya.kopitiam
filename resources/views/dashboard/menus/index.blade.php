@extends('dashboard.layouts.main')

@section('container')
<div class="container">
    <br>
    <h1>Menu Makanan</h1>
    <a href="/dashboard/menus/create" class="btn btn-primary">Tambah Menu</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Kategori</th>
                <th>Tampilan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($menus as $menu)
            <tr>
                <td>{{ $menu->name }}</td>
                <td>{{ $menu->description }}</td>
                <td>Rp. {{ number_format($menu->price, 0, ',', '.') }}</td> <!-- Format harga langsung di sini -->
                <td>{{ ucfirst($menu->category) }}</td>
                <td>
                    @if ($menu->image)
                        <img src="{{ asset('images/' . $menu->image) }}" alt="Menu Image" style="width: 100px; height: auto;">
                    @else
                        <img src="{{ asset('images/nophoto.jpg') }}" alt="No Image" style="width: 100px; height: auto;">
                    @endif
                </td>
                <td>
                    <a href="{{ route('dashboard.menus.edit', $menu->id) }}" class="btn btn-warning" style="padding: 1px 10px; font-size: 17px; border: none;">Edit</a>
                    <form action="{{ route('dashboard.menus.destroy', $menu->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus menu ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection