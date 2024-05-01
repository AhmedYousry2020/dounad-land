<?php

namespace App\Repositories;

use App\Interfaces\BoxInterface;
use App\Models\Cart;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Box;

class BoxRepository extends BaseRepository implements BoxInterface
{
     /**
     * get Model Class Name
     * @var string
     */
    protected $modelName = Box::class;

    /**
     * Default order by
     *
     * @var string
     */
    protected $orderBy = 'id';
}
