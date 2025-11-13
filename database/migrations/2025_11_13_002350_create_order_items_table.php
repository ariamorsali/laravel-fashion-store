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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('order_id')->constrained('orders')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('color_id')->nullable()->constrained('product_colors')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('size_id')->nullable()->constrained('product_sizes')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('amazing_sale_id')->nullable()->constrained('amazing_sales')->onUpdate('cascade')->onDelete('set null');

            $table->json('product_snapshot')->nullable();
            $table->json('amazing_sale_snapshot')->nullable();

            $table->decimal('amazing_sale_discount_amount', 15, 2)->nullable();
            $table->unsignedInteger('quantity')->default(1);
            $table->decimal('final_product_price', 15, 2)->nullable();
            $table->decimal('final_total_price', 15, 2)->nullable()->comment('quantity * final_product_price');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
