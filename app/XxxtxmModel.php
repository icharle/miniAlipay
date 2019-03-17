<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class XxxtxmModel extends Model
{
    //信息系统项目管理师(上午题)
    protected $table="xxxtxm_morning";
    protected $fillable=["id","question","questionImg","optiona","optionb","optionc","optiond","answer","answeranalysis","field"];
}
