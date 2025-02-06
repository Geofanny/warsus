<?php

namespace App\Models;

use App\Models\User;
use App\Models\Payment;
use App\Models\orderDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id_order';
    protected $fillable = [
        'user_id', 'order_date', 
        'total_payment', 
        'status'
    ];

    protected $with = ['user'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }

    public function orderDetails(): HasMany
    {
        return $this->hasMany(orderDetail::class, 'order_id', 'id_order');
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class, 'order_id', 'id_order');
    }
}
