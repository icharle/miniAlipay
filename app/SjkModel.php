<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SjkModel extends Model
{
    //数据库系统工程师(上午题)
    protected $table="sjk_morning";
    protected $fillable=["id","question","questionImg","optiona","optionb","optionc","optiond","answer","answeranalysis","field"];
}
