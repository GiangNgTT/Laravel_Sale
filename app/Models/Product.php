<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = "products";

    public function billDetail(){
        return $this->hasMany('App\Models\BillDetail', 'id_product', 'id');
    }
    public function wishlist()
    {
        return $this->belongsTo(Wishlist::class, 'id_product', 'id');
    }
}
