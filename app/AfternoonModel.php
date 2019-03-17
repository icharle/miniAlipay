<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AfternoonModel extends Model
{
    //软件设计师下午题
    protected $table="afternoon";
    protected $fillable=["id","question","questionImg",
                          "optionAanswer","optionA","optionAanswerImg",
                          "optionBanswer","optionB","optionBanswerImg",
                          "optionCanswer","optionC","optionCanswerImg",
                          "optionDanswer","optionD","optionDanswerImg",
                          "optionEanswer","optionE","optionEanswerImg",
                          "field"];
}
