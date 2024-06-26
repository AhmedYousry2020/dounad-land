<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = ['item_name_EN','item_name_AR', 'item_description_EN', 'item_description_AR', 'item_slug', 'item_image', 'is_active','category_id','qty_available','price'];

    public function category()
    {
      return $this->belongsTo(Category::class);
    }
    public function boxes()
    {
      return $this->belongsToMany(Box::class);
    }

    public function checkFavorite($id)
    {
        $favoritesList = Favorite::where('user_id',auth()->user()->id)->pluck('item_id')->toArray();
        $item =  Item::find($id);
        return !empty($favoritesList) ? in_array($item->id,$favoritesList) : 0;
    }
}
