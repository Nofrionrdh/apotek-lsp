@extends('fe.master')
@section('profile')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h3 class="mb-4 text-info">Profil Saya</h3>
                    <form action="{{ route('profile.update', $pelanggan->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mb-4 align-items-center">
                            <div class="col-md-3 text-center">
                                <img src="{{ $pelanggan->foto ? asset('storage/'.$pelanggan->foto) : asset('fe/img/default-profile.png') }}"
                                    alt="Foto Profil" class="rounded-circle shadow" style="width: 100px; height: 100px; object-fit: cover;">
                                <div class="mt-2">
                                    <input type="file" name="foto" class="form-control form-control-sm" accept="image/*">
                                    <small class="text-muted">Format: jpg, png. Maks 2MB.</small>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="mb-3">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" name="nama_pelanggan" class="form-control" value="{{ old('nama_pelanggan', $pelanggan->nama_pelanggan) }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email', $pelanggan->email) }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">No. Telepon</label>
                                    <input type="text" name="no_telp" class="form-control" value="{{ old('no_telp', $pelanggan->no_telp) }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Kata Kunci (Password)</label>
                                    <input type="password" name="katakunci" class="form-control" placeholder="Isi jika ingin mengganti password">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h5 class="mb-3 text-info">Alamat Utama</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Alamat</label>
                                <input type="text" name="alamat1" class="form-control" value="{{ old('alamat1', $pelanggan->alamati) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kota</label>
                                <input type="text" name="kota1" class="form-control" value="{{ old('kota1', $pelanggan->kota1) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Provinsi</label>
                                <input type="text" name="propinsi1" class="form-control" value="{{ old('propinsi1', $pelanggan->propinsti) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kode Pos</label>
                                <input type="text" name="kodepos1" class="form-control" value="{{ old('kodepos1', $pelanggan->kodepos1) }}">
                            </div>
                        </div>
                        <hr>
                        <h5 class="mb-3 text-info">Alamat Lainnya</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Alamat 2</label>
                                <input type="text" name="alamat2" class="form-control" value="{{ old('alamat2', $pelanggan->alamai2) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kota 2</label>
                                <input type="text" name="kota2" class="form-control" value="{{ old('kota2', $pelanggan->kota2) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Provinsi 2</label>
                                <input type="text" name="propinsi2" class="form-control" value="{{ old('propinsi2', $pelanggan->propinsi2) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kode Pos 2</label>
                                <input type="text" name="kodepos2" class="form-control" value="{{ old('kodepos2', $pelanggan->kodepos2) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Alamat 3</label>
                                <input type="text" name="alamat3" class="form-control" value="{{ old('alamat3', $pelanggan->alamai3) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kota 3</label>
                                <input type="text" name="kota3" class="form-control" value="{{ old('kota3', $pelanggan->kota3) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Provinsi 3</label>
                                <input type="text" name="propinsi3" class="form-control" value="{{ old('propinsi3', $pelanggan->propinsi3) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kode Pos 3</label>
                                <input type="text" name="kodepos3" class="form-control" value="{{ old('kodepos3', $pelanggan->kodepos3) }}">
                            </div>
                        </div>
                        <hr>
                        <div class="mb-3">
                            <label class="form-label">URL KTP</label>
                            <input type="text" name="url_ktp" class="form-control" value="{{ old('url_ktp', $pelanggan->url_ktp) }}">
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-info px-4">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection