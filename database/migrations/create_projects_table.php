<?php

return new class extends Migration
{
    public function up(): void {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('mandor_id');
            $table->string('client_name');
            $table->string('project_address');
            $table->string('project_name');
            $table->intdiv('budget');
            $table->timestamps();
        });
    }
};
