@extends('layouts.app')

@section('title', 'Movie Collection')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <p class="text-muted mb-0">Prepared by: Sean Patrick T. Buenafe | Block 4C</p>
    <a href="{{ route('movies.index', ['featured' => 1]) }}" class="btn btn-primary btn-sm">View featured</a>
</div>

<div class="alert alert-info py-2 mb-3">
    <strong>Active filters:</strong> Genre: {{ $selectedGenre ?? 'All genres' }} | Director: {{ $selectedDirector ?? 'All directors' }}
</div>

<div class="mb-3">
    <label class="fw-bold d-block mb-1">Filter by Genre:</label>
    <div class="d-flex gap-2 flex-wrap">
        @foreach ($genres as $genre)
            <a href="{{ route('movies.index', ['genre' => $genre->name, 'director' => $selectedDirector]) }}" 
               class="btn btn-sm {{ $selectedGenre == $genre->name ? 'btn-primary' : 'btn-outline-primary' }}">
                {{ $genre->name }}
            </a>
        @endforeach
    </div>
</div>

<div class="mb-3">
    <label class="fw-bold d-block mb-1">Filter by Director:</label>
    <div class="d-flex gap-2 flex-wrap">
        @php
            $directors = \App\Models\Movie::select('director')->distinct()->pluck('director');
        @endphp
        @foreach ($directors as $director)
            <a href="{{ route('movies.index', ['genre' => $selectedGenre, 'director' => $director]) }}" 
               class="btn btn-sm {{ $selectedDirector == $director ? 'btn-warning' : 'btn-outline-warning text-dark' }}">
                {{ $director }}
            </a>
        @endforeach
    </div>
</div>

<div class="mb-4 d-flex gap-2">
    <a href="{{ route('movies.create') }}" class="btn btn-success">Add movie</a>
    <a href="{{ route('movies.index') }}" class="btn btn-outline-secondary">Clear both filters</a>
</div>

<h1 class="text-primary fw-bold mb-3">Movie Collection</h1>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>Movie Title</th>
                        <th>Genre</th>
                        <th>Year</th>
                        <th>Director</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($movies as $movie)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $movie->id }}</td>
                            <td><a href="{{ route('movies.show', $movie) }}" class="text-decoration-none fw-bold">{{ $movie->title }}</a></td>
                            <td>
                                <span class="badge bg-secondary">{{ $movie->genre->name ?? 'N/A' }}</span>
                            </td>
                            <td>{{ $movie->year }}</td>
                            <td>{{ $movie->director }}</td>
                            <td>
                                <a href="{{ route('movies.edit', $movie) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('movies.destroy', $movie) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this movie?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">No movies found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-3 text-muted small">
    Queries: {{ $queryCount ?? 0 }}
</div>
@endsection