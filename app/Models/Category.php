<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
     protected $fillable = ['category_name_EN','category_name_AR','category_description_EN','category_description_AR','is_active'];
}
