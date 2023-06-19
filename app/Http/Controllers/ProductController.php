<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Product::class);

        return view('products.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Product::class);

        $currency = Product::DEFAULT_CURRENCY;

        return view('products.create', compact('currency'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Product::class);

        $validated = $request->validate([
            'name' => 'required|string',
            'price' => 'required|integer',
            'description' => 'required|string',
        ]);

        $product = Product::factory()->create($validated);

        session()->flash('message', __('Successfully created'));

        return redirect()->route('products.show', ['product' => $product->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $this->authorize('view', $product);

        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $this->authorize('update', $product);

        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $this->authorize('update', $product);

        $validated = $request->validate([
            'name' => 'required|string',
            'price' => 'required|integer',
            'description' => 'required|string',
        ]);

        $product->name = $validated['name'];
        $product->price = $validated['price'];
        $product->description = $validated['description'];

        $product->save();

        session()->flash('message', __('Successfully updated'));

        return redirect()->route('products.show', ['product' => $product->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);

        $product->forceDelete();

        session()->flash('message', __('Successfully deleted'));

        return redirect()->route('products.index');
    }
}
