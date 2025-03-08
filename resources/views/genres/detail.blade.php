@extends('layouts.master')
@section('title')
    Detail Genres
@endsection
@section('content')
    <h1>{{$genre->name}}</h1>
    <p>{{$genre->description}}</p>

    <hr>

    <div class="row">
        @forelse ($genre->Books as $item)
            <div class="col-4">
                <div class="card">
                    <img src="{{asset('image/'.$item->image)}}" class="card-img-top" height="300px" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{$item->title}}</h5>
                        <p class="card-text">{{Str::limit($item->summary, 100)}}</p>
                        <div class="d-grid gap-2">
                            <a href="/book/{{$item->id}}" class="btn btn-info">
                                Read More
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
        <h1>Tidak ada buku di Genre ini</h1>
        @endforelse
    </div>
    <a href="/genre" class="btn btn-secondary btn-sm my-3">Kembali</a>
@endsection
