<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderedItem extends Model
{
    use HasFactory;

    protected $fillable = ['item_id', 'order_id', 'quantity'];

    public function order(){
        return $this->hasOne(Order::class, 'id', 'order_id');
    }
    public function item(){
        return $this->hasOne(Item::class, 'id', 'item_id')->withTrashed();
    }
}
