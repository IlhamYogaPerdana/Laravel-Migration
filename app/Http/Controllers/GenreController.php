<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\facades\DB;
use Carbon\Carbon;

class GenreController extends Controller
{
    public function index() {
        $genres = DB::table('genres')->get();

        return view('genres.tampil', ['genres' => $genres]);
    }

    public function show($id) {
        $genre = DB::table('genres')->find($id);

        return view('genres.detail', ['genre' => $genre]);
    }

    public function create() {
        return view('genres.tambah');
    }

    public function edit($id) {
        $genre = DB::table('genres')->find($id);

        return view('genres.edit', ['genre' => $genre]);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|min:5',
            'description' => 'required',
        ]);

        DB::table('genres')->insert([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        return redirect('/genre');
    }

    public function update($id, Request $request) {
        $request->validate([
            'name' => 'required|min:5',
            'description' => 'required',
        ]);

        DB::table('genres')
        ->where('id', $id)
        ->update(
            [
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'updated_at' => Carbon::now()
            ]
            );
        return redirect('/genre');
    }
    public function destroy($id) {
        DB::table('genres')->where('id', $id)->delete();

        return redirect('/genre');
    }
}
