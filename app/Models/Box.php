<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    use HasFactory;
    protected $fillable = ['num_of_items','box_name_EN','box_name_AR', 'description_EN', 'description_AR','box_image','price'];

    public function items()
    {
      // return $this->belongsToMany(Item::class, 'box_items', 'box_id', 'item_id');
       return $this->belongsToMany(Item::class, 'box_items', 'box_id', 'item_id')->withPivot('min_num', 'max_num');
    }
}
