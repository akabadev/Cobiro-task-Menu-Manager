<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMenuRequest;
use App\Http\Resources\MenuResource;
use Illuminate\Http\Request;
use App\Menu;

class MenuController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return MenuResource
     */
    public function store(StoreMenuRequest $request)
    {
        $menu = Menu::create($request->only('name'));

        return new MenuResource($menu);
    }

    /**
     * Display the specified resource.
     *
     * @param  mixed  $menu
     * @return \Illuminate\Http\Response
     */
    public function show($menu)
    {
        $menu = Menu::findOrFail($menu);
        return new MenuResource($menu);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $menu
     * @return MenuResource
     */
    public function update(StoreMenuRequest $request,$menu)
    {
        $menu = Menu::findOrFail($menu);

        $menu->update($request->only('name'));

        return new MenuResource($menu);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  mixed  $menu
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($menu)
    {
        $menu = Menu::findOrFail($menu);

        try {
            $menu->delete();
        } catch (\Exception $e) {
        }

        return response()->json(null,204);
    }
}
