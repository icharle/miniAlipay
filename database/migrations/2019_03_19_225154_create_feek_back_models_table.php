<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeekBackModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feekback', function (Blueprint $table) {
            $table->increments('id');
            $table->string("user_id")->collation("utf8_general_ci");
            $table->string('content')->colation("utf8_general_ci");
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
        Schema::dropIfExists('feek_back_models');
    }
}
