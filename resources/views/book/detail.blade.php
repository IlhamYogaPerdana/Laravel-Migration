@extends('layouts.master')
@section('title')
    Detail Book
@endsection
@section('content')

<img src="{{asset('image/' . $book->image)}}" width="100%" height="500px" alt="">
    <h1 class="text-primary">{{$book->title}}</h1>
    <p>Summary : {{$book->summary}}</p>
    <p>Stock : {{$book->stock}}</p>

    <hr>
    <hr>

    <h3>Buat Komentar</h3>
    @auth
    <form method="POST" action="/comments/{{$book->id}}" enctype="multipart/form-data">
        @csrf

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mb-3">
            <textarea name="content" class="form-control" placeholder="Isi Komentar..." cols="30" rows="10"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Buat Komentar</button>
    </form>

    <a href="/book" class="btn btn-secondary btn-sm mt-3">Kembali</a>

    @endauth
@endsection
