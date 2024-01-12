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
        Schema::create('activity', function (Blueprint $table) {
            $table->id('act_id');
            $table->string('name');
            $table->string('deadline');
            $table->boolean('isDone');
            $table->bigInteger('user_id');
            $table->bigInteger('sub_id');
            $table->timestamps();
        });

        Schema::table('activity', function (Blueprint $table) {
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('sub_id')->references('sub_id')->on('subjects');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity');
    }
};
