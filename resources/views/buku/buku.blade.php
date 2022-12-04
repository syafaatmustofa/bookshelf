@extends('layouts.app')


@section('content')
{{-- tabel data kategori --}}
<h3 align="center">Kelola Book</h3>
<table class="table table table-striped table-hover">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahdata">TAMBAH</button>
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Judul</th>
            <th scope="col">Isi</th>
            <th scope="col">Penulis</th>
            <th scope="col">Total Pembaca</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Cover</th>
            <th scope="col">Nama Kategori</th>
            <th scope="col">Tampilkan</th>
            <th scope="col">User</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $item)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $item->judul }}</td>
            <td>{{ $item->isi }}</td>
            <td>{{ $item->penulis }}</td>
            <td>{{ $item->total_pembaca }}</td>
            <td>{{ $item->tanggal }}</td>
            <td><img src="{{ asset('storage/'.$item->cover) }}" class="rounded" width="100px"></td>
            <td>{{ $item->kategori->nama }}</td>
            <td>
                @if ($item->tampilkan == 1)
                <span>Tampil</span>
                @else
                <span>Tidak Tampil</span>
                @endif
            </td>
            <td>{{ $item->user_id }}</td>
            <td>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editdata{{ $item->id }}">EDIT</button>
                <a href="{{ route('deletebuku',$item->id) }}" class="btn btn-danger" onclick="return confirm('Yakin Ingin Menghapus ?')">DELETE</a>
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
                        <form action="{{ route('buku.update', $item->id) }}" method="POST" id="idform" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label for="exampleInput" class="form-label">Judul</label>
                                <input type="text" class="form-control" name="judul" id="exampleInput" value="{{ $item->judul }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInput" class="form-label">isi</label>
                                <textarea name="isi" id="idform" class="form-control" cols="30" rows="10">{{ $item->isi }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInput" class="form-label">Penulis</label>
                                <input type="text" class="form-control" name="penulis" id="exampleInput" value="{{ $item->penulis }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInput" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal" id="exampleInput" value="{{ $item->tanggal }}">
                            </div>
                            <img src="{{ asset('storage/'.$item->cover) }}" alt="">
                            <div class="mb-3">
                                <label for="exampleInput" class="form-label">Cover</label>
                                <input type="file" class="form-control" name="cover" id="exampleInput" value="{{ $item->cover }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInput" class="form-label">Kategori</label>
                                <select name="kategori_id">
                                    <option value="" selected>--Pilih Kategori--</option>
                                    @foreach($kategori as $kt)
                                    <option value="{{ $kt->id }}" {{ $kt->id == $item->kategori_id? 'selected' : '' }}>{{ $kt->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" {{ $item->tampilkan == 1 ? 'checked':'' }} name="tampilkan" id="inlineRadio1" value="1">
                                    <label class="form-check-label" for="inlineRadio1">Tampilkan</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" {{ $item->tampilkan == 0 ? 'checked':'' }} name="tampilkan" id="inlineRadio2" value="0">
                                    <label class="form-check-label" for="inlineRadio2">Sembunyikan</label>
                                </div>
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
                <form action="{{ route('buku.store') }}" method="POST" id="idform" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInput" class="form-label">Judul</label>
                        <input type="text" class="form-control" name="judul" id="exampleInput">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInput" class="form-label">isi</label>
                        {{-- <input type="text" class="form-control" name="judul" id="exampleInput"> --}}
                        <textarea name="isi" id="idform" class="form-control" cols="30" rows="10"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInput" class="form-label">Penulis</label>
                        <input type="text" class="form-control" name="penulis" id="exampleInput">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInput" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" id="exampleInput">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInput" class="form-label">Cover</label>
                        <input type="file" class="form-control" name="cover" id="exampleInput">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInput" class="form-label">Kategori</label>
                        <select name="kategori_id">
                            <option value="" selected>--Pilih Kategori--</option>
                            @foreach($kategori as $kt)
                            <option value="{{ $kt->id }}">{{ $kt->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInput" class="form-label">User</label>
                        <input type="text" readonly class="form-control" name="user_id" id="exampleInput" aria-describedby="emailHelp" value="{{ Auth::user()->id }}">
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
