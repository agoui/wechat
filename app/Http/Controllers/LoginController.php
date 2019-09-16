<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
class LoginController extends Controller
{
    public function login()
    {

        return view('Login/login');
    }


    public function wechat_login()
    {
        $redirect_uri = 'http://www.blog.com/wechat/code';
        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . env('APPID') . '&redirect_uri=' . urlencode($redirect_uri) . '&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
        header('Location:' . $url);
    }

    /**+
     * 接收code
     */
    public function code(Request $request)
    {
        $req = $request->all();
//        dd($req);
        $result = file_get_contents('https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . env('APPID') . '&secret=' . env('APPSECRET') . '&code=' . $req['code'] . '&grant_type=authorization_code');
        $re = json_decode($result, 1);
//        dd($re);
        $user_info = file_get_contents('https://api.weixin.qq.com/sns/userinfo?access_token=' . $re['access_token'] . '&openid=' . $re['openid'] . '&lang=zh_CN');
        $wechat_user_info = json_decode($user_info, 1);
//        dd($wechat_user_info);
        $openid = $re['openid'];
        $wechat_info = DB::table('wecaht_user')->where(['openid' => $openid])->first();
        dd($wechat_info);
        if (!empty($wechat_info)) {
            //存在，登录
            $request->session()->put('uid', $wechat_info->uid);
            echo '好的呐';
        } else {
            //先注册，后登录
            DB::connection('wechat')->beginTransaction();//打开事务
            $uid = DB::table('user')->insertGetId([
                'name' => $wechat_user_info['nickname'],
                'password' => '',
                'reg_time' => time()
            ]);
            $insert_result = DB::table('wechat_user')->insert([
                'uid' => $uid,
                'openid' => $openid
            ]);
            //登录操作
            $request->session()->put('uid', $wechat_info['uid']);
            echo '你是先注册了然后登录';
        }


    }
}

