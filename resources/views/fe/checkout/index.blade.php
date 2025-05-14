@extends('fe.master')

@section('checkout')
<div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container">
        <h1 class="display-3 mb-3 animated slideInDown">Product Checkout</h1>
    </div>
</div>

<div class="container py-5">
    <div class="row">
        <div class="col-12">
            @if($orders->count() > 0)
                @foreach($orders as $order)
                <div class="card mb-4">
                    <div class="card-header bg-info text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Order #{{ $order->no_transaksi }}</span>
                            <span>{{ $order->created_at->format('d M Y H:i') }}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <h5>Status Pengiriman</h5>
                                @if($order->pengiriman)
                                    <div class="timeline">
                                        <div class="step {{ $order->pengiriman->status_kirim == 'Sedang Dikirim' ? 'active' : '' }}">
                                            <i class="fas fa-box"></i>
                                            <p>Pesanan Dikemas</p>
                                            <small>{{ $order->pengiriman->tgl_kirim }}</small>
                                        </div>
                                        <div class="step {{ $order->pengiriman->status_kirim == 'Tiba Ditujuan' ? 'active' : '' }}">
                                            <i class="fas fa-check-circle"></i>
                                            <p>Pesanan Diterima</p>
                                            <small>{{ $order->pengiriman->tgl_tiba ?? '-' }}</small>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <p><strong>Kurir:</strong> {{ $order->pengiriman->nama_kurir }}</p>
                                        <p><strong>No. Telepon Kurir:</strong> {{ $order->pengiriman->telpon_kurir }}</p>
                                    </div>
                                @else
                                    <p class="text-muted">Pengiriman belum diproses</p>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <div class="text-end">
                                    <h6>Total Pembayaran</h6>
                                    <h4 class="text-info">Rp {{ number_format($order->total_bayar, 0, ',', '.') }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="text-center py-5">
                    <h4>Belum ada pesanan</h4>
                    <a href="{{ route('product.index') }}" class="btn btn-info mt-3">Mulai Belanja</a>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
.timeline {
    display: flex;
    align-items: center;
    margin: 20px 0;
}

.step {
    flex: 1;
    text-align: center;
    position: relative;
    color: #6c757d;
}

.step.active {
    color: #0dcaf0;
}

.step i {
    font-size: 24px;
    margin-bottom: 8px;
}

.step:not(:last-child):after {
    content: '';
    position: absolute;
    top: 12px;
    left: 60%;
    width: 80%;
    height: 2px;
    background: #dee2e6;
}

.step.active:after {
    background: #0dcaf0;
}
</style>
@endsection

@section('footer')
    @include('fe.footer')
@endsection
