@extends('dashboard.layouts.main')

@section('container')
<div class="container-fluid bg-cover bg-blur">
    <div class="container">
        <center><h1 class="my-4">Pesan Makanan dan Minuman</h1></center>
        
        <!-- Dropdown Kategori -->
        <form action="{{ route('dashboard.orders.filter') }}" method="GET" class="mb-4">
            <div class="input-group">
                <select name="category" class="form-select" onchange="this.form.submit()">
                    <option value="">Pilih Kategori</option>
                    <option value="coffee" {{ request('category') == 'coffee' ? 'selected' : '' }}>Coffee</option>
                    <option value="non coffee" {{ request('category') == 'non coffee' ? 'selected' : '' }}>Non Coffee</option>
                    <option value="makanan berat" {{ request('category') == 'makanan berat' ? 'selected' : '' }}>Makanan Berat</option>
                    <option value="makanan ringan" {{ request('category') == 'makanan ringan' ? 'selected' : '' }}>Makanan Ringan</option>
                </select>
            </div>
        </form>

        <div class="row justify-content-center">
            @if($menus->isEmpty())
                <div class="col-12">
                    <p class="text-center">Tidak ada menu yang ditemukan.</p>
                </div>
            @else
                @foreach ($menus as $menu)
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-img-center">
                            <img src="{{ asset('images/' . $menu->image) }}" class="card-img-top" alt="{{ $menu->name }}">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title text-center">{{ $menu->name }}</h5>
                            <p class="card-text text-muted text-center">{{ Str::limit($menu->description, 20, '...') }}</p>
                            <p class="card-text text-center">
                                <strong>Harga: </strong>Rp. {{ number_format($menu->price, 0, ',', '.') }}
                            </p>
                            <form action="{{ route('dashboard.checkout', $menu->id) }}" method="GET">
                                @csrf
                                <button type="submit" class="btn btn-warning w-100" style="background-color: #155724;">
                                    <a class="text-white">Check Out</a>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection