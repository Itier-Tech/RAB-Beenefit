<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void {
        Schema::create('rab_items', function (Blueprint $table) {
            $table->unsignedBigInteger('rab_id');
            $table->unsignedBigInteger('item_id');
            $table->float('item_discount')->nullable();
            $table->integer('item_count')->nullable();
            $table->timestamps();

            $table->primary(['rab_id', 'item_id']);

            $table->foreign('rab_id')->references('rab_id')->on('rabs')->onDelete('cascade');
            $table->foreign('item_id')->references('item_id')->on('items')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rab_items');
    }
};
