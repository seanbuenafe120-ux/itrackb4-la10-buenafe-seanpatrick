@extends('layouts.app')

@section('title', 'Edit Movie')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <h1 class="text-primary fw-bold mb-1">Edit Movie</h1>
        <p class="text-muted mb-4">Update the details for this movie.</p>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('movies.update', $movie) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label fw-bold">Movie Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $movie->title) }}">
            </div>

            <div class="mb-3">
                <label for="genre_id" class="form-label fw-bold">Genre</label>
                <select class="form-select" id="genre_id" name="genre_id">
                    <option value="">Choose a genre</option>
                    @foreach ($genres as $genre)
                        <option value="{{ $genre->id }}" @selected(old('genre_id', $movie->genre_id) == $genre->id)>
                            {{ $genre->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="director" class="form-label fw-bold">Director</label>
                <input type="text" class="form-control" id="director" name="director" value="{{ old('director', $movie->director) }}">
            </div>

            <div class="mb-3">
                <label for="year" class="form-label fw-bold">Year</label>
                <input type="number" class="form-control" id="year" name="year" value="{{ old('year', $movie->year) }}">
            </div>

            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="{{ route('movies.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection