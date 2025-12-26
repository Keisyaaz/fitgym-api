@extends('layouts.admin')

@section('title', 'Tambah Produk Baru')

@section('content')
<div class="container-fluid px-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-0 text-gray-800 fw-bold">Tambah Produk</h4>
            <small class="text-muted">Isi formulir di bawah untuk menambahkan item baru.</small>
        </div>
        <a href="{{ route('produk.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    
                    <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-7 border-end-md pe-md-4">
                                <h6 class="text-uppercase text-muted fw-bold mb-3" style="font-size: 12px; letter-spacing: 1px;">Informasi Produk</h6>
                                
                                <div class="mb-3">
                                    <label for="Nama_produk" class="form-label fw-medium">Nama Produk <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="Nama_produk" id="Nama_produk" placeholder="Contoh: Whey Protein Gold" required>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="Kategori_produk" class="form-label fw-medium">Kategori</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0"><i class="fas fa-tag text-muted"></i></span>
                                            <input type="text" class="form-control border-start-0 ps-0" name="Kategori_produk" id="Kategori_produk" placeholder="Suplemen">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="Varian_produk" class="form-label fw-medium">Varian <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="Varian_produk" id="Varian_produk" placeholder="" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="Deskripsi_produk" class="form-label fw-medium">Deskripsi</label>
                                    <textarea class="form-control" name="Deskripsi_produk" id="Deskripsi_produk" rows="5" placeholder="Jelaskan detail produk di sini..."></textarea>
                                </div>
                            </div>

                            <div class="col-md-5 ps-md-4">
                                <h6 class="text-uppercase text-muted fw-bold mb-3" style="font-size: 12px; letter-spacing: 1px;">Harga & Media</h6>

                                <div class="mb-4">
                                    <label for="Harga" class="form-label fw-medium">Harga Satuan <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text fw-bold">Rp</span>
                                        <input type="number" class="form-control" name="Harga" id="Harga" placeholder="0" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-medium">Upload Gambar</label>
                                    
                                    <div class="card bg-light border-dashed mb-2 text-center d-flex justify-content-center align-items-center" style="height: 200px; border: 2px dashed #ccc; overflow: hidden;">
                                        <img id="img-preview" src="#" alt="Preview" style="display: none; max-width: 100%; max-height: 100%; object-fit: cover;">
                                        <div id="placeholder-icon" class="text-muted">
                                            <i class="fas fa-image fa-3x mb-2"></i>
                                            <p class="small mb-0">Preview Gambar</p>
                                        </div>
                                    </div>

                                    <input type="file" class="form-control form-control-sm" name="gambar" id="gambar" accept=".png,.jpg,.jpeg" onchange="previewImage()">
                                    <small class="text-muted" style="font-size: 11px;">Format: JPG, PNG. Maks: 2MB</small>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('produk.index') }}" class="btn btn-light border">Batal</a>
                            <button type="submit" class="btn btn-primary px-4 fw-bold">
                                <i class="fas fa-save me-1"></i> Simpan Produk
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
        const placeholder = document.querySelector('#placeholder-icon');

        imgPreview.style.display = 'block';
        placeholder.style.display = 'none';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>

@endsection