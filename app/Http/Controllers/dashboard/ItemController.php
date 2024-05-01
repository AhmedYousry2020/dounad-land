<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Item\StoreItemRequest;
use App\Interfaces\CategoryInterface;
use App\Interfaces\ItemInterface;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{

    private $itemRepository;
    public function __construct(ItemInterface $itemRepository)
    {
      $this->itemRepository = $itemRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items =  $this->itemRepository->paginate();
        return view('admin.items.index',compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CategoryInterface $categoryRepository)
    {
      $categories = $categoryRepository->all()->pluck('category_name_' . getLocale(), 'id');
      return view('admin.items.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemRequest $request)
    {
      $data = $request->validated();
      if (array_key_exists('item_image', $data)) {
        $data['item_image'] = storeImage($data['item_image'], '/uploads/itemImages');
     }
        return $this->itemRepository->store($data)
        ? redirect()->route('admin.items.index')->with('alert-success', __('general.Add Successfully'))
        : redirect()->back()->with('alert-danger', __('general.Add Failed'))->withInput();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
