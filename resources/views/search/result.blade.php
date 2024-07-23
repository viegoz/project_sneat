@extends('layouts.app')

@section('title', 'Search Results')

@push('css')
    <style>
        .search-results-container {
            padding: 2rem;
        }
        .search-results-header {
            margin-bottom: 1.5rem;
        }
        .search-item {
            border: 1px solid #e3e3e3;
            border-radius: 5px;
            padding: 1rem;
            margin-bottom: 1rem;
        }
        .search-item a {
            font-weight: bold;
            color: #007bff;
            text-decoration: none;
        }
        .search-item a:hover {
            text-decoration: underline;
        }
    </style>
@endpush

@section('content')
    <div class="container search-results-container">
        <h3 class="search-results-header">Hasil Pencarian</h3>
        @if(count($results) > 0)
            <div class="list-group">
                @foreach($results as $result)
                    <div class="list-group-item search-item">
                        <a href="{{ $result['url'] }}">{{ $result['name'] }}</a>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-muted">No results found</p>
        @endif
    </div>
@endsection

@push('js')
    <!-- Add any additional JS needed for this page -->
@endpush
