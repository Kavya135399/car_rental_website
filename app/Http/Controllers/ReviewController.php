<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    // Show form
    public function index()
    {
        return view('feedback');
    }

    // Store data
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'rating' => 'required',
            'message' => 'nullable'
        ]);

        Review::create([
            'name' => $request->name,
            'rating' => $request->rating,
            'message' => $request->message
        ]);

        return redirect()->back()->with('success', 'Review Submitted!');
    }
}