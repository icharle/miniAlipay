<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    //用户信息数据表
    protected $table="users";
    protected $fillable=["id","user_id","nick_name","avatar","type","created_at"];
}
