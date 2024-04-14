<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cart__products', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('product_id');
          $table->unsignedBigInteger('cart_id');
          $table->decimal('price', 10, 2);
          $table->string('quantity');
          $table->timestamps();

          $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
          $table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart__products');
    }
};
