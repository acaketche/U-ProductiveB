<?php

namespace App\Http\Controllers;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('category')->where('status', 'published')->get();
        return view('artikel.artikel-home', compact('articles'));
    }

    // public function create()
    // {
    //     $categories = Category::all();
    //     return view('articles.create', compact('categories'));
    // }

    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'title' => 'required|string|max:255',
    //         'content' => 'required|string',
    //         'status' => 'required|in:draft,published',
    //         'category_id' => 'required|exists:categories,category_id',
    //     ]);

    //     $validatedData['user_id'] = Auth::id();

    //     Article::create($validatedData);

    //     return redirect()->route('articles.index')->with('success', 'Article created successfully!');
    // }

    // public function show(Article $article)
    // {
    //     return view('articles.show', compact('article'));
    // }

    // public function edit(Article $article)
    // {
    //     $categories = Category::all();
    //     return view('articles.edit', compact('article', 'categories'));
    // }

    // public function update(Request $request, Article $article)
    // {
    //     $validatedData = $request->validate([
    //         'title' => 'required|string|max:255',
    //         'content' => 'required|string',
    //         'status' => 'required|in:draft,published',
    //         'category_id' => 'required|exists:categories,category_id',
    //     ]);

    //     $article->update($validatedData);

    //     return redirect()->route('articles.index')->with('success', 'Article updated successfully!');
    // }

    // public function destroy(Article $article)
    // {
    //     $article->delete();

    //     return redirect()->route('articles.index')->with('success', 'Article deleted successfully!');
    // }
}
