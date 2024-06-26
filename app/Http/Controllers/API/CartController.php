<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\RemoveItemFromCartRequest;
use App\Http\Requests\Cart\StoreCartRequest;
use App\Http\Resources\CartCollection;
use App\Http\Resources\CartItemCollection;
use App\Interfaces\BoxInterface;
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
    public function addItemToCart(ItemInterface $itemRepository, BoxInterface $boxRepository, StoreCartRequest $request)
    {
      try{

         $cart = $this->cartRepository->store([
            'user_id' => auth()->user()->id
          ]);

          $price = 0;
          if($request->type == 'box')
          {
            $box = $boxRepository->find($request->box_id);
            foreach($request->box_items_details as $boxItem)
            {
              $item = $itemRepository->find($boxItem['id']);
              // count total of price
              $totalPrice = $item->price * $boxItem['qty'];
              $this->cartItemRepository->store([
                'item_id'=>$item->id,
                'box_id'=>$box->id,
                'cart_id'=>$cart->id,
                'price'=>$item->price,
                'quantity'=>$boxItem['qty'],
              ]);
            }
          }else
          {
            $item = $itemRepository->find($request->item_id);
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
          }

          return api(true, 200, __('api.Item added to cart successfully'))->get();
    }
    catch(\Exception $e) {
      return api_exception($e);
    }
    }

    public function removeItemFromCart(ItemInterface $itemRepository,BoxInterface $boxRepository, RemoveItemFromCartRequest $request)
    {
      try{
        $cart = $this->cartRepository->findBy('user_id', auth()->user()->id);

        if($request->type == 'box')
        {
          $box = $boxRepository->find($request->box_id);
          $cartItems = $this->cartItemRepository->getBy([
            'cart_id'=>$cart->id,
            'box_id'=>$box->id
          ]);
          foreach($cartItems as $cartItem)
          {
            $this->cartItemRepository->destroy($cartItem->id);
          }
        }else
        {
          $item = $itemRepository->find($request->item_id);
          $cartItem = $this->cartItemRepository->findByMany([
            'cart_id'=>$cart->id,
            'item_id'=>$item->id
          ]);
          $this->cartItemRepository->destroy($cartItem->id);

        }
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
        $cart = $this->cartRepository->findBy('user_id', auth()->user()->id);
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
        $cart = auth()->user()->cart;
        if(!$cart)
        {
          return api(true, 201, __('api.cart is empty!'))->get();
        }
        return api(true, 200, __('api.success'))
                ->add('cart-count',count($cart->cartItems))
                ->get();
    }catch(\Exception $e){
       return api_exception($e);
    }
    }
    public function viewCart()
    {
      try{
          $cart = auth()->user()->cart;
          if(!$cart)
          {
            return api(true, 201, __('api.cart is empty!'))->get();
          }
          return api(true, 200, __('api.success'))
                  ->add('cartDetails',new CartItemCollection($cart))
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
