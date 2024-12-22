<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('market_items', function (Blueprint $table) {
            $table->id();
            $table->string('item_name');
            $table->decimal('price', 10, 2);
            $table->text('description');
            $table->string('seller_name');
            $table->string('phone_number');
            $table->text('address');
            $table->text('images');
            $table->enum('status', ['available', 'sold']);
            $table->timestamps();
            $table->string('slug')->unique();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('market_items');
    }
};
