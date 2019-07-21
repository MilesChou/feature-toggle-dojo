<?php

namespace App\Http\Controllers;

use App\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
        return view('store.index', [
            'stores' => Store::all(),
        ]);
    }

    public function create()
    {
        return view('store.create');
    }

    public function store(Request $request)
    {
        /** @var Store $store */
        $store = Store::create($request->only(['name', 'desc']));

        return redirect()->route('store.show', $store->id);
    }

    public function show(Store $store)
    {
        return view('store.show', [
            'store' => $store,
        ]);
    }

    public function edit(Store $store)
    {
        return view('store.edit', [
            'store' => $store,
        ]);
    }

    public function update(Request $request, Store $store)
    {
        $store->fill($request->only(['name', 'desc']));
        $store->save();

        return redirect()->route('store.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Store $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        //
    }
}
