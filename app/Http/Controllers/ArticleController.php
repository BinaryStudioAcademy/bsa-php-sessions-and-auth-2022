<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ArticleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $articles = Article::all();

        return view('article.list', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('article/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        // Validate posted form data
        $validated = $request->validate([
            'title' => 'required|string|unique:articles|min:5|max:100',
            'body' => 'required|string|min:5|max:2000',
        ]);

        // Create slug from title
        $validated['slug'] = Str::slug($validated['title'], '-');

        // User Id
        $validated['user_id'] = Auth::user()->getAuthIdentifier();

        // Create and save post with validated data
        $article = Article::create($validated);

        // Redirect the user to the created post with a success notification
        return redirect(route('article.show', [$article->slug]))->with('notification', 'Article created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  Article  $article
     * @return Response
     */
    public function show(Article $article)
    {
        // Pass current post to view
        return view('article.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Article $article)
    {
        return view('article.create', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Article  $article
     * @return Response
     */
    public function update(Request $request, Article $article)
    {
        // Validate posted form data
        $validated = $request->validate([
            'title' => 'required|string|unique:articles|min:5|max:100',
            'body' => 'required|string|min:5|max:2000',
        ]);

        // Create slug from title
        $validated['slug'] = Str::slug($validated['title'], '-');

        // Update Post with validated data
        $article->update($validated);

        // Redirect the user to the created post woth an updated notification
        return redirect(route('article.index', [$article->slug]))->with('notification', 'Article updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Article $article)
    {
        // Delete the specified Post
        $article->delete();

        // Redirect user with a deleted notification
        return redirect(route('article.index'))->with('notification', '"' . $article->title .  '" deleted!');
    }
}
