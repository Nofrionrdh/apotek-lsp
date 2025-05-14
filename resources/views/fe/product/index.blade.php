@extends('fe.master')

@section('navbar')
    @include('fe.navbar')
@endsection

@section('nav-product')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');
    /* Animasi hover pada tombol Detail */
    .detail-btn {
        transition: background 0.3s, color 0.3s, box-shadow 0.3s;
        color: #17a2b8 !important;
        border-radius: 20px;
        padding: 6px 18px;
        font-weight: 500;
        background: transparent;
        border: none;
    }
    .detail-btn:hover, .detail-btn:focus {
        background: linear-gradient(90deg, #17a2b8 0%, #0dcaf0 100%);
        color: #fff !important;
        box-shadow: 0 4px 16px rgba(23,162,184,0.15);
        text-decoration: none;
        outline: none;
    }
    /* Modal custom style */
    body, .custom-modal .modal-content, .custom-modal .modal-header, .custom-modal .modal-body {
        font-family: 'Poppins', 'Segoe UI', Arial, sans-serif !important;
    }
    .custom-modal .modal-header,
    .custom-modal .modal-title,
    .custom-modal .btn-close,
    .custom-modal .modal-body,
    .custom-modal .product-info-title,
    .custom-modal .badge-stock,
    .custom-modal .fs-5,
    .custom-modal p,
    .custom-modal a,
    .custom-modal .btn {
        color: #fff !important;
    }
    .custom-modal .modal-content {
        border-radius: 18px;
        box-shadow: 0 8px 32px rgba(23,162,184,0.18);
        border: none;
        animation: modalPop .4s cubic-bezier(.4,2,.6,1) both;
    }
    @keyframes modalPop {
        0% { transform: scale(0.85); opacity: 0; }
        100% { transform: scale(1); opacity: 1; }
    }
    .custom-modal .modal-header {
        background: linear-gradient(90deg, #17a2b8 0%, #0dcaf0 100%);
        color: #fff;
        border-top-left-radius: 18px;
        border-top-right-radius: 18px;
        border-bottom: none;
        box-shadow: 0 2px 8px rgba(23,162,184,0.08);
    }
    .custom-modal .modal-title {
        font-weight: 600;
        font-size: 1.35rem;
        letter-spacing: 0.5px;
    }
    .custom-modal .btn-close {
        filter: invert(1);
    }
    .custom-modal .carousel-inner img {
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(23,162,184,0.10);
    }
    .custom-modal .modal-body {
        background: #1a2a36;
        border-bottom-left-radius: 18px;
        border-bottom-right-radius: 18px;
    }
    .custom-modal .product-info-title {
        color: #fff !important;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
    .custom-modal .badge-stock {
        font-size: 0.95rem;
        border-radius: 8px;
        padding: 4px 12px;
        margin-bottom: 10px;
    }
    .custom-modal .badge-stock.available {
        background: #1ed6a3;
        color: #fff !important;
    }
    .custom-modal .badge-stock.empty {
        background: #e74c3c;
        color: #fff !important;
    }
    .custom-modal .btn-info {
        background: linear-gradient(90deg, #17a2b8 0%, #0dcaf0 100%);
        border: none;
        color: #fff !important;
    }
    .custom-modal .btn-info:hover {
        background: linear-gradient(90deg, #0dcaf0 0%, #17a2b8 100%);
        color: #fff !important;
    }
    .product-main-container {
        padding-top: 110px;
        padding-bottom: 40px;
        background: #f8fafc;
    }
    .product-hero {
        background: linear-gradient(90deg, #e0f7fa 60%, #fff 100%);
        border-radius: 18px;
        box-shadow: 0 4px 24px rgba(13,202,240,0.08);
        padding: 2.5rem 2rem 2rem 2rem;
        margin-bottom: 2.5rem;
        display: flex;
        align-items: center;
        gap: 2rem;
        flex-wrap: wrap;
    }
    .product-hero-img {
        width: 120px;
        height: 120px;
        object-fit: contain;
        border-radius: 16px;
        background: #fff;
        box-shadow: 0 2px 12px rgba(13,202,240,0.10);
        margin-right: 1.5rem;
    }
    .product-hero-content h1 {
        font-size: 2.2rem;
        font-weight: 700;
        color: #0dcaf0;
        margin-bottom: 0.5rem;
    }
    .product-hero-content p {
        font-size: 1.1rem;
        color: #444;
        margin-bottom: 0.5rem;
    }
    .product-hero-content .hero-highlight {
        color: #0dcaf0;
        font-weight: 600;
    }
    @media (max-width: 767px) {
        .product-hero {
            flex-direction: column;
            text-align: center;
            padding: 1.5rem 1rem;
        }
        .product-hero-img {
            margin: 0 auto 1rem auto;
        }
    }
</style>

<div class="container product-main-container">
    <!-- Konten Hero/Product Introduction -->
    <div class="product-hero">
        {{-- <img src="{{ asset('fe/img/hero-product.png') }}" alt="Produk Apotek" class="product-hero-img"
             onerror="this.src='https://img.icons8.com/fluency/96/medicine.png'"> --}}
        <div class="product-hero-content">
            <h1>Temukan <span class="hero-highlight">Produk Kesehatan</span> Terbaik</h1>
            <p>
                Apotek Medicare menyediakan <span class="hero-highlight">obat-obatan, vitamin, suplemen, dan alat kesehatan</span> berkualitas untuk keluarga Anda.
                Dapatkan kemudahan belanja online, harga terjangkau, dan layanan cepat. 
            </p>
            <p>
                <i class="fa fa-truck-fast text-info"></i> Pengiriman cepat &nbsp; | &nbsp;
                <i class="fa fa-shield-heart text-info"></i> Produk original &nbsp; | &nbsp;
                <i class="fa fa-headset text-info"></i> Konsultasi gratis
            </p>
        </div>
    </div>
    <!-- Filter dan Daftar Produk -->
    {{-- <div class="mb-4">
        <h2 class="fw-bold mb-2" style="color:#222;">Daftar Produk</h2>
        <div class="product-filter-bar">
            <button class="filter-btn active" data-filter="all">Semua</button>
            @foreach($jenis_obats as $jenis)
                <button class="filter-btn" data-filter="jenis-{{ $jenis->id }}">{{ $jenis->jenis }}</button>
            @endforeach
        </div>
    </div>
    <div class="row g-0 gx-5 align-items-end">
        <div class="col-lg-6 text-start text-lg-end wow slideInRight" data-wow-delay="0.1s">
            <ul class="nav nav-pills d-inline-flex justify-content-end mb-5">
                @foreach ($jenis_obats as $index => $jenis)
                    <li class="nav-item me-2">
                        <a class="btn btn-outline-info border-2 {{ $index === 0 ? 'active' : '' }}"
                            data-bs-toggle="pill" href="#tab-{{ $jenis->id }}">{{ $jenis->jenis }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div> --}}
    <div class="tab-content">
        @foreach ($jenis_obats as $index => $jenis)
            <div id="tab-{{ $jenis->id }}" class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}">
                <div class="row g-4" id="productGrid">
                    @php
                        $obat_list = $obats->where('id_jenis', $jenis->id);
                    @endphp

                    @if ($obat_list->count() > 0)
                        @foreach ($obat_list as $item)
                            <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="product-item">
                                    <div class="position-relative bg-light overflow-hidden">
                                        <img class="img-fluid w-100" src="{{ asset('storage/' . $item->foto1) }}"
                                            alt="{{ $item->nama_obat }}"
                                            onerror="this.src='{{ asset('fe/img/default.jpg') }}'">
                                        @if ($item->stok > 0)
                                            <div
                                                class="bg-success rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">
                                                Tersedia ({{ $item->stok }})
                                            </div>
                                        @else
                                            <div
                                                class="bg-danger rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">
                                                Stok Habis
                                            </div>
                                        @endif
                                    </div>
                                    <div class="text-center p-4">
                                        <a class="d-block h5 mb-2">{{ $item->nama_obat }}</a>
                                        <span class="text-info me-1">Rp
                                            {{ number_format($item->harga_jual, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="d-flex border-top">
                                        <small class="w-50 text-center border-end py-2">
                                            <a class="text-body detail-btn" href="#" data-bs-toggle="modal"
                                                data-bs-target="#detailModal-{{ $item->id }}">
                                                <i class="fa fa-eye text-info me-2"></i>Detail
                                            </a>
                                        </small>
                                        <small class="w-50 text-center border-end py-2">
                                            @if(session('pelanggan'))
                                                <form action="{{ route('cart.add') }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $item->id }}">
                                                    <button type="submit" class="text-body detail-btn" style="background:none;border:none;padding:0;">
                                                        <i class="fa fa-shopping-bag text-info me-2"></i>Add to Cart
                                                    </button>
                                                </form>
                                            @else
                                                <button type="button" class="text-body detail-btn btn-cart-guest" style="background:none;border:none;padding:0;">
                                                    <i class="fa fa-shopping-bag text-info me-2"></i>Add to Cart
                                                </button>
                                            @endif
                                        </small>
                                    </div>
                                </div>
                            </div>

                            {{-- Modal Detail Product --}}
                            <div class="modal fade custom-modal" id="detailModal-{{ $item->id }}" tabindex="-1"
                                aria-labelledby="detailModalLabel-{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="detailModalLabel-{{ $item->id }}">
                                                <i class="fa fa-capsules me-2"></i>{{ $item->nama_obat }}
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body row align-items-center">
                                            <div class="col-md-5 mb-3 mb-md-0">
                                                <div id="carousel-{{ $item->id }}" class="carousel slide"
                                                    data-bs-ride="carousel">
                                                    <div class="carousel-inner">
                                                        <div class="carousel-item active">
                                                            <img src="{{ asset('storage/' . $item->foto1) }}"
                                                                class="d-block w-100" alt="Foto 1"
                                                                onerror="this.src='{{ asset('fe/img/default.jpg') }}'">
                                                        </div>
                                                        @if ($item->foto2)
                                                            <div class="carousel-item">
                                                                <img src="{{ asset('storage/' . $item->foto2) }}"
                                                                    class="d-block w-100" alt="Foto 2"
                                                                    onerror="this.src='{{ asset('fe/img/default.jpg') }}'">
                                                            </div>
                                                        @endif
                                                        @if ($item->foto3)
                                                            <div class="carousel-item">
                                                                <img src="{{ asset('storage/' . $item->foto3) }}"
                                                                    class="d-block w-100" alt="Foto 3"
                                                                    onerror="this.src='{{ asset('fe/img/default.jpg') }}'">
                                                            </div>
                                                        @endif
                                                    </div>
                                                    @if ($item->foto2 || $item->foto3)
                                                        <button class="carousel-control-prev" type="button"
                                                            data-bs-target="#carousel-{{ $item->id }}"
                                                            data-bs-slide="prev">
                                                            <span class="carousel-control-prev-icon"
                                                                aria-hidden="true"></span>
                                                            <span class="visually-hidden">Previous</span>
                                                        </button>
                                                        <button class="carousel-control-next" type="button"
                                                            data-bs-target="#carousel-{{ $item->id }}"
                                                            data-bs-slide="next">
                                                            <span class="carousel-control-next-icon"
                                                                aria-hidden="true"></span>
                                                            <span class="visually-hidden">Next</span>
                                                        </button>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="mb-2">
                                                    @if ($item->stok > 0)
                                                        <span class="badge badge-stock available"><i class="fa fa-check-circle me-1"></i> Tersedia ({{ $item->stok }})</span>
                                                    @else
                                                        <span class="badge badge-stock empty"><i class="fa fa-times-circle me-1"></i> Stok Habis</span>
                                                    @endif
                                                </div>
                                                <div class="product-info-title">Harga</div>
                                                <p class="mb-2 fs-5 fw-bold text-info">Rp {{ number_format($item->harga_jual, 0, ',', '.') }}</p>
                                                <div class="product-info-title">Deskripsi</div>
                                                <p class="mb-3">{{ $item->deskripsi_obat }}</p>
                                                <div class="mt-4">
                                                    <a href="#" class="btn btn-info px-4 py-2 rounded-pill text-white shadow-sm">
                                                        <i class="fa fa-shopping-bag me-2"></i>Tambah ke Keranjang
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12 text-center">
                            <p>Tidak ada produk tersedia untuk {{ $jenis->jenis }}</p>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.btn-cart-guest').forEach(function(btn) {
            btn.addEventListener('click', function() {
                Swal.fire({
                    icon: 'info',
                    title: 'Login Diperlukan',
                    text: 'Silakan login atau register sebagai pelanggan untuk menambah ke keranjang.',
                    showCancelButton: true,
                    confirmButtonText: 'Login',
                    cancelButtonText: 'Register',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('pelanggan.login') }}";
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        window.location.href = "{{ route('pelanggan.register') }}";
                    }
                });
            });
        });
    });
</script>
@endpush
@endsection

@section('footer')
    @include('fe.footer')
@endsection
