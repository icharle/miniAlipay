<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WlModel extends Model
{
    //网络工程师(上午题)
    protected $table="wl_morning";
    protected $fillable=["id","question","questionImg","optiona","optionb","optionc","optiond","answer","answeranalysis","field","questionNum","knowledgeOne","knowledgeTwo"];
}
