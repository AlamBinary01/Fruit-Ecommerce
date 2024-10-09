<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'address',
        'town_city',
        'country',
        'postcode_zip',
        'mobile',
        'email',
        'total_amount',
        'payment_method',
        'payment_id' // Add payment_id to the list
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product')->withPivot('quantity', 'name', 'price');
    }
}
