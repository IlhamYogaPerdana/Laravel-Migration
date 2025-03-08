@extends('layouts.master')
@section('title')
    Tampil Genres
@endsection
@section('content')
@auth
@if(Auth()->user()->role === 'admin')
<a href="/genre/create" class="btn btn-primary btn-sm my-2">Tambah</a>
@endif
@endauth
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($genres as $item)
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td>{{$item->name}}</td>
                <td>
                    <form action="POST" action="/genre/{{$item->id}}">
                    <a href="/genre/{{$item->id}}" class="btn btn-info btn-sm">Detail</a>
                    @auth
                    @if(Auth()->user()->role === 'admin')
                    <a href="/genre/{{$item->id}}/edit" class="btn btn-warning btn-sm">Edit</a>
                    @csrf
                    @method("DELETE")
                    <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                    </form>
                    @endif
                    @endauth
                </td>
            </tr>
            @empty
                <p>No users</p>
            @endforelse
        </tbody>
    </table>
@endsection
