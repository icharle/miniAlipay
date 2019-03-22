<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class XtfxModel extends Model
{
    //系统分析师(上午题)
    protected $table="xtfx_morning";
    protected $fillable=["id","question","questionImg","optiona","optionb","optionc","optiond","answer","answeranalysis","field","questionNum","knowledgeOne","knowledgeTwo"];
}
