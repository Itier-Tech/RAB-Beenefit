<?php

return new class extends Migration
{
    public function up(): void {
        Schema::create('rab_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->floatval('item_discount');
            $table->intdiv('item_count');
            $table->timestamps();
        });
    }
};
