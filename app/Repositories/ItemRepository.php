<?php

namespace App\Repositories;


use App\Interfaces\BaseInterface;
use App\Interfaces\ItemInterface;
use App\Models\Item;
use App\Repositories\BaseRepository;


class ItemRepository extends BaseRepository implements ItemInterface
{

    /**
     * get Model Class Name
     * @var string
     */
    protected $modelName = Item::class;

    /**
     * Default order by
     *
     * @var string
     */
    protected $orderBy = 'id';




}

