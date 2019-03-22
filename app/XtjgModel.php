<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class XtjgModel extends Model
{
    //系统架构设计师(上午题)
    protected $table="xtjg_morning";
    protected $fillable=["id","question","questionImg","optiona","optionb","optionc","optiond","answer","answeranalysis","field","questionNum","knowledgeOne","knowledgeTwo"];
}
