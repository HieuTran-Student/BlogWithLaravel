@extends('layouts.admin')
@section('title', $title)

@section('content')

    <div class="right">
        <div class="right__content">
            <div class="right__title">Bảng điều khiển</div>
            <p class="right__desc">Thêm bài đăng</p>
            <div class="right__formWrapper">
            <form action="{{url('admin/post')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="right__inputWrapper">
                        <label for="category" >Thể loại</label>
                        <select class="form-check-label" name="category">
                            @foreach ($cat as $item)
                                <option value="{{$item->id}}">{{$item->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="right__inputWrapper">
                        <label for="title" >Tiêu đề bài viết</label>
                        <input type="text" placeholder="Tiêu đề" name="title">
                    </div>
                    <div class="right__inputWrapper">
                        <label>Image</label>
                    </div>
                    <div class="center">
                        <div class="preview">
                            <img  src="{{asset('img//images.png')}}" style="background: rgb(180, 180, 180)"
                            id="file-ip-2-preview" width="320px" height="200px" style="margin-bottom: 10px"/>
                           </div>
                        <div style="margin-top: 10px" class="form-input">
                            <label  class="custom-label" for="file-ip-2">Upload Image</label>
                            <input name="post_image"  type="file" id="file-ip-2" accept="image/*"
                            onchange="showPreview(event, 'file-ip-2-preview');">
                        </div>
                    </div>

                    <button  style="margin-top:15px" class="btn" type="submit">Thêm</button>
                </form>
            </div>
        </div>
    </div>
@endsection
