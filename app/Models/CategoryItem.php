<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryItem extends Model
{
    use HasFactory;

    protected $fillable = ['item_id', 'category_id'];

    public function item(){
        return $this->hasOne(Item::class, 'id', 'item_id');
    }
    public function category(){
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}
