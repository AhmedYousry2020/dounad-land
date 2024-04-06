<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use App\Interfaces\CategoryInterface;

class CategoryRepository extends BaseRepository implements CategoryInterface
{
     /**
     * get Model Class Name
     * @var string
     */
    protected $modelName = Category::class;

    /**
     * Default order by
     *
     * @var string
     */
    protected $orderBy = 'id';

    protected function applyFilters(Builder $instance, array $filters = []): void
    {
        if (!empty($filters))
        {
            $instance->where('parent_id', $filters['parent_id']);
        }
    }

}
