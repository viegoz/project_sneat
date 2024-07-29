@extends('layouts.app')

@section('title', 'Search Results')

@push('css')
    <style>
        .search-results-container {
            padding: 2rem;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 1390px;
            margin: auto;
            margin-top: 2rem;
        }
        .search-results-header {
            margin-bottom: 1.5rem;
            color: #333;
            text-align: center;
        }
        .search-item {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            background-color: #fff;
            transition: transform 0.2s, box-shadow 0.2s;
            cursor: pointer;
        }
        .search-item a {
            font-weight: bold;
            color: #007bff;
            text-decoration: none;
            font-size: 1.2rem;
            display: block;
        }
        .search-item a:hover {
            text-decoration: underline;
        }
        .search-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        .text-muted {
            color: #6c757d;
            text-align: center;
        }
        .search-box {
            display: flex;
            justify-content: center;
            margin-bottom: 2rem;
        }
        .search-box input[type="text"] {
            padding: 0.5rem;
            font-size: 1rem;
            border: 1px solid #ddd;
            border-radius: 5px 0 0 5px;
            width: 300px;
        }
        .search-box button {
            padding: 0.5rem 1rem;
            font-size: 1rem;
            border: 1px solid #007bff;
            background-color: #007bff;
            color: #fff;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
        }
        .search-box button:hover {
            background-color: #0056b3;
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
