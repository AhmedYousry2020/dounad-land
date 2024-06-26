<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\FavoriteListCollection;
use App\Interfaces\ItemInterface;
use App\Models\Appartment;
use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    /**
     * user add item to favorite list
     * @param Item itemId
     * @return JsonResponse
     */
    public function addToFavorite(ItemInterface $itemRepository, $itemId)
    {
        try{
            $user = auth()->user();
            $item = $itemRepository->find($itemId);
             Favorite::create([
                'user_id'=>$user->id,
                'item_id'=>$item->id,
             ]);
            return api(true,200,__('api.success'))
            ->get();
        }catch(\Exception $e){
            return api_exception($e);
        }
    }

     /**
     * get all favorite list
     * @return JsonResponse
     */
    public function allFavotriteList()
    {
        try{
            $user = auth()->user();
            $favoriteList = Favorite::where('user_id',$user->id)->get();
            return api(true,200,__('api.success'))
            ->add('favoriteList',FavoriteListCollection::collection($favoriteList))
            ->get();
        }catch(\Exception $e){
            return api_exception($e);
        }
    }

}
