<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeekBackModel extends Model
{
    //
    protected $table="feekback";
    protected $fillable=["id","user_id","content","created_at","updated_at"];
}
