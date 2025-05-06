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
</style>

<div class="container-xxl py-5" id="product">
    <div class="container">
        <div class="row g-0 gx-5 align-items-end">
            <div class="col-lg-6">
                <div class="section-header text-start mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                    <h1 class="display-5 mb-3">Produk Kesehatan Kami</h1>
                    <p>Kami menyediakan beragam produk kesehatan terbaik, mulai dari obat-obatan, vitamin, suplemen,
                        hingga alat kesehatan, untuk mendukung kebutuhan kesehatan Anda setiap hari.</p>
                </div>
            </div>
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
        </div>
        <div class="tab-content">
            @foreach ($jenis_obats as $index => $jenis)
                <div id="tab-{{ $jenis->id }}" class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}">
                    <div class="row g-4">
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
                                                <form action="{{ route('cart.add') }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $item->id }}">
                                                    <button type="submit" class="text-body detail-btn" style="background:none;border:none;padding:0;">
                                                        <i class="fa fa-shopping-bag text-info me-2"></i>Add to Cart
                                                    </button>
                                                </form>
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
</div>
