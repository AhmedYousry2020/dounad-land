<?php

namespace App\Repositories;


use App\Interfaces\BaseInterface;
use App\Interfaces\ItemInterface;
use App\Models\Item;
use Illuminate\Support\Arr;

use Illuminate\Database\Eloquent\Builder;
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


    protected function applyFilters(Builder $instance, array $filters = []): void
    {
      if($search = Arr::get($filters, 'category_id'))
      {
        $categoryId = $search;
        $instance->whereHas('category', function($query) use($categoryId){
          $query->where('category_id',$categoryId);
        });

      }
      if($search = Arr::get($filters, 'name'))
      {
        $filterString =  '%'.$search.'%';
        $instance->where('item_name_'.SL , 'like', $filterString)
        ->orWhere->where('item_name_'.FL , 'like', $filterString);
      }

    }

}

