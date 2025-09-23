<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // public function up(): void
    // {
    //     Schema::create('banners', function (Blueprint $table) {
    //         $table->id();
    //         $table->foreignId('category_id')->nullable()->constrained('product_categories')->nullOnDelete();
    //         $table->string('title');
    //         $table->string('subtitle')->nullable();
    //         $table->text('image');
    //         $table->string('url')->nullable();
    //         $table->tinyInteger('position')->default(0)->comment('developer explain 0 or 1 ... in banner model')->comment('0 = main slider, 1 = small banners, ...');;
    //         $table->tinyInteger('status')->default(1);
    //         $table->timestamps();
    //         $table->softDeletes();
    //     });
    // }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
