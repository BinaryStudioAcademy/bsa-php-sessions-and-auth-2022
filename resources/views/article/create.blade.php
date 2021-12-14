@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <form method="POST" action="{{ route('article.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ isset($article) ? $article->title : '' }}" />
                </div>

                <div class="mb-3">
                    <label for="body">Body</label>
                    <textarea name="body" id="body" class="form-control">{{ isset($article) ? $article->body : '' }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

@endsection
