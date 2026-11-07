@extends('layouts.app')

@section('title', 'Movie Details')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Movie Details</h4>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fw-bold">Movie Title:</label>
                    <p class="form-control-static">{{ $movie->title }}</p>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Genre:</label>
                    <p class="form-control-static">
                        <span class="badge bg-secondary">{{ $movie->genre->name ?? 'N/A' }}</span>
                    </p>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Director:</label>
                    <p class="form-control-static">{{ $movie->director }}</p>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Year:</label>
                    <p class="form-control-static">{{ $movie->year }}</p>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('movies.index') }}" class="btn btn-secondary">Back to List</a>
                    <div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection