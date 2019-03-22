<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CollectionModel extends Model
{
    //收藏
    protected $table="collection";
    protected $fillable=["id","user_id","type","field","questionNum","created_at"];
}
