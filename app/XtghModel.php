<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class XtghModel extends Model
{
    //系统规划与管理师(上午题)
    protected $table="xtgh_morning";
    protected $fillable=["id","question","questionImg","optiona","optionb","optionc","optiond","answer","answeranalysis","field"];
}
