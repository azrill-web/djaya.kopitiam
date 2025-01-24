@extends('dashboard.layouts.main')

@section('container')
<div class="container">
    <br>
    <h1>Edit Menu Makanan</h1>
    <form action="{{ route('dashboard.menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nama Menu</label>
            <input type="text" name="name" class="form-control" value="{{ $menu->name }}" required>
        </div>
        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea name="description" class="form-control">{{ $menu->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="price">Harga</label>
            <input type="number" name="price" class="form-control" step="0.01" value="{{ $menu->price }}" required>
        </div>
        <div class="form-group">
            <label for="category">Kategori</label>
            <select name="category" class="form-control" required>
                <option value="coffee" {{ $menu->category == 'coffee' ? 'selected' : '' }}>Coffee</option>
                <option value="non coffee" {{ $menu->category == 'non coffee' ? 'selected' : '' }}>Non Coffee</option>
                <option value="makanan berat" {{ $menu->category == 'makanan berat' ? 'selected' : '' }}>Makanan Berat</option>
                <option value="makanan ringan" {{ $menu->category == 'makanan ringan' ? 'selected' : '' }}>Makanan Ringan</option>
            </select>
        </div>
        <div class="form-group">
            <label for="image">Gambar Menu:</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <br>
        <button type="submit" class="btn btn-success">Update Menu</button>
    </form>
</div>
@endsection