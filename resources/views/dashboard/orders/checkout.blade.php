@extends('dashboard.layouts.main')

@section('container')
<div class="container">
    <br>
    <center><h1>Checkout</h1></center>
    <div class="card mb-4" style="width: 100%; max-width: 500px; margin: auto;">
        <img style="width: 100%;" src="{{ asset('images/' . $menu->image) }}" class="card-img-top" alt="{{ $menu->name }}">
        <div class="card-body">
            <h5 class="card-title">{{ $menu->name }}</h5>
            <p class="card-text">{{ $menu->description }}</p>
            <p class="card-text"><strong>Harga: </strong>Rp. {{ number_format($menu->price, 0, ',', '.') }}</p>
        </div>
    </div>

    <form action="{{ route('dashboard.checkout.process') }}" method="POST">
        @csrf
        <input type="hidden" name="menu_id" value="{{ $menu->id }}">

        <div class="form-group">
            <label for="quantity">Jumlah</label>
            <input type="number" id="quantity" name="quantity" class="form-control" min="1" value="1" required>
        </div>

        <div class="form-group">
            <label for="name">Nama Pemesan</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="address">Alamat</label>
            <input type="text" name="address" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="phone">No. HP/WA</label>
            <input type="number" name="phone" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="form-group">
            <h5>Total Pembayaran: <span id="grandTotal">Rp. {{ number_format($menu->price, 0, ',', '.') }}</span></h5>
            <input type="hidden" name="grand_total" id="hiddenGrandTotal" value="{{ $menu->price }}">
        </div>

        <div class="form-group" hidden>
            <label for="status">status</label>
            <input type="text" name="status" class="form-control" value="Baru">
        </div>

        <button type="submit" class="btn btn-success">Kirim Pesanan</button>
        <br>
        <br>
        <br>
    </form>
</div>

<script>
    const price = {{ $menu->price }};
    const quantityInput = document.getElementById('quantity');
    const grandTotalDisplay = document.getElementById('grandTotal');
    const hiddenGrandTotal = document.getElementById('hiddenGrandTotal');

    quantityInput.addEventListener('input', function() {
        const quantity = parseInt(quantityInput.value) || 1; // Default to 1 if input is empty
        const total = price * quantity;
        grandTotalDisplay.textContent = 'Rp. ' + total.toLocaleString('id-ID', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        hiddenGrandTotal.value = total; // Update hidden input for grand total
    });
</script>
@endsection
