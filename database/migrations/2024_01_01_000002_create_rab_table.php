<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rab', function (Blueprint $table) {
            $table->bigIncrements('rab_id');
            $table->unsignedBigInteger('project_id');
            $table->integer('status');
            $table->float('rab_discount')->nullable();
            $table->integer('total_price')->nullable();
            $table->timestamps();

            $table->foreign('project_id')->references('project_id')->on('projects')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rab');
    }
};
