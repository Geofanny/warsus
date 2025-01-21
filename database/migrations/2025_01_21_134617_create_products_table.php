<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    // ONE TO MANY
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id("id_product");
            $table->string("name",120);
            $table->text("description");
            $table->integer("price");
            $table->integer("stock");
            $table->unsignedBigInteger('category');
            $table->foreign('category')->references('id_category')->on('categories')->onUpdate('cascade')->onDelete('cascade');
            $table->string("product_image");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
