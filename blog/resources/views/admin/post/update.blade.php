@extends('layouts.admin')
@section('title',)

@section('content')

    <div class="right">
        <div class="right__content">
            <div class="right__title">Bảng điều khiển</div>
            <p class="right__desc">Sửa thể loại</p>
            <div class="right__formWrapper">
{{--
                @if ($errors)
                    @foreach ($errors->all() as $error)
                        <p class="text-danger">{{$error}}</p>
                    @endforeach
                @endif

                @if (Session::has('message'))
                    <p class="text-success">{{session('message')}}</p>
                @endif --}}

                <form action="{{url('admin/post/'.$post_Edit->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="right__inputWrapper">
                            {{-- ID của post_category --}}
                            <input type="hidden" name="post_cat_id" value="{{$Post_cat_Edit->id}}">
                            <label for="category" >Thể loại</label>
                            <select class="form-check-label" name="category">
                                @foreach ($cat as $item)
                                    <option selected="selected" value="{{$item->id}}">{{$item->title}}</option>
                                @endforeach
                                {{--Category Id cũ của post --}}
                                <input type="hidden" value="{{$Post_cat_Edit->cat_id}}">
                            </select>
                        </div>

                        <div class="right__inputWrapper">
                            <label for="title" >Tiêu đề bài viết</label>
                            <input type="text" placeholder="Tiêu đề" name="title" value="{{$post_Edit->post_title}}">
                        </div>

                        <div class="center">
                            <div class="preview">
                                <img id="file-ip-1-preview"
                                src="{{asset('img')}}/{{($post_Edit->image)}}"
                                width="320px" height="200px" style="padding-top: 5px"/>
                               </div>
                            <div style="margin-top: 10px" class="form-input">
                                <label class="custom-label" for="file-ip-1">Upload Image</label>
                                <input name="post_image"  type="file" id="file-ip-1" accept="image/*"
                                onchange="showPreview(event, 'file-ip-1-preview');">
                                <input type="hidden" value="{{($post_Edit->image)}}" name="post_image">
                            </div>
                        </div>
                        <button style="margin-top: 15px;" class="btn" type="submit">Sửa</button>
                </form>
            </div>
        </div>
    </div>
@endsection
