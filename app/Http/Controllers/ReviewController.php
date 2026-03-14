<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function saveReview(Request $request)
    {
        Review::create([
            'name' => $request->name,
            'rating' => $request->rating,
            'message' => $request->message
        ]);

        return redirect()->back()->with('success','Review Submitted!');
    }
}