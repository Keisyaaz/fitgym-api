@extends('layouts.customer')

@section('title', 'Produk FitGym')

@section('hero')
<div class="hero-section text-center text-white d-flex align-items-center justify-content-center" 
     style="background: linear-gradient(rgba(45, 122, 146, 0.9), rgba(24, 90, 157, 0.8)), 
            url('https://source.unsplash.com/random/1200x400/?gym') no-repeat center/cover; 
            height: 300px; border-radius: 0 0 30px 30px;">
    <div>
        <h1 class="fw-bold display-5">Temukan Merchandise FitGym Favoritmu!</h1>
        <p class="lead">Latihan lebih maksimal dengan perlengkapan terbaik.</p>
    </div>
</div>
@endsection

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4 mt-5">
    <h3 class="fw-bold text-dark">
        <i class="fas fa-fire text-danger me-2"></i>Produk Terbaru
    </h3>
</div>

<div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4 mb-5">
    @forelse($produk as $p)
    <div class="col">
        <div class="card h-100 shadow-sm border-0 product-card">

            <div class="position-relative overflow-hidden">
                @if($p->gambar && file_exists(public_path($p->gambar)))
                    <img src="{{ asset($p->gambar) }}"
                         class="card-img-top"
                         alt="{{ $p->Nama_produk }}">
                @else
                    <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                        <i class="fas fa-image fa-3x text-secondary"></i>
                    </div>
                @endif

                <span class="position-absolute top-0 start-0 bg-primary text-white badge m-2 p-2">
                    {{ $p->Kategori_produk }}
                </span>
            </div>

            <div class="card-body d-flex flex-column">
                <h5 class="card-title fw-bold text-dark">
                    {{ $p->Nama_produk }}
                </h5>

                <p class="card-text text-muted small flex-grow-1 text-truncate-2">
                    {{ $p->Deskripsi_produk }}
                </p>

                <div class="mt-3">
                    <span class="h5 mb-0 text-primary fw-bold">
                        Rp {{ number_format($p->Harga, 0, ',', '.') }}
                    </span>
                </div>
            </div>

            <div class="card-footer bg-white border-0 p-3 pt-0">
                <form action="{{ route('cart.store', $p->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success w-100 fw-bold btn-add-cart">
                        <i class="fas fa-plus me-1"></i> Keranjang
                    </button>
                </form>
            </div>

        </div>
    </div>
    @empty
    <div class="col-12 text-center text-muted">
        Belum ada produk tersedia
    </div>
    @endforelse
</div>

@endsection

<style>
.text-truncate-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.product-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
}

.card-img-top {
    height: 200px;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.product-card:hover .card-img-top {
    transform: scale(1.05);
}

.btn-add-cart {
    background-color: #2d7a92 !important;
    border-color: #2d7a92 !important;
}
.btn-add-cart:hover {
    background-color: #246073 !important;
    transform: scale(1.02);
}
</style>
