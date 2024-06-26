<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;
    protected $fillable = ['warehouse_name_AR','warehouse_name_EN','address','phone_number','word_from','word_end','delivery_from','delivery_end','is_active'];
}

