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
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Edit Distributor</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('distributor.update', $distributor->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Nama Distributor</label>
                                                    <input type="text"
                                                        class="form-control @error('nama_distributor') is-invalid @enderror"
                                                        name="nama_distributor"
                                                        value="{{ old('nama_distributor', $distributor->nama_distributor) }}"
                                                        required>
                                                    @error('nama_distributor')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Telepon</label>
                                                    <input type="text"
                                                        class="form-control @error('telepon') is-invalid @enderror"
                                                        name="telepon" value="{{ old('telepon', $distributor->telepon) }}"
                                                        required>
                                                    @error('telepon')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Alamat</label>
                                                    <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" rows="3" required>{{ old('alamat', $distributor->alamat) }}</textarea>
                                                    @error('alamat')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <a href="{{ route('distributor.index') }}"
                                                class="btn btn-secondary me-2">Batal</a>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
