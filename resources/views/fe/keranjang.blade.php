<div class="container py-5">
    <h2 class="mb-4">Keranjang Belanja</h2>

    @if (count($cart_items ?? []) > 0)
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        @foreach ($cart_items as $item)
                            <div class="row mb-3 border-bottom pb-3">
                                <div class="col-md-3">
                                    <img src="{{ asset('storage/' . $item->product->image) }}" class="img-fluid rounded"
                                        alt="{{ $item->product->name }}">
                                </div>
                                <div class="col-md-9">
                                    <h5>{{ $item->product->name }}</h5>
                                    <p class="text-muted">Rp {{ number_format($item->product->price, 0, ',', '.') }}</p>
                                    <div class="d-flex align-items-center">
                                        <form action="{{ route('cart.update', $item->id) }}" method="POST"
                                            class="d-flex align-items-center">
                                            @csrf
                                            @method('PUT')
                                            <button type="button" class="btn btn-sm btn-secondary"
                                                onclick="decrementQty(this)">-</button>
                                            <input type="number" name="quantity" value="{{ $item->quantity }}"
                                                class="form-control mx-2" style="width: 60px">
                                            <button type="button" class="btn btn-sm btn-secondary"
                                                onclick="incrementQty(this)">+</button>
                                            <button type="submit" class="btn btn-sm btn-primary ms-2">Update</button>
                                        </form>
                                        <form action="{{ route('cart.remove', $item->id) }}" method="POST"
                                            class="ms-3">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
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
                            <strong>Rp {{ number_format($total_price ?? 0, 0, ',', '.') }}</strong>
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
        function incrementQty(btn) {
            const input = btn.previousElementSibling;
            input.value = parseInt(input.value) + 1;
        }

        function decrementQty(btn) {
            const input = btn.nextElementSibling;
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
            }
        }
    </script>
@endpush