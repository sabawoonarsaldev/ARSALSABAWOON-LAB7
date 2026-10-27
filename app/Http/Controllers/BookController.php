<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    // Show the dashboard with only the logged-in user's books, newest first
    public function index()
    {
        $books = Book::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('dashboard', compact('books'));
    }

    // Validate and save a new book
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'  => 'required|string|max:150',
            'author' => 'required|string|max:100',
            'pages'  => 'required|integer|min:1|max:10000',
        ]);

        $book = new Book($validated);
        $book->user_id = Auth::id(); // assign user_id before saving
        $book->save();

        return redirect()->route('dashboard')
            ->with('success', 'Book registered successfully.');
    }
}