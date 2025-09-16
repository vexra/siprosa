<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;

class AdminArticleController extends Controller
{
    public function dashboard()
    {
        $totalArticles = Article::count();
        $approvedArticles = Article::where('status', 'diterima')->count();
        $rejectedArticles = Article::where('status', 'ditolak')->count();
        $pendingArticles = Article::where('status', 'diproses')->count();

        return view('admin.dashboard', compact('totalArticles', 'approvedArticles', 'rejectedArticles', 'pendingArticles'));
    }

    public function index()
    {
        $articles = Article::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.articles.index', compact('articles'));
    }

    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

   public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            // Perbarui validasi untuk field 'url'
            'url' => 'required|string|unique:articles,url,' . $article->id,
        ]);

        // Perbarui artikel dengan data dari request, termasuk 'url'
        $article->update($request->only('title', 'description', 'url'));
        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function approve(Article $article)
    {
        $article->update(['status' => 'diterima']);
        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil disetujui.');
    }

    public function reject(Article $article)
    {
        $article->update(['status' => 'ditolak']);
        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil ditolak.');
    }
}