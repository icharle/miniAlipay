<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MediaModel extends Model
{
    //多媒体应用设计师(上午题)
    protected $table="media_morning";
    protected $fillable=["id","question","questionImg","optiona","optionb","optionc","optiond","answer","answeranalysis","field"];
}
