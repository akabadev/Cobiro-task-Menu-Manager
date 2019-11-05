<?php

namespace App\Http\Controllers;

use App\Http\Resources\ItemCollection;
use App\Menu;
use Illuminate\Http\Request;

class MenuLayerController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  mixed  $menu
     * @return \Illuminate\Http\Response
     */
    public function show($menu,$layer)
    {
        $menu = Menu::where('id', $menu)
            ->with('items')->get();
        $layerarray = [];
        if($layer > 1){

            foreach($menu[0]->items as $item){
                for ($i=0; $i < ($layer-1); $i++ ){

                    $layerarray[] = $item['children'];

                }

            }
            return $layerarray;
        }
        else{
            return $menu[0]->items;
        }





    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  mixed  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy($menu)
    {
        //
    }
}
