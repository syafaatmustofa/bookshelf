@extends('layouts.app')


@section('content')
{{-- tabel data kategori --}}
<h3 align="center">Kelola Kategori</h3>
<table class="table table table-striped table-hover">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahdata">TAMBAH</button>
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">ID</th>
            <th scope="col">Nama Kategori</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $item)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $item->id }}</td>
            <td>{{ $item->nama }}</td>
            <td>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editdata{{ $item->id }}">EDIT</button>
                <a href="{{ route('deletekategori',$item->id) }}" class="btn btn-danger" onclick="return confirm('Yakin Ingin Menghapus ?')">DELETE</a>
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
                        <form action="{{ route('kategori.update', $item->id) }}" method="POST" id="idform">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label for="exampleInput" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="nama" id="exampleInput" value="{{ $item->nama }}">
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
                <form action="{{ route('kategori.store') }}" method="POST" id="idform">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInput" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" id="exampleInput">
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
