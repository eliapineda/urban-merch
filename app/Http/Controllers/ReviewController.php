<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function create(Request $request)
    {
        $review = new Review();
        $review->user_id = Auth::id();
        $review->product_id = $request->get('product_id');
        $review->rating = $request->get('rating');
        $review->content = $request->get('content');
        $review->save();

        return redirect()->route('products.show', $request->product_id);
    }

    public function getAll()
    {
        $reviews = Review::with(['user', 'product'])->get();
        return view('admin.reviews', compact('reviews'));
    }

    public function deleteReview(Request $request)
    {
        Review::findOrFail($request->id)->delete();
        return redirect()->route('admin.reviews');
    }
}
