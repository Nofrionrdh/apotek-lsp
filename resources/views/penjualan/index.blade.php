@extends('be.master')
@section('sidebar')
    @include('be.sidebar')
@endsection

@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Daftar Penjualan</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>ID Penjualan</th>
                                                <th>Nama Obat</th>
                                                <th>Jumlah Beli</th>
                                                <th>Harga Beli</th>
                                                <th>Subtotal</th>
                                                <th>Tanggal</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($penjualan as $index => $item)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $item->id_penjualan }}</td>
                                                    <td>{{ $item->obat->nama_obat }}</td>
                                                    <td>{{ $item->jumlah_beli }}</td>
                                                    <td>Rp {{ number_format($item->harga_beli, 0, ',', '.') }}</td>
                                                    <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                                    <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                                                    <td>
                                                        <button class="btn btn-info btn-sm">Detail</button>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8" class="text-center">Tidak ada data penjualan</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
