<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $table = 'payments';
    protected $primaryKey = 'id_payments';
    protected $fillable = [
        'order_id', 
        'payment_method', 
        'payment_status', 
        'payment_date'
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id', 'id_order');
    }
}
