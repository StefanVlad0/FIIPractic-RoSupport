<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Rating;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index($productId)
    {
        $reviews = Rating::where('product_id', $productId)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($reviews);
    }

    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'nullable|string',
            'product_id' => 'required|exists:products,id'
        ]);

        $existingReview = Rating::where('product_id', $request->product_id)
            ->where('user_id', auth()->id())
            ->first();

        if ($existingReview) {
            $existingReview->update([
                'rating' => $request->rating,
                'content' => $request->content
            ]);
        } else {
            Rating::create([
                'user_id' => auth()->id(),
                'product_id' => $request->product_id,
                'rating' => $request->rating,
                'content' => $request->content
            ]);
        }

        $averageRating = Rating::where('product_id', $request->product_id)->avg('rating');
        Product::where('id', $request->product_id)->update(['rating' => $averageRating]);

        return response()->json(['message' => 'Review submitted successfully']);
    }
}
