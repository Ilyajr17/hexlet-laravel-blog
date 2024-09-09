<?php

namespace App\Http\Controllers;

use App\Models\{Article, ArticleComment};
use Illuminate\Http\Request;

class ArticleCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        var_dump($request->name);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Article $article, Request $request)
    {
        $validated = $this->validate($request, [
            'content' => 'required|min:10'
        ]);

        $comment = $article->comments()->make();
        $comment->fill($validated);
        $comment->save();

        return redirect()
            ->route('articles.show', $article);
    }

    /**
     * Display the specified resource.
     */
    public function show(ArticleComment $articleComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article, ArticleComment $comment)
    {
        return view('article_comment.edit', compact('article', 'comment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article, ArticleComment $comment)
    {
        $validated = $this->validate($request, [
            'content' => 'required|min:10'
        ]);

        $comment->fill($validated);
        $comment->save();
        return redirect()
            ->route('articles.show', $article);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article, ArticleComment $comment)
    {
        $comment->delete();
        return redirect()->route('articles.show', $article);
    }
}
