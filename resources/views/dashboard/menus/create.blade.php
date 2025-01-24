@extends('dashboard.layouts.main')

@section('container')
<div class="container">
    <br>
    <h1>Tambah Menu Makanan</h1>
    <form action="{{ route('dashboard.menus.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Nama Menu</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="price">Harga</label>
            <input type="number" name="price" class="form-control" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="category">Kategori</label>
            <select name="category" class="form-control" required>
                <option value="">Pilih Kategori</option>
                <option value="coffee">Coffee</option>
                <option value="non coffee">Non Coffee</option>
                <option value="makanan berat">Makanan Berat</option>
                <option value="makanan ringan">Makanan Ringan</option>
            </select>
        </div>
        <div class="form-group">
            <label for="image">Gambar Menu:</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <br>
        <button type="submit" class="btn btn-success">Simpan Menu</button>
    </form>
</div>
@endsection