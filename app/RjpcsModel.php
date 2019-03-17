<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RjpcsModel extends Model
{
    //软件评测师(上午题)
    protected $table="rjpcs_morning";
    protected $fillable=["id","question","questionImg","optiona","optionb","optionc","optiond","answer","answeranalysis","field"];
}
