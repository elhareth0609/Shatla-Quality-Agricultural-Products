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
        Schema::create('sell__products', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('sell_id');
          $table->unsignedBigInteger('product_id');
          $table->decimal('price', 10, 2);
          $table->timestamps();

          $table->foreign('sell_id')->references('id')->on('sells')->onDelete('cascade');
          $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sell__products');
    }
};
