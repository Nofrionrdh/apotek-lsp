<div class="container-xxl py-5">
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
                                                <a class="text-body" href="{{ route('obat.show', $item->id) }}">
                                                    <i class="fa fa-eye text-info me-2"></i>Detail
                                                </a>
                                            </small>
                                            <small class="w-50 text-center py-2">
                                                <a class="text-body" href="#">
                                                    <i class="fa fa-shopping-bag text-info me-2"></i>Keranjang
                                                </a>
                                            </small>
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
