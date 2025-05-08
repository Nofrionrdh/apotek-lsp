@extends('be.master')
@section('sidebar')
    @include('be.sidebar')
@endsection

@section('content-obat')
    <div class="pcoded-content">
        <div class="pcoded-inner-content px-4">
            <div class="main-body">
                <div class="page-wrapper">
                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow-sm mt-4 mx-2">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4 class="mb-0">Daftar Pembelian</h4>
                                    <a href="{{ route('pembelian.create') }}" class="btn btn-primary">
                                        Tambah Pembelian
                                    </a>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('pembelian.index') }}" method="GET" class="mb-4">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="search"
                                                        placeholder="Cari no nota..." value="{{ request('search') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <button class="btn btn-primary w-100" type="submit">
                                                    <i class="fas fa-search"></i> Cari
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="table-responsive">
                                        <table class="table table-borderless table-striped font-roboto">
                                            <thead>
                                                <tr class="bg-light">
                                                    <th class="text-center align-middle fw-bold" width="5%">No</th>
                                                    <th class="align-middle fw-bold" width="15%">No Nota</th>
                                                    <th class="align-middle fw-bold" width="15%">Tanggal Pembelian</th>
                                                    <th class="align-middle fw-bold" width="20%">Distributor</th>
                                                    <th class="align-middle fw-bold" width="15%">Total Bayar</th>
                                                    <th class="align-middle fw-bold" width="15%">Obat</th>
                                                    <th class="text-center align-middle fw-bold" width="10%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody class="font-medium">
                                                @foreach ($pembelian as $item)
                                                    <tr class="align-middle">
                                                        <td class="text-center">{{ $loop->iteration }}</td>
                                                        <td>{{ $item->no_nota }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($item->tgl_pembelian)->format('d/m/Y') }}
                                                        </td>
                                                        <td>{{ $item->distributor->nama_distributor }}</td>
                                                        <td>Rp {{ number_format($item->total_bayar, 0, ',', '.') }}</td>
                                                        <td>
                                                            @foreach ($item->details as $detail)
                                                                {{ $detail->obat->nama_obat ?? '-' }}<br>
                                                            @endforeach
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn-sm btn-info me-1"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#detailPembelianModal-{{ $item->id }}">
                                                                    <i class="fa-solid fa-circle-info"></i>
                                                                </button>
                                                                <a href="{{ route('pembelian.edit', $item->id) }}"
                                                                    class="btn btn-sm btn-warning me-1"><i class="fa-solid fa-pencil"></i></a>
                                                                <form action="{{ route('pembelian.destroy', $item->id) }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                                        onclick="return confirm('Yakin ingin menghapus?')">
                                                                        <i class="fa-solid fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
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
    </div>

    {{-- Modal Detail Pembelian --}}
    @foreach ($pembelian as $item)
        <div class="modal fade" id="detailPembelianModal-{{ $item->id }}" tabindex="-1"
            aria-labelledby="detailPembelianLabel-{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="detailPembelianLabel-{{ $item->id }}">Detail Pembelian - {{ $item->no_nota }}</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    {{-- <th>No</th> --}}
                                    <th>Id</th>
                                    <th>Nama Obat</th>
                                    <th>Jumlah Beli</th>
                                    <th>Harga Beli</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($item->details as $i => $detail)
                                    <tr>
                                        {{-- <td>{{ $i + 1 }}</td> --}}
                                        <td>{{ $detail->id }}</td>
                                        <td>{{ $detail->obat->nama_obat ?? '-' }}</td>
                                        <td>{{ $detail->jumlah_beli }}</td>
                                        <td>Rp {{ number_format($detail->harga_beli, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
