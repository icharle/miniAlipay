<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class XxxtModel extends Model
{
    //信息系统管理工程师(上午题)
    protected $table="xxxt_morning";
    protected $fillable=["id","question","questionImg","optiona","optionb","optionc","optiond","answer","answeranalysis","field"];
}
