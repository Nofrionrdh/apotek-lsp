@extends('fe.master')
@section('keranjang')

    <div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <h1 class="display-3 mb-3 animated slideInDown">Keranjang</h1>
        </div>
    </div>

    <div class="container py-5">
        <h2 class="mb-4">Keranjang Obat</h2>

        @if (count($cart_items ?? []) > 0)
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            @foreach ($cart_items as $index => $item)
                                <div class="row mb-3 border-bottom pb-3 align-items-center">
                                    <div class="col-md-1 d-flex justify-content-center align-items-center">
                                        <label class="custom-checkbox">
                                            <input type="checkbox" class="cart-checkbox" data-index="{{ $index }}"
                                                data-price="{{ $item['price'] * $item['quantity'] }}" checked>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="col-md-3">
                                        <img src="{{ asset('storage/' . $item['image']) }}" class="img-fluid rounded"
                                            alt="{{ $item['name'] }}">
                                    </div>
                                    <div class="col-md-8">
                                        <h5>{{ $item['name'] }}</h5>
                                        <p class="text-muted mb-1">Harga Satuan: Rp
                                            {{ number_format($item['price'], 0, ',', '.') }}</p>
                                        <div class="d-flex align-items-center mb-2">
                                            <form action="{{ route('cart.updateQuantity', $item['id']) }}" method="POST"
                                                class="d-flex align-items-center me-2 update-qty-form">
                                                @csrf
                                                <button type="button" class="btn btn-sm btn-danger fw-bold">-</button>
                                                <input type="number" name="quantity" value="{{ $item['quantity'] }}"
                                                    class="form-control mx-2 quantity-input text-center" style="width: 60px" min="1" readonly>
                                                <button type="button" class="btn btn-sm btn-success fw-bold">+</button>
                                            </form>
                                            <form action="{{ route('cart.remove', $item['id']) }}" method="POST"
                                                onsubmit="return confirm('Hapus produk ini dari keranjang?')">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger ms-2">Hapus</button>
                                            </form>
                                        </div>
                                        <div>
                                            <span class="fw-bold">Subtotal:</span>
                                            <span class="text-info subtotal-display">
                                                Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Ringkasan Belanja</h5>
                            <div class="d-flex justify-content-between mt-3">
                                <span>Total Harga</span>
                                <strong id="total-harga-display">Rp
                                    {{ number_format($total_price ?? 0, 0, ',', '.') }}</strong>
                            </div>
                            <button class="btn btn-primary w-100 mt-3">Lanjut ke Pembayaran</button>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <h4>Keranjang Belanja Kosong</h4>
                <a href="{{ url('/') }}" class="btn btn-primary mt-3">Mulai Belanja</a>
            </div>
        @endif
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Tombol +
                document.querySelectorAll('.update-qty-form .btn-success').forEach(function(btn) {
                    btn.addEventListener('click', function() {
                        const form = btn.closest('.update-qty-form');
                        const input = form.querySelector('input[name="quantity"]');
                        input.value = parseInt(input.value) + 1;
                        updateSubtotal(input);
                        submitQtyForm(form);
                    });
                });

                // Tombol -
                document.querySelectorAll('.update-qty-form .btn-danger').forEach(function(btn) {
                    btn.addEventListener('click', function() {
                        const form = btn.closest('.update-qty-form');
                        const input = form.querySelector('input[name="quantity"]');
                        if (parseInt(input.value) > 1) {
                            input.value = parseInt(input.value) - 1;
                            updateSubtotal(input);
                            submitQtyForm(form);
                        }
                    });
                });

                function submitQtyForm(form) {
                    const url = form.action;
                    const token = form.querySelector('input[name="_token"]').value;
                    const qty = form.querySelector('input[name="quantity"]').value;
                    fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': token,
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ quantity: qty })
                    }).then(response => {
                        // Optionally handle response
                    });
                }

                function updateSubtotal(input) {
                    const form = input.closest('form');
                    const priceText = form.closest('.col-md-8').querySelector('.text-muted').innerText;
                    const price = parseInt(priceText.replace(/\D/g, ''));
                    const subtotal = price * parseInt(input.value);
                    form.closest('.col-md-8').querySelector('.subtotal-display').innerText = 'Rp ' + subtotal.toLocaleString('id-ID');
                    const checkbox = form.closest('.row').querySelector('.cart-checkbox');
                    if (checkbox) {
                        checkbox.setAttribute('data-price', subtotal);
                    }
                    updateTotalHarga();
                }

                function updateTotalHarga() {
                    let total = 0;
                    document.querySelectorAll('.cart-checkbox').forEach(function(checkbox) {
                        if (checkbox.checked) {
                            total += parseInt(checkbox.getAttribute('data-price'));
                        }
                    });
                    document.getElementById('total-harga-display').innerText = 'Rp ' + total.toLocaleString('id-ID');
                }

                document.querySelectorAll('.cart-checkbox').forEach(function(checkbox) {
                    checkbox.addEventListener('change', updateTotalHarga);
                });

                // Inisialisasi total harga saat halaman dimuat
                updateTotalHarga();
            });
        </script>
    @endpush
@endsection
@section('footer')
    @include('fe.footer')
@endsection
