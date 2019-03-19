<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatsModel extends Model
{
    //做题情况记录表
    protected $table="stats";
    protected $fillable=["id","user_id","type","field","statistical_error","error_count","time","score","created_at"];
}
