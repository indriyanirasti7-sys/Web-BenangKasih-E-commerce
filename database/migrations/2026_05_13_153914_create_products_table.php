<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('material')->nullable();         // bahan benang
            $table->string('yarn_type')->nullable();      // jenis benang
            $table->string('yarn_weight')->nullable();    // ketebalan benang
            $table->decimal('price', 10, 2);
            $table->enum('status', ['ready_stock', 'pre_order'])->default('ready_stock');
            $table->integer('stock')->default(0);
            $table->integer('estimated_days')->nullable(); // estimasi hari pengerjaan (pre-order)
            $table->string('size')->nullable();            // ukuran tersedia
            $table->json('colors')->nullable();            // pilihan warna
            $table->string('image')->nullable();           // foto utama
            $table->json('gallery')->nullable();           // foto tambahan
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};