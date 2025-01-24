@extends('dashboard.layouts.main')

@section('container')
<div class="container">
    <h1>Edit Image</h1>
    <form action="{{ route('dashboard.images.update', $image) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="image" class="form-label">Upload New Image</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <button type="submit" class="btn btn-primary">Update Image</button>
    </form>
</div>
@endsection