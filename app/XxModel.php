<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class XxModel extends Model
{
    //信息系统监理师(上午题)
    protected $table="xx_morning";
    protected $fillable=["id","question","questionImg","optiona","optionb","optionc","optiond","answer","answeranalysis","field","questionNum","knowledgeOne","knowledgeTwo"];
}
