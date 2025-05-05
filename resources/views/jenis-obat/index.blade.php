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
                                    <h4 class="mb-0">Daftar Jenis Obat</h4>
                                    <a href="{{ route('jenis-obat.create') }}" class="btn btn-primary">Tambah Jenis Obat</a>
                                </div>
                                <div class="card-body">
                                    @if (session('success'))
                                        <div class="alert alert-success">{{ session('success') }}</div>
                                    @endif
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Gambar</th>
                                                    <th>Nama Jenis</th>
                                                    <th>Deskripsi</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($jenis_obat as $index => $jenis)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td><img src="{{ asset($jenis->image_url) }}" alt="Gambar"
                                                                width="50"></td>
                                                        <td>{{ $jenis->jenis }}</td>
                                                        <td>{{ $jenis->deskripsi_jenis }}</td>
                                                        <td>
                                                            <a href="{{ route('jenis-obat.edit', $jenis->id) }}"
                                                                class="btn btn-sm btn-warning">Edit</a>
                                                            <form action="{{ route('jenis-obat.destroy', $jenis->id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger"
                                                                    onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                                            </form>
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
@endsection
