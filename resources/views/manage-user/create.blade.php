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
                                    <h4 class="mb-0">Tambah User</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('manage-user.store') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Nama</label>
                                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                                        name="name" value="{{ old('name') }}" required>
                                                    @error('name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Email</label>
                                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                                        name="email" value="{{ old('email') }}" required>
                                                    @error('email')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                {{-- <div class="mb-3">
                                                    <label class="form-label">No. HP</label>
                                                    <input type="text" class="form-control @error('no_hp') is-invalid @enderror" 
                                                        name="no_hp" value="{{ old('no_hp') }}" required>
                                                    @error('no_hp')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div> --}}
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Password</label>
                                                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                                        name="password" required>
                                                    @error('password')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Konfirmasi Password</label>
                                                    <input type="password" class="form-control" 
                                                        name="password_confirmation" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Jabatan</label>
                                                    <select class="form-select @error('jabatan') is-invalid @enderror" 
                                                        name="jabatan" required>
                                                        <option value="">Pilih Jabatan</option>
                                                        <option value="admin" {{ old('jabatan') == 'admin' ? 'selected' : '' }}>Admin</option>
                                                        <option value="apoteker" {{ old('jabatan') == 'apoteker' ? 'selected' : '' }}>Apoteker</option>
                                                        <option value="kasir" {{ old('jabatan') == 'kasir' ? 'selected' : '' }}>Kasir</option>
                                                        <option value="karyawan" {{ old('jabatan') == 'karyawan' ? 'selected' : '' }}>Karyawan</option>
                                                        <option value="pemilik" {{ old('jabatan') == 'pemilik' ? 'selected' : '' }}>Pemilik</option>
                                                    </select>
                                                    @error('jabatan')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <a href="{{ route('manage-user.index') }}" class="btn btn-secondary me-2">Batal</a>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
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
