<?php

namespace App\Http\Controllers;

use Icharle\Alipaytool\Alipaytool;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * 支付宝授权登录尝试
     * code值反馈
     *      40002  => authCode(授权码code)无效
     *      40006  => ISV权限不足，建议在开发者中心检查对应功能是否已经添加
     *      10000  => 请求成功
     */
    public function test()
    {
        $app = new Alipaytool();
        $alipay_system_oauth_token_response = $app::getAccessToken('996f30e7543349d0af85b18cff5fQX89');
        if (isset($alipay_system_oauth_token_response['code']) && $alipay_system_oauth_token_response['code']==40002 ){
            exit('授权码code无效');
        }
        echo $alipay_system_oauth_token_response['access_token'];
        /**
         * 执行成功后 $alipay_system_oauth_token_response => 可以得到如下
         * "access_token" => "authusrB6c5094353547498295d29fa707781X89"
         * "alipay_user_id" => "20880009409744196066652292516889"
         * "expires_in" => 1296000
         * "re_expires_in" => 2592000
         * "refresh_token" => "authusrB31dcd6b462f74193805faaf3af86eD89"
         * "user_id" => "2088122358263891"
         */

        $alipay_user_info_share_response = $app::getUserInfoByAccessToken($alipay_system_oauth_token_response['access_token']);
        if (isset($alipay_user_info_share_response['code']) && $alipay_user_info_share_response['code']==40006 ){
            exit('ISV权限不足，建议在开发者中心检查对应功能是否已经添加');
        }
        echo $alipay_user_info_share_response['user_id'];
        /**
         * 执行成功后 $alipay_user_info_share_response => 可以得到如下(按照需要存入数据库中)
         * "code" => "10000"
         * "msg" => "Success"
         * "avatar" => "https://tfs.alipayobjects.com/images/partner/T1tsxxXi0eXXXXXXXX"
         * "city" => "梅州市"
         * "gender" => "m"
         * "is_certified" => "T"
         * "is_student_certified" => "T"
         * "nick_name" => "*****超"
         * "province" => "广东省"
         * "user_id" => "2088122358263891"
         * "user_status" => "T"
         * "user_type" => "2"
         */

    }
}
