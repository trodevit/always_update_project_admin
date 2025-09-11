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
        Schema::create('all_p_d_f_s', function (Blueprint $table) {
            $table->id();
            $table->string('class_name');
            $table->string('types');
            $table->string('group');
            $table->string('question_types');
            $table->unsignedBigInteger('subjects');
            $table->string('title');
            $table->string('thumbnail');
            $table->string('pdf');
            $table->foreign('subjects')->references('id')->on('subjects');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('all_p_d_f_s');
    }
};
