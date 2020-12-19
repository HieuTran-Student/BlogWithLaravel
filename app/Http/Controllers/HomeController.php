<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\user\UserController;

class HomeController extends Controller
{
    function home()
    {
        $userController = new UserController();
        $post = $userController->queryPost()->paginate(4);
        return view('home', [
            'post' => $post,
            'title' => 'Trang Chủ',
        ]);
    }
}
