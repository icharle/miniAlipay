<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDataModelsTable extends Migration
{
    /**
     * Run the migrations.
     *用户信息数据表
     * @return void
     */
    public function up()
    {
        Schema::create('users_data', function (Blueprint $table) {
            $table->increments("id");
            $table->string("user_id")->collation("utf8_general_ci");
            $table->string("nick_name")->collation("utf8_general_ci");
            $table->string("avatar")->collation("utf8_general_ci");
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
        Schema::dropIfExists('user_data_models');
    }
}
