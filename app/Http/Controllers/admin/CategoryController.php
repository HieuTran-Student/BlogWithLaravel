<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{

    public function __construct()
    {
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Category::where('status', true)->get();
        return View('admin.category.index', [
            'lstCategories' => $data,
            'title' => 'Thể Loại',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('admin.category.create', [
            'title' => 'Thêm thể loại',
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
            'title' => 'required'
        ]);


        if ($request->hasFile('cat_image')) {
            $image = $request->file('cat_image');
            $reImage = time() . '.' . $image->getClientOriginalExtension();
            $dest = public_path('/img');
            $image->move($dest, $reImage);
            $category = new Category;
            $category->title = $request->title;
            $category->detail = $request->detail;
            $category->image = $reImage;
            $category->save();
        }

        return redirect('admin/category')->with('message', 'Thêm thể loại thành công');
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
        $data = Category::find($id);
        return View('admin.category.update', [
            'lstCategoriesEdit' => $data,
            'title' => 'Sửa thể loại'
        ])->with('message', 'Đã xóa thành viên: ' . $data->title);;
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
            'title' => 'required'
        ]);

        if ($request->hasFile('cat_image')) {
            $image = $request->file('cat_image');
            $reImage = time() . '.' . $image->getClientOriginalExtension();
            $dest = public_path('/img');
            $image->move($dest, $reImage);
        } else {
            $reImage = $request->cat_image;
        }

        $category = Category::find($id);
        $category->title = $request->title;
        $category->detail = $request->detail;
        $category->image = $reImage;
        $category->save();

        return redirect('admin/category')->with('message', 'Chỉnh sửa thể loại thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category =  Category::where('id', $id)->first();
        $category->status = false;
        $category->save();
        return redirect('admin/category')->with('message', 'Đã xóa thể loại: ' . $category->title);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function viewRestore()
    {
        $restore = Category::where('status', false)->get();
        return view('admin.category.restore', [
            'del_Cat' => $restore,
            'title' => 'Thể loại đã xóa'
        ]);
    }

    /**
     * Restore the specified resource.
     *

     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $restore = Category::where('id', $id)->first();
        $restore->status = true;
        $restore->save();
        return redirect('admin/category')->with('message', 'Đã khôi phục thể loại: ' . $restore->title);
    }
}
