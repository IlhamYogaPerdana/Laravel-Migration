<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genres;
use App\Models\Books;
use File;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use App\Http\Middleware\IsAdmin;

class BooksController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth', only: ['comments']),
            new Middleware(IsAdmin::class, except: ['index', 'show']),
        ];
    }
    public function index()
    {
        $book = Books::all();
        return view('book.tampil', ['book' => $book]);
    }

    public function create()
    {
        $genre = Genres::all();
        return view('book.tambah', ['genre' => $genre]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:jpg,jpeg,png|max:2048',
            'title' => 'required',
            'summary' => 'required',
            'genre_id' => 'required',
            'stock' => 'required',
        ]);

        $newImageName = time().'.'.$request->image->extension();

        $request->image->move(public_path('image'), $newImageName);

        $book = new Books;

        $book->title = $request->input('title');
        $book->summary = $request->input('summary');
        $book->genre_id = $request->input('genre_id');
        $book->image = $newImageName;
        $book->stock = $request->input('stock');

        $book->save();

        return redirect('/book');
    }

    public function show(string $id)
    {
        $book = Books::find($id);
        return view('book.detail', ['book' => $book]);
    }

    public function edit(string $id)
    {
        $genre = Genres::all();
        $book = Books::find($id);

        return view('book.edit', ['book' => $book, 'genre' => $genre]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => 'mimes:jpg,jpeg,png|max:2048',
            'title' => 'required',
            'summary' => 'required',
            'genre_id' => 'required',
            'stock' => 'required',
        ]);
        $book = Books::find($id);
        if ($request->has('image')) {
            File::delete('image/' . $book->image);

            $newImageName = time().'.'.$request->image->extension();

            $request->image->move(public_path('image'), $newImageName);

            $book->image = $newImageName;
        }

        $book->title = $request->input('title');
        $book->summary = $request->input('summary');
        $book->genre_id = $request->input('genre_id');
        $book->stock = $request->input('stock');

        $book->save();

        return redirect('/book');
    }

    public function destroy(string $id)
    {
        $book = Books::find($id);
        File::delete('image/' . $book->image);

        $book->delete();

        return redirect('/book');
    }

    public function comments(Request $request){
        $request->validate([
            'content' => ''
        ]);
    }
}
