@extends('layouts.admin')

@section('title', 'Edit Produk')

@section('content')
<div class="container-fluid px-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-0 text-gray-800 fw-bold">Edit Produk</h4>
            <small class="text-muted">Perbarui informasi produk: <strong>{{ $produk->Nama_produk }}</strong></small>
        </div>
        <a href="{{ route('produk.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">

                    <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-7 border-end-md pe-md-4">
                                <h6 class="text-uppercase text-muted fw-bold mb-3" style="font-size: 12px; letter-spacing: 1px;">Detail Informasi</h6>

                                <div class="mb-3">
                                    <label for="Nama_produk" class="form-label fw-medium">Nama Produk</label>
                                    <input type="text" class="form-control" name="Nama_produk" id="Nama_produk" 
                                           value="{{ old('Nama_produk', $produk->Nama_produk) }}" required>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="Kategori_produk" class="form-label fw-medium">Kategori</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i class="fas fa-tag text-muted"></i></span>
                                            <input type="text" class="form-control" name="Kategori_produk" id="Kategori_produk" 
                                                   value="{{ old('Kategori_produk', $produk->Kategori_produk) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="Varian_produk" class="form-label fw-medium">Varian</label>
                                        <input type="text" class="form-control" name="Varian_produk" id="Varian_produk" 
                                               value="{{ old('Varian_produk', $produk->Varian_produk) }}" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="Deskripsi_produk" class="form-label fw-medium">Deskripsi</label>
                                    <textarea class="form-control" name="Deskripsi_produk" id="Deskripsi_produk" rows="6">{{ old('Deskripsi_produk', $produk->Deskripsi_produk) }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-5 ps-md-4">
                                <h6 class="text-uppercase text-muted fw-bold mb-3" style="font-size: 12px; letter-spacing: 1px;">Harga & Media</h6>

                                <div class="mb-4">
                                    <label for="Harga" class="form-label fw-medium">Harga Satuan</label>
                                    <div class="input-group">
                                        <span class="input-group-text fw-bold">Rp</span>
                                        <input type="number" class="form-control" name="Harga" id="Harga" 
                                               value="{{ old('Harga', $produk->Harga) }}" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-medium">Gambar Produk</label>
                                    
                                    <div class="card bg-light mb-2 d-flex justify-content-center align-items-center position-relative overflow-hidden" 
                                         style="height: 220px; border: 2px dashed #ccc;">
                                        
                                        @if($produk->gambar)
                                            <img id="img-preview" src="{{ asset('storage/' . $produk->gambar) }}" 
                                                 class="w-100 h-100 object-fit-cover" alt="Preview Gambar">
                                        @else
                                            <img id="img-preview" src="" style="display:none;" class="w-100 h-100 object-fit-cover">
                                            <div id="placeholder-text" class="text-muted text-center">
                                                <i class="fas fa-image fa-3x mb-2"></i>
                                                <p class="small mb-0">Tidak ada gambar</p>
                                            </div>
                                        @endif
                                    </div>

                                    <label for="gambar" class="form-label small text-muted">Ganti Gambar (Opsional)</label>
                                    <input type="file" class="form-control form-control-sm" name="gambar" id="gambar" 
                                           accept=".png,.jpg,.jpeg" onchange="previewImage()">
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('produk.index') }}" class="btn btn-light border">Batal</a>
                            <button type="submit" class="btn btn-primary px-4 fw-bold">
                                <i class="fas fa-save me-1"></i> Update Produk
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage() {
        const image = document.querySelector('#gambar');
        const imgPreview = document.querySelector('#img-preview');
        const placeholder = document.querySelector('#placeholder-text');

        // Pastikan ada file yang dipilih
        if (image.files && image.files[0]) {
            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.style.display = 'block';
                imgPreview.src = oFREvent.target.result;
                if(placeholder) placeholder.style.display = 'none';
            }
        }
    }
</script>

@endsection