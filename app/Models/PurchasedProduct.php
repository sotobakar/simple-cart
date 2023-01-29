<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasedProduct extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['purchase_id', 'product_id', 'price', 'quantity'];

    /**
     * The product of the purchased product.
     * 
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
