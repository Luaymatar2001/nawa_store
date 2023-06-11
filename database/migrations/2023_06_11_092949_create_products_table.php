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
            $table->string('name', 255);
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('short_description')->nullable();
            $table->float('price')->default(0);
            $table->float('compare_price')->nullable();
            //يحدد عدد الكسور
            // $table->decimal('price' , 4);
            $table->string('image', 255);
            //    enumeration
            $table->enum('status', ['draft', 'active', 'archived'])->default('active');
            $table->unsignedBigInteger('category_id')->nullable();
            // $table->foreignId('category_id')->constrained('categories' , 'id');

            // ->restrictOnDelete()
            // ->cascadeOnDelete()
            $table->foreign('category_id')->references('id')->on('categories')->nullOnDelete();
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
