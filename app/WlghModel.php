<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WlghModel extends Model
{
    //网络规划设计师(上午题)
    protected $table="wlgh_morning";
    protected $fillable=["id","question","questionImg","optiona","optionb","optionc","optiond","answer","answeranalysis","field"];
}
