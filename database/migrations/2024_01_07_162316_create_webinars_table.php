<?php

use App\Models\User;
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
        Schema::create('webinars', function (Blueprint $table) {
            $table->id('web_id');
            $table->string('name');
            $table->string('link');
            $table->string('sched');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('sub_id');
            $table->unsignedBigInteger('type_id');
            $table->timestamps();

            // $table->foreign('user_id')->references('user_id')->on('web_id');
        });

        Schema::table('webinars', function (Blueprint $table) {
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('sub_id')->references('sub_id')->on('subjects');
            $table->foreign('type_id')->references('type_id')->on('webinar_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('webinars');
    }
};
