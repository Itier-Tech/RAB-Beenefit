<?php

return new class extends Migration
{
    public function up(): void {
        Schema::create('rabs', function (Blueprint $table) {
            $table->id();
            $table->string('project_id');
            $table->intdiv('status');
            $table->floatval('rab_discount');
            $table->intdiv('total_price');
        });
    }
};
