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
                                    <h4 class="mb-0">Daftar Distributor</h4>
                                    <a href="{{ route('distributor.create') }}" class="btn btn-primary">
                                        Tambah Distributor
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-borderless table-striped">
                                            <thead>
                                                <tr class="bg-light">
                                                    <th width="5%">No</th>
                                                    <th width="25%">Nama Distributor</th>
                                                    <th width="20%">Telepon</th>
                                                    <th width="35%">Alamat</th>
                                                    <th width="15%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($distributor as $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $item->nama_distributor }}</td>
                                                        <td>{{ $item->telepon }}</td>
                                                        <td>{{ $item->alamat }}</td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <a href="{{ route('distributor.edit', $item->id) }}"
                                                                    class="btn btn-sm btn-warning me-1"><i class="fa-solid fa-pencil"></i></a>
                                                                <form action="{{ route('distributor.destroy', $item->id) }}"
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
@endsection
