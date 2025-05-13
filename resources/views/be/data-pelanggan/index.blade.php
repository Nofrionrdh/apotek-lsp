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
                                <h4 class="card-title mb-0">Data Pelanggan</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>No. Telp</th>
                                                <th>Alamat 1</th>
                                                <th>Kota 1</th>
                                                <th>Provinsi 1</th>
                                                <th>Kodepos 1</th>
                                                <th>Foto</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($pelanggans as $p)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $p->nama_pelanggan }}</td>
                                                <td>{{ $p->email }}</td>
                                                <td>{{ $p->no_telp }}</td>
                                                <td>{{ $p->alamat1 }}</td>
                                                <td>{{ $p->kota1 }}</td>
                                                <td>{{ $p->propinsi1 }}</td>
                                                <td>{{ $p->kodepos1 }}</td>
                                                <td>
                                                    @if($p->foto)
                                                        <img src="{{ asset('storage/'.$p->foto) }}" alt="Foto" width="50" height="50" style="object-fit:cover;">
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <form action="{{ route('data-pelanggan.destroy', $p->id) }}" method="POST" class="d-inline form-delete">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-sm btn-danger btn-delete">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @if($pelanggans->isEmpty())
                                            <tr>
                                                <td colspan="10" class="text-center text-muted">Tidak ada data pelanggan.</td>
                                            </tr>
                                            @endif
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

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.btn-delete');
        deleteButtons.forEach(function (btn) {
            btn.addEventListener('click', function () {
                const form = btn.closest('form');

                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: "Data yang dihapus tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endpush
@endsection
