<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->get();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::all();
        return view('products.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string',
            'image1' => 'nullable|image',
            'image2' => 'nullable|image',
            'image3' => 'nullable|image',
            'quantity' => 'required|integer',
            'is_promoted' => 'required|boolean',
            'tags' => 'nullable|array',
        ]);

        $product = new Product;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->rating = 0;
        $product->is_promoted = $request->is_promoted;
        $product->user_id = auth()->id();

        // Save images if they exist
        for ($i = 1; $i <= 3; $i++) {
            if ($request->hasFile("image$i")) {
                $imageName = time()."_image$i.".$request->{"image$i"}->extension();
                $request->{"image$i"}->move(public_path('images'), $imageName);
                $product->{"image$i"} = $imageName;
            }
        }

        $product->save();

        // Attach tags if they exist
        if ($request->tags) {
            $product->tags()->attach($request->tags);
        }

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $tags = Tag::all();
        return view('products.edit', compact('product', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->all());

        // Update tags if they exist
        if ($request->tags) {
            $product->tags()->sync($request->tags);
        }

        return redirect()->route('products.show', $product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }
}
