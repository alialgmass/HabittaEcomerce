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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en');
            $table->text('full_description_ar');
            $table->text('full_description_en');
            $table->string('description_ar');
            $table->string('description_en');
            $table->enum('show_on_it',['new','offer']);
            $table->string('image')->nullable();
            $table->decimal('price', 8, 2);
            $table->decimal('discount', 8, 2)->nullable();
            $table->integer('quantity')->default(1);
            $table->boolean('active')->default(true);
            $table->decimal('sum_rating', 8, 2)->default(0);
            $table->integer('count_rating')->default(0);
            $table->integer('ordering')->default(1);
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
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






















