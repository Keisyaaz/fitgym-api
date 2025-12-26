@extends('layouts.customer')

@section('title', 'Keranjang Belanja')

@section('content')

<div class="container my-5">

    <h2 class="fw-bold mb-4">Keranjang Belanja</h2>

    <!-- Tombol Kembali ke Produk -->
    <div class="mb-4">
        <a href="{{ route('customer.produk') }}" class="btn-back">← Kembali ke Produk</a>
    </div>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    @php 
        $total = 0; 
    @endphp

    @if(empty($cart))
        <div class="text-center py-5">
            <h4 class="text-muted">Keranjang masih kosong</h4>
            <a href="{{ route('customer.produk') }}" class="btn-back mt-3">Belanja Sekarang</a>
        </div>

    @else

        <div class="row">
            <div class="col-lg-8">

                @foreach($cart as $item)
                    @php 
                        $subtotal = $item['harga'] * $item['jumlah']; 
                        $total += $subtotal;
                    @endphp

                    <div class="card-cart">
                        <div class="cart-row">
                            <div class="cart-img">
                                <img src="{{ asset('storage/' . $item['gambar']) }}" 
                                     alt="{{ $item['nama'] }}">
                            </div>

                            <div class="cart-body">
                                <h5>{{ $item['nama'] }}</h5>
                                <p class="text-muted">Rp {{ number_format($item['harga'],0,',','.') }}</p>

                                <form action="{{ route('cart.update', $item['id']) }}" method="POST" class="cart-update-form">
                                    @csrf
                                    @method('PATCH')

                                    <input type="number" name="jumlah" value="{{ $item['jumlah'] }}" min="1">
                                    <button class="btn-update">Update</button>
                                </form>
                            </div>

                            <div class="cart-subtotal">
                                <p>Subtotal:</p>
                                <p>Rp {{ number_format($subtotal,0,',','.') }}</p>

                                <form action="{{ route('cart.destroy', $item['id']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-delete">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>

                @endforeach

            </div>

            <div class="col-lg-4">
                <div class="cart-summary">
                    <h5>Ringkasan Belanja</h5>
                    <hr>
                    <p class="d-flex justify-content-between">
                        <span>Total</span>
                        <span class="fw-bold">Rp {{ number_format($total,0,',','.') }}</span>
                    </p>

                    <button class="btn-checkout">Checkout</button>
                </div>
            </div>

        </div>

    @endif

</div>

<style>
/* Tombol Kembali */
.btn-back {
    display: inline-block;
    padding: 8px 16px;
    background-color: #007bff;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
    transition: background 0.3s;
}

.btn-back:hover {
    background-color: #0056b3;
}

/* Card Keranjang */
.card-cart {
    border: 1px solid #ddd;
    border-radius: 10px;
    padding: 15px;
    margin-bottom: 15px;
    transition: transform 0.3s, box-shadow 0.3s;
}

.card-cart:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.cart-row {
    display: flex;
    align-items: center;
    gap: 15px;
}

.cart-img img {
    width: 120px;
    height: 120px;
    object-fit: cover;
    border-radius: 8px;
}

.cart-body {
    flex: 1;
}

.cart-update-form {
    display: flex;
    gap: 5px;
    margin-top: 5px;
}

.cart-update-form input {
    width: 60px;
    padding: 5px;
}

.btn-update {
    padding: 5px 10px;
    background-color: #28a745;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.btn-update:hover {
    background-color: #218838;
}

.cart-subtotal {
    text-align: center;
}

.btn-delete {
    padding: 5px 10px;
    background-color: #dc3545;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 5px;
}

.btn-delete:hover {
    background-color: #c82333;
}

/* Ringkasan Belanja */
.cart-summary {
    border: 1px solid #ddd;
    border-radius: 10px;
    padding: 15px;
}

.btn-checkout {
    width: 100%;
    padding: 10px;
    background-color: #28a745;
    color: white;
    border: none;
    border-radius: 5px;
    font-weight: bold;
    margin-top: 10px;
    cursor: pointer;
}

.btn-checkout:hover {
    background-color: #218838;
}
</style>

@endsection
