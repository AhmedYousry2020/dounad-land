<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Interfaces\CartInterface;
use App\Interfaces\CartItemInterface;
use App\Interfaces\OrderInterface;
use App\Interfaces\OrderItemInterface;
use App\Interfaces\WarehouseInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

      private $cartRepository, $cartItemRepository, $orderRepository, $warehouseRepository,$orderItemRepository;
      public function __construct(
        CartInterface $cartRepository,
        CartItemInterface $cartItemRepository,
        OrderInterface $orderRepository,
        OrderItemInterface $orderItemRepository,
        WarehouseInterface $warehouseRepository,
        ){
        $this->cartRepository = $cartRepository;
        $this->cartItemRepository = $cartItemRepository;
        $this->orderRepository = $orderRepository;
        $this->orderItemRepository = $orderItemRepository;
        $this->warehouseRepository = $warehouseRepository;
      }
      public function store(StoreOrderRequest $request)
      {
        try{
          $data = $request->validated();
          $cart = $this->cartRepository->findBy('user_id', auth()->user()->id);

          if(!$cart)
          {
            return api(true, 201, __('api.cart is empty!'))->get();
          }

          $warehouse = $this->warehouseRepository->findBy('id', $data['warehouse_id']);

          //check received date and time
          if($data['received_time'] > $warehouse->delivery_from && $data['received_time'] < $warehouse->delivery_to )
          {
            $order =  $this->orderRepository->store([
              'user_id'=>auth()->user()->id,
              'code'=> date('Ymd-His') . rand(10, 99),
              'user_address'=>$data['address'],
              'sub_total'=>$cart->subTotal(),
              'total_amount'=>$cart->grandTotal(),
              'tax'=>'10.0',
              'order_status'=>'pending',
              'shipment_status'=>'pending',
              'payment_status'=>'unpaid',
              'items_count'=>count($cart->cartItems),
              'payment_method'=>$data['payment_method'],
              'shipment_method'=>$data['shipment_method'],
              'warehouse_id'=>$warehouse->id,
            ]);

            foreach($cart->cartItems as $item)
            {
              $this->orderItemRepository->store([
                'order_id'=>$order->id,
                'item_id'=>$item->item_id,
                'quantity'=>$item->quantity,
                'price'=>$item->price,
              ]);
            }
          }
          else{
            return api(true, 201, __('api.time is not available!'))->get();

          }
          return api(true, 201, __('api.Order Stored Successfully'))->get();

        }catch(\Exception $e)
        {
          return api_exception($e);

        }

      }

}
