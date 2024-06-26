<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\WarehouseCollection;
use App\Interfaces\WarehouseInterface;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{


  private $warehouseRepository;
  public function __construct(WarehouseInterface $warehouseRepository){
    $this->warehouseRepository = $warehouseRepository;

  }
  /**
   * get all categories
   * @return JsonResponse
   */
  public function allWarehouses()
  {
      try{
          $warehouses = $this->warehouseRepository->all('id');
          return api(true,200,__('api.success'))
          ->add('warehouses',WarehouseCollection::collection($warehouses))
          ->get();
      }catch(\Exception $e){
          return api_exception($e);
      }
  }

}
