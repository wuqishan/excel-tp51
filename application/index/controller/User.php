<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use app\index\repositories\UserRepository;
use think\Session;

class User extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function doLogin(Request $request)
    {
        $username = $request->post('username');
        $password = $request->post('password', '', 'md5');

        $userRepository = new UserRepository();
        if ($userRepository->login($username, $password)) {
            return redirect('/');
        } else {
            return redirect('/login')->with('message', '账号或密码有误！');
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        return redirect('/login')->with('message', '已注销登陆！');
    }
}
