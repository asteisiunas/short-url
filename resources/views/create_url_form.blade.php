@extends('layout.main')

@section('title', 'Create URL')

@section('content')
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('short-urls.store') }}">
        @csrf
        <label for="url">URL:</label><br>
        <input type="text" id="url" name="url" value="{{ old('url') }}"><br><br>
        <button type="submit">Submit</button>
    </form>
@endsection
