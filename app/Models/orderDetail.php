<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Products;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class orderDetail extends Model
{
    protected $table = 'order_details';
    protected $primaryKey = 'id_order_details';
    protected $fillable = [
        'order_id', 
        'product_id', 
        'quantity', 
        'subtotal'
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id', 'id_order');
    }

    public function dataProduct(): BelongsTo
    {
        return $this->belongsTo(Products::class, 'product_id', 'id_product');
    }
}
