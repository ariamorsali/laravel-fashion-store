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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('city_id')->constrained('cities')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('province_id')->constrained('provinces')->onUpdate('cascade')->onDelete('cascade');
            $table->string('postal_code');
            $table->text('address');
            $table->string('no')->nullable()->comment('پلاک خانه');
            $table->string('unit')->nullable()->comment('شماره واحد');
            $table->string('recipient_name')->nullable()->comment('نام گیرنده');
            $table->string('mobile')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
