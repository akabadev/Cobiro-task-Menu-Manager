<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMenuItemRequest;
use App\Http\Resources\MenuItemCollection;
use App\Http\Resources\MenuItemResource;
use App\Menu;
use App\Item;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return MenuItemResource
     */
    public function store($menu,StoreMenuItemRequest $request)
    {
        $menu = Menu::findOrFail($menu);

        $menuItems = $menu->items()->create($request->only('name'));

        return new MenuItemResource($menuItems);
    }

    /**
     * Display the specified resource.
     *
     * @param  mixed  $menu
     * @return MenuItemCollection
     */
    public function show($menu)
    {
        $menu = Menu::findOrFail($menu);

        return new MenuItemCollection($menu->items);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  mixed  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy($menu)
    {
        $menu = Menu::findOrFail($menu);

        try {
            $menu->items->delete();
        } catch (\Exception $e) {
        }

        return response()->json(null,204);
    }

}
