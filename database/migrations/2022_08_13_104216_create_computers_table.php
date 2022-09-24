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
        Schema::create('computers', function (Blueprint $table) {
            $table->id();
            $table->string('pc_name');
            $table->string('processor');
            $table->string('os');
            $table->string('ram');
            $table->string('hdd');
            $table->string('ip');
            $table->string('ms_office')->nullable();
            $table->string('antivirus')->nullable();
            $table->string('wsus')->nullable();
            $table->string('user_login')->nullable();
            $table->string('brand')->nullable();
            $table->string('usage_type')->nullable();
            $table->string('location')->nullable();
            $table->date('date_fa')->nullable();
            $table->string('no_fa')->nullable();
            $table->string('edp_no_fa')->nullable();
            $table->timestamps();
            $table->unique('pc_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('computers');
    }
};
