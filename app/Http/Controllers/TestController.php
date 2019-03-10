<?php

namespace App\Http\Controllers;

use Icharle\Alipaytool\Alipaytool;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * 支付宝授权登录尝试
     */
    public function test()
    {
        $app = new Alipaytool();
//        $result = $app::getAccessToken('d5ae9ae03132423c868e46a395dbXX89');
        $result = $app::getUserInfoByAccessToken('authusrB2a7e1f736b574c25be425afbd573fA89');
//        $result = $app::getUserInfoByAccessToken('authusrB2a7e1f736b574c25be425afbd573fA89');
        dd($result);
    }
}
