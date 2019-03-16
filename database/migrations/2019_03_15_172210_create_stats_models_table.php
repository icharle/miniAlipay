<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatsModelsTable extends Migration
{
    /**
     * Run the migrations.
     *做题情况记录表
     * user_id关联users_data主键，field(哪套题),"Statistical_error"(错题记录)，"error_count"(错题数目),"score"(总分)
     * @return void
     */
    public function up()
    {
        Schema::create('stats', function (Blueprint $table) {
            $table->increments("id");
            $table->string("user_id",32);
//            $table->foreign("user_id")->references('id')->on('users_data');
            $table->string("field")->collation("utf8_general_ci");
            $table->string("statistical_error")->collation("utf8_general_ci");
            $table->integer("error_count")->collation("utf8_general_ci");
            $table->integer("score")->collation("utf8_general_ci");
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
        Schema::dropIfExists('stats_models');
    }
}
