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
        Schema::create('honors_questions', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->string('class_name');
            $table->string('group');
            $table->unsignedBigInteger('subject');
            $table->string('title');
            $table->string('pdf');
            $table->string('thumbnail');

            $table->foreign('subject')
                ->references('id')
                ->on('subjects')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('honors_questions');
    }
};
