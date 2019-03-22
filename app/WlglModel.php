<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WlglModel extends Model
{
    //网络管理员(上午题)
    protected $table="wlgl_morning";
    protected $fillable=["id","question","questionImg","optiona","optionb","optionc","optiond","answer","answeranalysis","field","questionNum","knowledgeOne","knowledgeTwo"];
}
