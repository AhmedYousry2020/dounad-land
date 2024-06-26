<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use App\Interfaces\OrderInterface;
use App\Models\Order;

class OrderRepository extends BaseRepository implements OrderInterface
{
     /**
     * get Model Class Name
     * @var string
     */
    protected $modelName = Order::class;

    /**
     * Default order by
     *
     * @var string
     */
    protected $orderBy = 'id';
}
