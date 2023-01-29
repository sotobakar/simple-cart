<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Purchase extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'purchased_at'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['total', 'purchase_status'];

    /**
     * The user of the purchase.
     * 
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * The products that were purchased.
     * 
     */
    public function products()
    {
        return $this->hasMany(PurchasedProduct::class, 'purchase_id');
    }

    /**
     * Get the total price.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function total(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                // Initialize total variable
                $total = 0;

                $items = $this->products;

                // Sum total price of purchased products
                foreach ($items as $item) {
                    // Add up total price
                    $total += $item->price * $item->quantity;
                }

                return $total;
            },
        );
    }

    /**
     * Get the status of the purchase.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function purchaseStatus(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                return Carbon::parse($attributes['purchased_at'], 'Asia/Jakarta')->gt(Carbon::now('Asia/Jakarta')->subHours(3)) ? 'open' : 'closed';
            },
        );
    }
}
