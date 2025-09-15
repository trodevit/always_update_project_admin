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
        Schema::table('all_p_d_f_s', function (Blueprint $table) {
            $table->unsignedBigInteger('hsc_year')->nullable();

            $table->foreign('hsc_year')->references('id')->on('h_s_c_classes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('all_p_d_f_s', function (Blueprint $table) {
            //
        });
    }
};
