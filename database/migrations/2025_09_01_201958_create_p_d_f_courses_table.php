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
        Schema::create('p_d_f_courses', function (Blueprint $table) {
            $table->id();
            $table->string('class_name');
            $table->string('types');
            $table->string('group');
            $table->string('title');
            $table->string('thumbnail');
            $table->string('url');
            $table->string('pdf');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p_d_f_courses');
    }
};
