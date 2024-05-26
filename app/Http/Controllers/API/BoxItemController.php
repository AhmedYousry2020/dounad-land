<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\BoxCollection;
use App\Interfaces\BoxInterface;
use Illuminate\Http\Request;

class BoxItemController extends Controller
{

  private $boxRepository;
  public function __construct(BoxInterface $boxRepository){
    $this->boxRepository = $boxRepository;

  }
  /**
   * get all categories
   * @return JsonResponse
   */
  public function allBoxes()
  {
      try{
          $boxes = $this->boxRepository->all();
          return api(true,200,__('api.success'))
          ->add('box',BoxCollection::collection($boxes))
          ->get();
      }catch(\Exception $e){
          return api_exception($e);
      }
  }

  public function show($id)
  {
    try{
      $item = $this->boxRepository->find($id);
      return api(true,200,__('api.success'))
      ->add('item', new BoxCollection($item))
      ->get();
  }catch(\Exception $e){
      return api_exception($e);
  }
  }

}
