<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CxyModel extends Model
{
    //程序员(上午题)
    protected $table="cxy_morning";
    protected $fillable=["id","question","questionImg","optiona","optionb","optionc","optiond","answer","answeranalysis","field","questionNum","knowledgeOne","knowledgeTwo"];
}
