<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Genre;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $query = Movie::with('genre');

        if ($request->filled('genre')) {
            $query->whereHas('genre', function ($q) use ($request) {
                $q->where('name', $request->genre);
            });
        }

        if ($request->filled('director')) {
            $query->where('director', $request->director);
        }

        if ($request->has('featured')) {
            // Adjust condition based on your schema if featured exists, or keep as needed
        }

        $movies = $query->get();
        $genres = Genre::all();
        $selectedGenre = $request->genre;
        $selectedDirector = $request->director;
        $queryCount = \DB::getQueryLog();
        $queryCount = count($queryCount);

        return view('movies.index', compact('movies', 'genres', 'selectedGenre', 'selectedDirector', 'queryCount'));
    }

    public function create()
    {
        $genres = Genre::all();
        return view('movies.create', compact('genres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'genre_id' => 'required',
            'director' => 'required|max:255',
            'year' => 'required|integer',
        ]);

        Movie::create($request->all());

        return redirect()->route('movies.index')
            ->with('success', 'Movie created successfully!');
    }

    public function show(Movie $movie)
    {
        return view('movies.show', compact('movie'));
    }

    public function edit(Movie $movie)
    {
        $genres = Genre::all();
        return view('movies.edit', compact('movie', 'genres'));
    }

    public function update(Request $request, Movie $movie)
    {
        $request->validate([
            'title' => 'required|max:255',
            'genre_id' => 'required',
            'director' => 'required|max:255',
            'year' => 'required|integer',
        ]);

        $movie->update($request->all());

        return redirect()->route('movies.index')
            ->with('success', 'Movie updated successfully!');
    }

    public function destroy(Movie $movie)
    {
        $movie->delete();

        return redirect()->route('movies.index')
            ->with('success', 'Movie deleted successfully!');
    }
}