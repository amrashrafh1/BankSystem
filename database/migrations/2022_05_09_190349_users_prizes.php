<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_prizes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prize_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('prize_id')
                ->references('id')
                ->on('prizes');

            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->unique(['prize_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_prizes');
    }
};
