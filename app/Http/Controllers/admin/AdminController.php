<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class AdminController extends Controller
{

    public function __construct()
    {
    }

    #region Login, Logout, Dashboard
    function login()
    {
        if (Auth::check()) {
            return redirect('admin/dashboard');
        } else {
            return View('admin.login');
        }
    }

    // Submit Login
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

    //Logout View
    public function logout()
    {
        Auth::logout();
        return view('admin.login');
    }

    static function dashboard()
    {
        $countPost = Post::where('status', true)->count();
        $countCategory = Category::where('status', true)->count();
        $countMember = User::where('status', 1)->count();
        $countAdmin = User::where('status', -1)->count();

        return View('admin.dashboard.dashboard', [
            'countPost' => $countPost,
            'countCategory' =>  $countCategory,
            'countMember' => $countMember,
            'countAdmin' => $countAdmin
        ]);
    }
    #endregion

    #region Member
    public function viewMember()
    {
        $member = User::where('status', 1)->get();
        return view('admin.member.index', [
            'title' => 'Xem Thành Viên',
            'member' => $member
        ]);
    }

    public function deleteMember($id)
    {
        $member = User::find($id);
        $member->status = false;
        $member->save();

        return redirect()
            ->back()
            ->with('message', 'Đã xóa thành viên: ' . $member->name);
    }


    public function viewDeleteMember()
    {
        $member = User::where('status', 0)->get();
        return view('admin.member.restore', [
            'title' => 'Xem Thành Viên Đã Xóa',
            'member' => $member
        ]);
    }

    public function restoreMember($id)
    {
        $member = User::find($id);
        $member->status = true;
        $member->save();

        return redirect()
            ->back()
            ->with('message', 'Đã khôi phục thành viên: ' . $member->name);
    }
    #endregion



}
