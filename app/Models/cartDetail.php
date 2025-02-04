<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\Products;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class cartDetail extends Model
{
    protected $table = 'cart_details';
    protected $primaryKey = 'id_cart_detail';

    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
        'subtotal',
    ];

    protected $with = ['cart','product'];

    // Relasi Many to One ke Cart
    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }

    // Relasi Many to One ke Product
    public function product(): BelongsTo
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
}
