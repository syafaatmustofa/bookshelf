@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <h1 align='center'>List Buku</h1>
        @foreach($data as $item)
        <div class="col-3 mt-2">
            <div class="card ms-3" style="width: 18rem;">
                <img src="{{ asset('storage/'.$item->cover) }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $item->judul }}</h5>
                    <p class="card-text">{{ $item->penulis }}</p>
                    <a href="{{ route('buku.show',$item->id) }}" class="btn btn-primary">Detail</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
