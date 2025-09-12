<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display the user dashboard with article statistics.
     */
    public function dashboard()
    {
        $user = auth()->user();
        
        $totalArticles = $user->articles()->count();
        $approvedArticles = $user->articles()->where('status', 'diterima')->count();
        $pendingArticles = $user->articles()->where('status', 'diproses')->count();
        $rejectedArticles = $user->articles()->where('status', 'ditolak')->count();

        return view('dashboard', compact('totalArticles', 'approvedArticles', 'pendingArticles', 'rejectedArticles'));
    }

    /**
     * Display a listing of the user's articles.
     */
    public function index()
    {
        $articles = auth()->user()->articles()->latest()->get();
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'description' => 'required',
        ]);
        
        $validatedData['user_id'] = auth()->id();
        $validatedData['slug'] = Str::slug($request->title, '-');
        
        Article::create($validatedData);

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        // Pastikan hanya pemilik artikel yang bisa mengedit
        if (auth()->id() !== $article->user_id) {
            abort(403, 'Unauthorized action.');
        }

        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        // Pastikan hanya pemilik artikel yang bisa mengupdate
        if (auth()->id() !== $article->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'description' => 'required',
        ]);

        $validatedData['slug'] = Str::slug($request->title, '-'); // Slug diperbarui otomatis dari judul baru
        
        $article->update($validatedData);

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        // Pastikan hanya pemilik artikel yang bisa menghapus
        if (auth()->id() !== $article->user_id) {
            abort(403, 'Unauthorized action.');
        }
        
        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil dihapus!');
    }
}