<?php


namespace Yuanrang\LaravelShop\Wap\Member\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yuanrang\LaravelShop\Wap\Member\Models\User;

class AuthorizationsController extends Controller
{

    public function index()
    {
        return view('view::index');
    }

    public function wechatStore(Request $request)
    {
        $wechatUser = session('wechat.oauth_user.default');
        $user = User::where('weixin_openid', $wechatUser->id)->first();
//        dd($user);
        if (!$user) {
            $user = User::create([
                'nick_name'     => $wechatUser->nickname ?? '',
                'weixin_openid' => $wechatUser->id ?? '',
                'image_head'    => $wechatUser->avatar ?? '',
            ]);
        }
//        改变用户登录状态
        Auth::guard('member')->login($user);
        dd(Auth::check());

        return redirect()->route('wap.member.index');

    }




}