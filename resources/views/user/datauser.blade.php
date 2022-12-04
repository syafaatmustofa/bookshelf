@extends('layouts.app')


@section('content')
{{-- tabel data kategori --}}
<h3 align="center">Kelola Data User</h3>
<table class="table table table-striped table-hover">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahdata">TAMBAH</button>
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            <th scope="col">Status</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $item)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $item->name }}</td>
            <td>{{ $item->email }}</td>
            <td>{{ $item->role }}</td>
            <td>{{ $item->status }}</td>
            <td>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editdata{{ $item->id }}">EDIT</button>
                <a href="{{ route('deleteuser',$item->id) }}" class="btn btn-danger" onclick="return confirm('Yakin Ingin Menghapus ?')">DELETE</a>
            </td>
        </tr>

        {{-- tabel kategori --}}

        <!-- Modal edit data S-->

        <div class="modal fade" id="editdata{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('datauser.update', $item->id) }}" method="POST" id="idform" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label for="exampleInput" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="name" id="exampleInput" value="{{ $item->name }}">
                            </div>
                            <div>
                                <label for="exampleInput" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="exampleInput" value="{{ $item->email }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInput" class="form-label">role</label>
                                <input type="text" class="form-control" name="role" id="exampleInput" value="{{ $item->role }}">
                            </div>
                            <div class="mb-3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" {{ $item->status == 'aktif' ? 'checked':'' }} name="status" id="inlineRadio1" value="aktif">
                                    <label class="form-check-label" for="inlineRadio1">Aktif</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" {{ $item->status == 'tidak aktif' ? 'checked':'' }} name="status" id="inlineRadio2" value="tidak aktif">
                                    <label class="form-check-label" for="inlineRadio2">Tidak Aktif</label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Back</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
        @endforeach
    </tbody>
</table>
{{-- modal edit data en --}}


<!-- Modal tambah data S-->
<div class="modal fade" id="tambahdata" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('datauser.store') }}" method="POST" id="idform" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInput" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="name" id="exampleInput">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInput" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="exampleInput">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInput" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="exampleInput">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Back</button>
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- modal tambah data en --}}


@endsection
