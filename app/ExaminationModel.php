<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExaminationModel extends Model
{
    //
    protected $table="morning";
    protected $fillable=["id","question","questionImg","optiona","optionb","optionc","optiond","answer","answeranalysis","field"];
}
