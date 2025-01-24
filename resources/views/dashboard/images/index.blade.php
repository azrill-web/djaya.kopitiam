@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Welcome back, {{ auth()->user()->name }}</h1>
</div>

<div class="container">
    <h1>Dashboard</h1>

    @can('admin')
        <a href="{{ route('dashboard.images.create') }}" class="btn btn-primary">Upload Image</a>
    @endcan

    <div class="row mt-4">
        @foreach($images as $image)
            <div class="col-md-4">
                <div class="card mb-4 border-0">
                    <!-- Display Image -->
                    <img 
                        src="{{ $image->image_path ? asset('images/' . $image->image_path) : asset('images/nophoto.jpg') }}" 
                        class="card-img-top" 
                        alt="Image" 
                        style="width: 100%; height: auto;">
                    
                    <div class="card-body text-center">
                        @can('admin')
                            <a href="{{ route('dashboard.images.edit', $image) }}" class="btn btn-warning btn-sm">Edit</a>
                            
                            <form action="{{ route('dashboard.images.destroy', $image) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this image?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        @endcan
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

@push('styles')
    <style>
        body {
            background-color: #b10e2b; /* Kopitiam red shade */
        }
    </style>
@endpush
