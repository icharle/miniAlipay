<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDataModel extends Model
{
    //用户信息数据表
    protected $table="users_data";
    protected $fillable=["id","user_id","nick_name","avatar","created_at"];
}
