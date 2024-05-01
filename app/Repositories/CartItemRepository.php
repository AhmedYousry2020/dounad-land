<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use App\Interfaces\CartItemInterface;
use App\Models\CartItem;

class CartItemRepository extends BaseRepository implements CartItemInterface
{
     /**
     * get Model Class Name
     * @var string
     */
    protected $modelName = CartItem::class;

    /**
     * Default order by
     *
     * @var string
     */
    protected $orderBy = 'id';
}
