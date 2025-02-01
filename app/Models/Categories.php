<?php

namespace App\Models;

use App\Models\Products;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Categories extends Model
{
    protected $table = 'categories';
    protected $primaryKey = "id_category";
    protected $fillable = ['name'];

    // // Menambahkan eager loading default untuk relasi 'products'
    // protected $with = ['products'];

    public function products(): HasMany
    {
        // hasMany(Products::class): Menunjukkan bahwa satu kategori dapat memiliki banyak produk.
        return $this->hasMany(Products::class, 'category', 'id_category');
    }
}
