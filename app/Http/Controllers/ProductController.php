<?php

namespace App\Http\Controllers;

use App\Product;
use App\Store;
use Illuminate\Http\Request;
use MilesChou\Toggle\Toggle;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function create(Request $request)
    {
        return view('product.create', [
            'store_id' => $request->query('store_id'),
        ]);
    }

    public function store(Request $request)
    {
        /** @var Store $store */
        $store = Store::find($request->query('store_id'));
        $store->products()->create($request->only('name', 'price'));

        return redirect()->route('store.show', $store->id);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    public function edit(Product $product, Toggle $toggle)
    {
        return view('product.edit', [
            'product' => $product,
            'toggle' => $toggle,
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $product->fill($request->only(['name', 'price']));
        $product->save();

        return redirect()->route('store.show', $product->store->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
