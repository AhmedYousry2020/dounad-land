<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\RemoveItemFromCartRequest;
use App\Http\Requests\Cart\StoreCartRequest;
use App\Http\Resources\CartCollection;
use App\Http\Resources\CartItemCollection;
use App\Interfaces\CartInterface;
use App\Interfaces\CartItemInterface;
use App\Interfaces\ItemInterface;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private $cartRepository, $cartItemRepository;
    public function __construct(CartInterface $cartRepository,  CartItemInterface $cartItemRepository){
      $this->cartRepository = $cartRepository;
      $this->cartItemRepository = $cartItemRepository;

    }
    public function addItemToCart(ItemInterface $itemRepository, StoreCartRequest $request)
    {

      try{
          $price = 0;
          $item = $itemRepository->find($request->item_id);

          $cart = $this->cartRepository->store([
            'user_id' => auth()->user()->id
          ]);
          if($item->qty_available < $request->qty)
          {
            return api(true, 201, __('api.quantity is not available!'))->get();
          }
          // count total of price
          $totalPrice = $item->price * $request->qty;
          $this->cartItemRepository->store([
            'item_id'=>$item->id,
            'cart_id'=>$cart->id,
            'price'=>$item->price,
            'quantity'=>$request->qty,

          ]);

          return api(true, 200, __('api.Item added to cart successfully'))->get();

    }
    catch(\Exception $e) {
      return api_exception($e);
    }


    }

    public function removeItemFromCart(ItemInterface $itemRepository, RemoveItemFromCartRequest $request)
    {
      try{
        $item = $itemRepository->find($request->item_id);
        $cart = $this->cartRepository->find('user_id', auth()->user()->id);
        $cartItem = $this->cartItemRepository->findByMany([
          'cart_id'=>$cart->id,
          'item_id'=>$item->id
        ]);
        $this->cartItemRepository->destroy($cartItem->id);
        return api(true, 200, __('api.Item removed from cart successfully'))->get();
      }
      catch(\Exception $e) {
        return api_exception($e);
      }


    }

    public function updateItemQuantityFromCart(ItemInterface $itemRepository, StoreCartRequest $request)
    {
      try{
        $item = $itemRepository->find($request->item_id);
        $cart = $this->cartRepository->find('user_id', auth()->user()->id);
        $cartItem = $this->cartItemRepository->findByMany([
          'cart_id'=>$cart->id,
          'item_id'=>$item->id
        ]);



        $this->cartItemRepository->update([
          'quantity'=>$request->qty,
        ],
        $cartItem->id);
        return api(true, 200, __('api.Item quantity updated in cart successfully'))->get();
      }
      catch(\Exception $e) {
        return api_exception($e);
      }

    }

    public function count()
    {
      try{
        $carts = auth()->user()->carts;
        if(!$carts)
        {
          return api(true, 201, __('api.cart is empty!'))->get();
        }
        return api(true, 200, __('api.success'))
                ->add('cart-count',$carts->count())
                ->get();
    }catch(\Exception $e){
       return api_exception($e);
    }
    }
    public function viewCart()
    {
      try{
          $carts = auth()->user()->carts;
          if(!$carts)
          {
            return api(true, 201, __('api.cart is empty!'))->get();
          }
          return api(true, 200, __('api.success'))
                  ->add('cartDetails',CartItemCollection::collection($carts))
                  ->get();
      }catch(\Exception $e){
         return api_exception($e);
      }
    }

    public function destroy($cartId)
    {
      $cart = $this->cartRepository->destroy($cartId);
      return api(true, 200, __('api.Cart destroyed successfully'))->get();

    }

}
