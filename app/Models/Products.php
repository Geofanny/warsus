<?php

namespace App\Models;

use App\Models\Categories;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Products extends Model
{
    protected $table = 'products';
    protected $primaryKey = "id_product";
    protected $fillable = ['name','description','price','stock','category','product_image'];
    
    // // Menambahkan eager loading default untuk relasi 'category'
    protected $with = ['dataCategory'];

    public function dataCategory(): BelongsTo
    {
        // belongsTo(Categories::class): Menunjukkan bahwa setiap produk berhubungan dengan satu kategori.
        return $this->belongsTo(Categories::class, 'category');
    }
}
