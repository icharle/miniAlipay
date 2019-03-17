<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class XtjcModel extends Model
{
    //系统集成项目管理工程师(上午题)
    protected $table="xtjc_morning";
    protected $fillable=["id","question","questionImg","optiona","optionb","optionc","optiond","answer","answeranalysis","field"];
}
