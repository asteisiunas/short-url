@extends('layout.main')

@section('title', 'Show URL')

@section('content')
    <p><strong>Original URL:</strong> {{ $urlMap->url }}</p>
    <p><strong>Short URL:</strong> {{ $urlMap->short_url }}</p><!-- TODO: route() -->
    <div>
        <a href="{{ route('short-urls.create') }}">Create another one</a>
    </div>
@endsection
