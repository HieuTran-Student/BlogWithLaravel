<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\post_short_description;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\admin\PostController;
use App\Models\Category;
use Facade\FlareClient\View;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    public function __construct()
    {
    }
    public function queryPost()
    {
        $data = DB::table('posts')
            //Category
            ->join('post_categories', 'posts.id', '=', 'post_categories.post_id')
            ->join('categories', 'categories.id', '=', 'post_categories.cat_id')
            //Description - Short Description
            ->join('post_short_descriptions', 'post_short_descriptions.post_id', '=', 'posts.id')
            ->join('post_descriptions', 'post_descriptions.post_id', '=', 'posts.id')
            //User
            ->join('users', 'users.id', '=', 'posts.user_id')
            // post status = 1
            ->where('posts.status', '=', '1')
            // post_id, post_title, post_image, postPublishTime, shortDesc, desc, catTitle, catId
            ->select(

                'posts.title as postTitle',
                'posts.id',
                'posts.image as postImage',
                'posts.created_at as publishTime',
                'users.name as author',
                'post_short_descriptions.short_description as shortDesc',
                'post_descriptions.descriptions as desc',
                'categories.title as catTitle',
                'categories.id as catId'
            );

        return $data;
    }
    public function queryPostCategory($id)
    {
        $data = DB::table('posts')
            //Category
            ->join('post_categories', 'posts.id', '=', 'post_categories.post_id')
            ->join('categories', 'categories.id', '=', 'post_categories.cat_id')
            //Description - Short Description
            ->join('post_short_descriptions', 'post_short_descriptions.post_id', '=', 'posts.id')
            ->join('post_descriptions', 'post_descriptions.post_id', '=', 'posts.id')
            //User
            ->join('users', 'users.id', '=', 'posts.user_id')
            // post status = 1
            ->where('posts.status', '=', '1')
            ->where('categories.id', '=', $id)
            // post_id, post_title, post_image, postPublishTime, shortDesc, desc, catTitle, catId
            ->select(

                'posts.title as postTitle',
                'posts.id',
                'posts.image as postImage',
                'posts.created_at as publishTime',
                'users.name as author',
                'post_short_descriptions.short_description as shortDesc',
                'post_descriptions.descriptions as desc',
                'categories.title as catTitle',
                'categories.id as catId'
            );

        return $data;
    }


    #region Login
    public function login()
    {
        if (Auth::check()) {
            return Auth::logout();
        } else {
            return View('user.login');
        }
    }

    public function logout()
    {
        Auth::logout();
        //return view('user.login');
        return redirect('/');
    }

    public function submitLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $userCheck = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($userCheck)) {
            return  redirect('user/home');
        } else {
            return redirect()->back()->with('error', 'Email hoặc Password không chính xác');
        }
    }
    #endregion

    #region Sign Up
    public function signUp()
    {
        return view('user.signup');
    }

    public function submitSignUp(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'confirmPassword' => 'required'
        ]);

        $allUser = User::all();
        if ($allUser->where('email', $request->email)->first() != null) {
            return redirect()->back()->with('error', 'email đã được sử dụng');
        }

        // Nếu 2 chuỗi khớp nhau
        if (strcmp($request->password, $request->confirmPassword) == 0) {
            $user = new User;

            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::Make($request->password);
            $user->save();

            // return View('user.homePage', [
            //     'userName' => $user->name,
            //     'email' => $user->email,
            //     'title' => 'Trang chủ'
            // ]);
            return redirect('user/home');
        } else {
            return redirect()->back()->with('error', 'Mật khẩu không trùng khớp');
        }
    }
    #endregion

    public function homePageGuest()
    {
        $post = $this->queryPost()->paginate(4);
        foreach ($post as $item => $value) {
            $value->publishTime = date('d/m/Y', strtotime($value->publishTime));
        }
        return view('user.homePage', [
            'post' => $post,
            'title' => 'Trang Chủ Guest'
        ]);
    }

    public function homePage()
    {
        $post = $this->queryPost()->paginate(4);
        foreach ($post as $item => $value) {
            $value->publishTime = date('d/m/Y', strtotime($value->publishTime));
        }
        if (Auth::check()) {
            return view('user.homePage', [
                'userName' => Auth::user()->name,
                'email' => Auth::user()->email,
                'post' => $post,
                'title' => 'Trang Chủ User '
                // 'allPosts' => $allPosts
            ]);
        } else {
            return view('user.homePage', [
                'userName' => Auth::user()->name,
                'post' => $post,
                'title' => 'Trang Chủ User '
                // 'allPosts' => $allPosts
            ]);
        }
    }

    public function postWithCategory($id)
    {
        $queryPost = $this->queryPostCategory($id)->paginate(4);
        foreach ($queryPost as $item => $value) {
            $value->publishTime = date('d/m/Y', strtotime($value->publishTime));
        }
        // Truy vấn Post liên quan theo Category

        $title = Category::where('id', $id)->first();
        $title = $title->title;
        if (Auth::check()) {
            return view('user.postWithCategory', [
                'postWithCategory' => $queryPost,
                'userName' => Auth::user()->name,
                'title' => $title
            ]);
        } else {
            return view('user.postWithCategory', [
                'postWithCategory' => $queryPost,
                'title' => $title
            ]);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Truy vấn post có category

        $queryPost = $this->queryPost();

        // Truy vấn post theo Id
        $postData = $this->queryPost()->where('posts.id', $id)->get();
        $postData[0]->publishTime = date('d/m/Y', strtotime($postData[0]->publishTime));
        // Truy vấn Post liên quan theo Category
        $relatePost = $queryPost->where('cat_id', $postData[0]->catId)
            ->where('posts.id', '!=', $id)
            ->get();

        // Truy vấn Category
        $cat = Category::where('status', true)->get();

        if (Auth::check()) {
            return View('user.post', [
                'postData' => $postData,
                'userName' => Auth::user()->name,
                'cat' => $cat,
                'relatePost' => $relatePost,
                'title' => $postData[0]->postTitle
            ]);
        } else {
            return View('user.post', [
                'postData' => $postData,

                'cat' => $cat,
                'relatePost' => $relatePost,
                'title' => $postData[0]->postTitle
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
