<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable =['user_address','code','user_id','sub_total','total_amount','tax','shipment_status','payment_status','items_count','payment_method','shipment_method','warehouse_id'];

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function warehouse()
    {
      return $this->belongsTo(Warehouse::class);
    }
}
