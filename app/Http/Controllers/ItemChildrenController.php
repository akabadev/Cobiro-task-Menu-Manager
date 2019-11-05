<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemChildrenRequest;
use App\Http\Resources\ItemResource;
use App\Item;
use Illuminate\Http\Request;

class ItemChildrenController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  mixed $item
     * @param  StoreItemChildrenRequest $request
     * @return ItemResource
     */
    public function store($item,StoreItemChildrenRequest $request)
    {
        $item = Item::findOrFail($item);

        $child = $item->children()->create($request->only(['name','item_id']));

        return new ItemResource($child);
    }

    /**
     * Display the specified resource.
     *
     * @param  mixed $item
     * @return ItemResource
     */
    public function show($item)
    {
        $item = Item::findOrFail($item);

        return new ItemResource($item);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  mixed $item
     * @return \Illuminate\Http\Response
     */
    public function destroy($item)
    {
        $item = Item::findOrFail($item);

        $item->delete();
    }
}
