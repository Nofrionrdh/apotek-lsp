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
                                    <h4 class="mb-0">Daftar User</h4>
                                    <a href="{{ route('manage-user.create') }}" class="btn btn-primary">
                                        Tambah User
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-borderless table-striped">
                                            <thead>
                                                <tr class="bg-light">
                                                    <th width="5%">No</th>
                                                    <th width="20%">Nama</th>
                                                    <th width="25%">Email</th>
                                                    {{-- <th width="15%">No HP</th> --}}
                                                    <th width="15%">Jabatan</th>
                                                    <th width="20%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $user)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        {{-- <td>{{ $user->no_hp }}</td> --}}
                                                        <td>{{ $user->jabatan }}</td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <a href="{{ route('manage-user.edit', $user->id) }}"
                                                                    class="btn btn-sm btn-warning me-1"><i class="fa-solid fa-pencil"></i></a>
                                                                <form action="{{ route('manage-user.destroy', $user->id) }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                                        onclick="return confirm('Yakin ingin menghapus user ini?')">
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

