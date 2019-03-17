<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExaminationModel extends Model
{
    //软件设计师上午题
    protected $table="morning";
    protected $fillable=["id","question","questionImg","optiona","optionb","optionc","optiond","answer","answeranalysis","field"];
}
