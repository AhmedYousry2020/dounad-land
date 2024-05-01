<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use App\Interfaces\CartInterface;

class CartRepository extends BaseRepository implements CartInterface
{
     /**
     * get Model Class Name
     * @var string
     */
    protected $modelName = Cart::class;

    /**
     * Default order by
     *
     * @var string
     */
    protected $orderBy = 'id';
}
