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
            $table->uuid("id")->primary();
            $table->string('title');
            $table->string('slug');
            $table->text('description');
            $table->json('attributes');
            $table->json('measures');
            $table->json('classification'); /* TODO: change this to foreign IDs*/
            $table->json('quotation');
            $table->json('images');
            $table->json('documentation');
            $table->foreignId('availability_id')->references('id')->on('availabilities');
            $table->integer('stock');
            $table->json('accessories');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
