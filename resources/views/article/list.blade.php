@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Body</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($articles as $article)
                    <tr>
                        <td scope="row">
                            {{ $article->id }}
                        </td>
                        <td>
                            {{ $article->title }}
                        </td>
                        <td>
                            {{ strlen($article->body) > 50 ? substr($in,0,50)."..." : $article->body }}
                        </td>
                        <td>
                            <a href="{{ route('article.edit', $article) }}">Edit</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
