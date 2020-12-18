<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\post_category;
use App\Models\post_description;
use App\Models\post_short_description;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{

    public function queryPost()
    {
        $data = DB::table('posts')
            ->join('post_categories', 'posts.id', '=', 'post_categories.post_id')
            ->join('categories', 'categories.id', '=', 'post_categories.cat_id')
            ->where('posts.status', '=', '1')
            ->select(
                'posts.id',
                'posts.title as post_title',
                'posts.image',
                'categories.title as cat_title',
                'categories.id as cat_id'
            )
            ->get();

        return $data;
    }

    // điều kiên status = false
    public function queryPostDelete()
    {
        $data = DB::table('posts')
            ->join('post_categories', 'posts.id', '=', 'post_categories.post_id')
            ->join('categories', 'categories.id', '=', 'post_categories.cat_id')
            ->where('posts.status', '=', '0')
            ->select(
                'posts.id',
                'posts.title as post_title',
                'posts.image',
                'categories.title as cat_title',
                'categories.id as cat_id'
            )
            ->get();

        return $data;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // query vjp pro (posts - categories - posts_categories)
        $data = $this->queryPost();
        return View('admin.post.index', [
            'lstPost' => $data,
            'title' => 'Bài Viết',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cat = Category::where('status', true)->get();
        return view('admin.post.create', [
            'cat' => $cat,
            'title' => 'Tạo Bài Viết'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'post_image' => 'required'
        ]);

        if ($request->hasFile('post_image')) {
            $image = $request->file('post_image');
            $reImage = time() . '.' . $image->getClientOriginalExtension();
            $dest = public_path('/img');
            $image->move($dest, $reImage);

            // Post Table
            $post = new Post;
            $post->title = $request->title;
            $post->image = $reImage;
            $post->user_id = Auth::user()->id;
            return dd($post->user_id);
            $post->save();

            // Post_category Table
            $post_category = new post_category;
            $post_category->cat_id = $request->category;
            $post_category->post_id = $post->id;
            $post_category->save();

            return redirect('admin/post')->with('message', 'Thêm bài viết thành công');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Truy vấn 1 hàng Post vừa chọn
        $post_Edit = $this->queryPost();
        $post_Edit = $post_Edit->where('id', $id)->first();
        // return var_dump($post_Edit->image);
        // Truy vấn 1 hàng post_category của Post vừa chọn
        $Post_cat = post_category::where('cat_id', $post_Edit->cat_id)->where('post_id', $post_Edit->id)->first();
        // Truy vấn bảng Category
        $cat = Category::where('status', true)->get();

        return View('admin.post.update', [
            'post_Edit' => $post_Edit, // Post row
            'cat' => $cat, // cat table
            'Post_cat_Edit' => $Post_cat, // Post_category row
            'title' => 'Sửa Bài Viết'
        ]);
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
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'post_image' => 'required'
        ]);

        if ($request->hasFile('post_image')) {
            $image = $request->file('post_image');
            $reImage = time() . '.' . $image->getClientOriginalExtension();
            $dest = public_path('/img');
            $image->move($dest, $reImage);
        } else {
            $reImage = $request->post_image;
        }

        // Post Table
        $post =  Post::find($id);
        $post->title = $request->title;
        $post->image = $reImage;
        $post->user_id = Auth::user()->id;
        $post->save();
        // Post_category Table
        $post_category =  post_category::find($request->post_cat_id);
        $post_category->cat_id = $request->category;
        $post_category->post_id = $post->id;
        $post_category->save();

        return redirect('admin/post')->with('message', 'Thêm bài viết thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

    public function delete($id)
    {
        // Lấy ra 1 dòng của bảng Post theo id
        $data_Delete = $this->queryPost();
        $data_Delete = $data_Delete->where('id', $id)->first();
        $Post_cat_Delete = post_category::where('cat_id', $data_Delete->cat_id)->where('post_id', $data_Delete->id)->first();
        $Post_cat_Delete->status = false;
        $Post_cat_Delete->save();
        //Chuyển status thành false (disable)
        $post =  Post::find($id);
        $post->status = false;
        $post->save();

        return redirect("admin/post");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function viewRestore()
    {
        $post_Delete = $this->queryPostDelete();
        return View('admin.post.Restore', [
            'lstPost_Delete' => $post_Delete,
            'title' => 'Bài đã xóa'
        ]);
    }

    /**
     * Restore the specified resource.
     *

     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        // Lấy ra 1 dòng của bảng Post theo id
        $data_Delete = $this->queryPostDelete();
        $data_Delete = $data_Delete->where('id', $id)->first();
        $Post_cat_Delete = post_category::where('cat_id', $data_Delete->cat_id)->where('post_id', $data_Delete->id)->first();
        $Post_cat_Delete->status = true;
        $Post_cat_Delete->save();
        //Chuyển status thành false (disable)
        $post =  Post::find($id);
        $post->status = true;
        $post->save();

        return redirect('admin/post');
    }

    public function createPostContent($id)
    {
        $post_desc = post_description::where('post_id', $id)->count();
        if ($post_desc != 0) {
            return redirect()->back()->with('message', 'Bài viết đã có nội dung');
        }
        // Truy vấn 1 hàng Post vừa chọn
        $post = $this->queryPost();
        $post = $post->where('id', $id)->first();
        return View('admin.post_description.formCreatePostContent', [
            'post' => $post, // Post row
            'title' => 'Thêm Nội Dung Bài Viết'
        ]);
    }

    public function savePostContent(Request $request)
    {
        $request->validate([
            'short_description' => 'required',
            'post_description' => 'required',
        ]);

        // Lưu short description
        $short_desc = new post_short_description;
        $short_desc->short_description = $request->short_description;
        $short_desc->post_id = $request->post_id;
        $short_desc->save();

        // Lưu nội dung bài viết
        $desc = new post_description;
        $desc->descriptions = $request->post_description;
        $desc->post_id = $request->post_id;
        $desc->save();

        return redirect('admin/post');
    }

    public function viewPostDescription($id)
    {
        // Lấy post theo id
        $post = Post::where('status', true)->where('id', $id)->first();
        $author_id = $post->user_id;
        // lấy tác giả
        $author = User::where('status', -1)
            ->orwhere('status', 1)
            ->where('id', $author_id)
            ->first();
        // lấy nội dung của post
        $post_desc = post_description::where('post_id', $id)->first();
        if (!isset($post_desc))
            return var_dump($post_desc);
        //lấy mô tả
        $post_shortDesc = post_short_description::where('post_id', $id)->first();
        // format thời gian
        $time = date('d/m/Y', strtotime($post_desc->created_at));
        return View('admin.post_description.post_description', [
            // pass qua bên blade.php
            'post' => $post,
            'author' => $author,
            'post_desc' => $post_desc,
            'time' => $time,
            'post_shortDesc' => $post_shortDesc
        ]);
    }

    public function editPostDescription($id)
    {
        // Truy vấn bài post được chọn
        $post = $this->queryPost();
        $post = $post->where('id', $id)->first();
        // Truy vấn nội dung của post đc chọn
        $post_desc = post_description::where('post_id', $id)->first();

        $post_short_desc = post_short_description::where('post_id', $id)->first();

        return View('admin.post_description.formEditPostContent', [
            'post' => $post,
            'post_desc' => $post_desc,
            'post_short_desc' => $post_short_desc,
            'title' => 'Sửa Nội Dung Bài Viết'
        ]);
    }

    public function updatePostDescription(Request $request)
    {
        $request->validate([
            'short_description' => 'required',
            'post_description' => 'required',
        ]);

        // Lưu short description
        $short_desc = post_short_description::where('status', true)
            ->where('post_id', $request->post_id)->first();

        $short_desc->short_description = $request->short_description;
        $short_desc->post_id = $request->post_id;
        $short_desc->save();

        // Lưu nội dung bài viết
        $desc = post_description::where('status', true)
            ->where('post_id', $request->post_id)->first();

        $desc->descriptions = $request->post_description;
        $desc->post_id = $request->post_id;
        $desc->save();

        return redirect('admin/post/postDescription/' . $request->post_id);
    }
}
