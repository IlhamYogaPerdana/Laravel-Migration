@extends('layouts.master')
@section('title')
    Edit Genres
@endsection

@section('content')
    <form method="POST" action="/genre/{{$genre->id}}">
        @csrf
        @method('PUT')

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
            <label class="form-label">Genres Name</label>
            <input type="text" class="form-control" name="name" value="{{$genre->name}}">
        </div>
        <div class="mb-3">
            <label class="form-label">Genres Description</label>
            <textarea name="description" class="form-control" cols="30" rows="10">{{$genre->description}}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
