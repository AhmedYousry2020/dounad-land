<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ItemCollection;
use App\Interfaces\ItemInterface;
use Illuminate\Http\Request;

class ItemController extends Controller
{

  private $itemRepository;
  public function __construct(ItemInterface $itemRepository){
    $this->itemRepository = $itemRepository;

  }
  /**
   * get all categories
   * @return JsonResponse
   */
  public function allItems(Request $request)
  {
      try{
        $params = $request->all();
        if($params){
            $items = $this->filters($params['categoryId'],$params['name']);
        }else{
          $items = $this->itemRepository->all();
        }
          $items = $this->itemRepository->all();
          return api(true,200,__('api.success'))
          ->add('items',ItemCollection::collection($items))
          ->get();
      }catch(\Exception $e){
          return api_exception($e);
      }
  }

  public function show($id)
  {
    try{

      $item = $this->itemRepository->find('id', $id);
      return api(true,200,__('api.success'))
      ->add('item', new ItemCollection($item))
      ->get();
  }catch(\Exception $e){
      return api_exception($e);
  }
  }

  public function filters($categoryId, $name){

    if($categoryId != ''){
        $items = $this->itemRepository->whereHas('category',function($query) use($categoryId){
                $query->where('category_id',$categoryId);
        });
    }


    return $items;
}
}
