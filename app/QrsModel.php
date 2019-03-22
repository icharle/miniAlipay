<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QrsModel extends Model
{
    //嵌入式系统设计师(上午题)
    protected $table="qrs_morning";
    protected $fillable=["id","question","questionImg","optiona","optionb","optionc","optiond","answer","answeranalysis","field","questionNum","knowledgeOne","knowledgeTwo"];
}
