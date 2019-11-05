<?php

namespace App\Http\Controllers;

use App\Http\Resources\MenuResource;
use App\Item;
use App\Menu;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class MenuDepthController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  mixed $menu
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($menu)
    {
        //        $menu = Menu::find($menu)
        //            ->with(['items'])->get()->loadMorph('parentable', [
        //                Item::class => ['children']
        //            ]);

        // $menu = Menu::find($menu)->with('items')->get();

        $menu = Menu::where('id', $menu)
            ->with(
                ['items']
            )->get();

        $array = $menu->toArray();
        $i =0 ;
        $d = 0;
        while (!empty($array[0]['items'][$i])){
            $childArray = $array[0]['items'][$i];
            $c = 0;
            while (!empty($array[0]['items'][$i]['children'][$c])){
                $c++;
                if($c > $d){
                    $d = $c;
                }
            }
            $i++;
        }



        return response()->json(['depth' => $d],200);
    }
}
