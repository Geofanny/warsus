<?php

namespace App\Models;

use App\Models\User;
use App\Models\cartDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    protected $table = 'carts';
    protected $primaryKey = 'id_cart';
    
    protected $fillable = [
        'user_id', 
        'total_price',
    ];

    protected $with = ['user'];

    public function cartDetails(): HasMany
    {
        // hasMany(Products::class): Menunjukkan bahwa satu kategori dapat memiliki banyak produk.
        return $this->hasMany(cartDetail::class, 'cart_id','id_cart');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
