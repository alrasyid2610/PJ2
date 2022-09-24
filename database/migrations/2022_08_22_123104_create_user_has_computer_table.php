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
        Schema::create('user_has_computers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_computer');
            $table->string('name');
            $table->string('pc_name');
            $table->string('section');
            $table->string('location');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_has_computers');
    }
};
