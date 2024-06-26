<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use App\Interfaces\OrderItemInterface;
use App\Models\Order;
use App\Models\OrderItem;

class OrderItemRepository extends BaseRepository implements OrderItemInterface
{
     /**
     * get Model Class Name
     * @var string
     */
    protected $modelName = OrderItem::class;

    /**
     * Default order by
     *
     * @var string
     */
    protected $orderBy = 'id';
}
