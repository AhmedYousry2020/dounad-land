<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Models\Category;
use App\Interfaces\CategoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    private $categoryRepository;
    public function __construct(CategoryInterface $categoryRepository){
      $this->categoryRepository = $categoryRepository;

    }
    /**
     * get all categories
     * @return JsonResponse
     */
    public function allCategories()
    {
        try{
            $categories = $this->categoryRepository->all();
            return api(true,200,__('api.success'))
            ->add('categories',CategoryCollection::collection($categories))
            ->get();
        }catch(\Exception $e){
            return api_exception($e);
        }
    }
}
