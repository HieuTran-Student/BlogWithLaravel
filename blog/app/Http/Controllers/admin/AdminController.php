<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class AdminController extends Controller
{

    public function __construct()
    {
    }

    #region Login View
    function login()
    {
        if (Auth::check()) {
            return redirect('admin/dashboard');
        } else {
            return View('admin.login');
        }
    }
    #endregion

    #region Logout View
    function logout()
    {
        Auth::logout();
        return view('admin.login');
    }

    #region Submit Login
    public function submit_login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $userCheck = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($userCheck)) {
            return redirect('admin/dashboard');
        } else {
            return redirect()->back()->with('error', 'Email hoặc Password không chính xác');
        }
    }
    #endregion

    #region Dashboard
    static function dashboard()
    {
        return View('admin.dashboard.dashboard');
    }
    #endregion
}
