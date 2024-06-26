<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use App\Interfaces\WarehouseInterface;
use App\Models\Warehouse;

class WarehouseRepository extends BaseRepository implements WarehouseInterface
{
     /**
     * get Model Class Name
     * @var string
     */
    protected $modelName = Warehouse::class;

    /**
     * Default order by
     *
     * @var string
     */
    protected $orderBy = 'id';


}
