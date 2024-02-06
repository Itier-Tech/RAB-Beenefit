<?php

return new class extends Migration
{
    public function up(): void {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('item_name');
            $table->intdiv('buy_price');
            $table->intdiv('sell_price');
            $table->string('category');
            $table->string('unit');
            $table->timestamps();
        });
    }

};

