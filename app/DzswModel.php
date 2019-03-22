<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DzswModel extends Model
{
    //电子商务设计师(上午题)
    protected $table="dzsw_morning";
    protected $fillable=["id","question","questionImg","optiona","optionb","optionc","optiond","answer","answeranalysis","field","questionNum","knowledgeOne","knowledgeTwo"];
}
