<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
    use HasFactory;
    protected $table = 'wishlists';

    protected $fillable = [
        'quantity',
        'id_user',
        'id_product',
    ];
    public function product()
    {
        return $this->hasMany(Product::class, 'id_product', 'id');
    }
}
