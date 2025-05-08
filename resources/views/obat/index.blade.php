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
                                    <h4 class="mb-0">Daftar Obat</h4>
                                    <a href="{{ route('obat.create') }}" class="btn btn-primary">
                                    Tambah Obat
                                    </a>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('obat.index') }}" method="GET" class="mb-4">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="search" 
                                                        placeholder="Cari nama obat..." value="{{ request('search') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    <select class="form-control" name="jenis">
                                                        <option value="">Semua Jenis Obat</option>
                                                        {{-- @foreach($jenis_obat as $jenis)
                                                            <option value="{{ $jenis->id }}" {{ request('jenis') == $jenis->id ? 'selected' : '' }}>
                                                                {{ $jenis->jenis }}
                                                            </option>
                                                        @endforeach --}}
                                                    </select>
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
                                                    <th class="align-middle fw-bold" width="20%">Nama Obat</th>
                                                    <th class="align-middle fw-bold" width="15%">Jenis</th>
                                                    <th class="align-middle fw-bold" width="15%">Deskripsi</th>
                                                    <th class="align-middle fw-bold" width="12%">Harga</th>
                                                    <th class="align-middle fw-bold" width="8%">Stok</th>
                                                    <th class="align-middle text-center fw-bold" width="15%">Gambar</th>
                                                    <th class="text-center align-middle fw-bold" width="10%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody class="font-medium">
                                                @foreach ($obats as $item)
                                                    <tr class="align-middle">
                                                        <td class="text-center">{{ $loop->iteration }}</td>
                                                        <td>{{ $item->nama_obat }}</td>
                                                        <td>{{ optional($item->jenis_obat)->jenis }}</td>
                                                        <td class="font-small">{{ Str::limit($item->deskripsi_obat, 50) }}
                                                        </td>
                                                        <td>Rp {{ number_format($item->harga_jual, 0, ',', '.') }}</td>
                                                        <td>{{ $item->stok }}</td>
                                                        <td class="text-center">
                                                            <img src="{{ asset('storage/' . $item->foto1) }}"
                                                                alt="Foto Obat" class="rounded" width="60"
                                                                height="60" style="object-fit: cover;">
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="btn-group">
                                                                <a href="{{ route('obat.edit', $item->id) }}"
                                                                    class="btn btn-sm btn-warning me-1">Edit</a>
                                                                <form action="{{ route('obat.destroy', $item->id) }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                                        onclick="return confirm('Yakin ingin menghapus?')">
                                                                        Hapus
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                    {{-- <tr>
                                                        <td colspan="8" class="text-center text-muted">Data obat tidak ditemukan.</td>
                                                    </tr>
                                                @endforelse --}}
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
@endsection
