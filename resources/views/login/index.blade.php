@extends('layouts.main')

@section('container')
<style>
    /* Background styling */
    body {
        background-color: #f8f9fa;
    }

    .form-signin {
        background-color: #fdf5e6; /* Warna krem khas kopitiam */
        border: 2px solid #d9534f; /* Bingkai warna merah */
        border-radius: 10px;
    }

    .btn-danger {
        background-color: #d9534f; /* Warna merah */
        border-color: #d9534f;
    }

    .btn-danger:hover {
        background-color: #c9302c; /* Warna merah gelap untuk hover */
        border-color: #ac2925;
    }

    .form-control:focus {
        border-color: #5cb85c; /* Warna hijau untuk input yang aktif */
        box-shadow: 0 0 0 0.25rem rgba(92, 184, 92, 0.25);
    }

    .text-primary {
        color: #5cb85c !important; /* Hijau untuk link */
    }

    h1 {
        color: #d9534f; /* Warna merah untuk judul */
    }

    label {
        color: #5e5e5e; /* Warna abu-abu lembut untuk teks label */
    }

    .invalid-feedback {
        color: #d9534f; /* Warna merah untuk error */
    }

    .alert-success {
        background-color: #dff0d8; /* Hijau lembut untuk alert sukses */
        border-color: #d6e9c6;
        color: #3c763d;
    }

    .alert-danger {
        background-color: #f2dede; /* Merah lembut untuk alert error */
        border-color: #ebccd1;
        color: #a94442;
    }

    .btn-close {
        background-color: transparent;
    }
</style>
<div class="row justify-content-center min-vh-70 align-items-center">
    <div class="col-md-4 col-10">

        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        @if(session()->has('loginError'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ session('loginError') }}
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        <main class="form-signin w-100 m-auto p-4 rounded shadow-sm bg-light">
            <!-- Tambahkan logo di sini -->
            <div class="text-center mb-4">
                <img src="{{ asset('images/djaya.jpeg') }}" alt="Logo" class="img-fluid" style="max-width: 150px;">
            </div>

            <h1 class="h3 mb-4 text-center fw-bold">Login to Your Account</h1>
            <form action="/login" method="post">
                @csrf
                <div class="form-floating mb-3">
                  <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" autofocus required value="{{ old('email') }}">
                  <label for="email">Email address</label>
                  @error('email')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="form-floating mb-3">
                  <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                  <label for="password">Password</label>
                </div>
                <button class="btn btn-danger w-100 py-2" type="submit">Login</button>
            </form>
            <small class="d-block text-center mt-3 text-muted">Not registered? <a href="/register" class="text-primary">Register Now!</a></small>
        </main>
    </div>
</div>
@endsection
