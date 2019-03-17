<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class XxaqModel extends Model
{
    //信息安全工程师(上午题)
    protected $table="xxaq_morning";
    protected $fillable=["id","question","questionImg","optiona","optionb","optionc","optiond","answer","answeranalysis","field"];
}
