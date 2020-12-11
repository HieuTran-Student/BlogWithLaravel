@extends('layouts.admin')
@section('title', $title)


@section('content')

    <div class="right">
        <div class="right__content">
            <div class="right__title">Bảng điều khiển</div>
            <p class="right__desc">Thêm thể loại</p>
            <div class="right__formWrapper">

                @if ($errors)
                    @foreach ($errors->all() as $error)
                        <p class="text-danger">{{$error}}</p>
                    @endforeach
                @endif

                @if (Session::has('message'))
                    <p class="text-success">{{session('message')}}</p>
                @endif

            <form action="{{url('admin/category')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="right__inputWrapper">
                        <label for="title" >Tên thể loại</label>
                        <input type="text" placeholder="Tiêu đề" name="title">
                    </div>
                    <div class="right__inputWrapper">
                        <label for="desc">Mô tả</label>
                        <textarea name="detail" id="" cols="30" rows="10" placeholder="Mô tả"></textarea>
                    </div>
                    <div class="center">
                        <div class="preview">
                            <img src="{{asset('img//images.png')}}" style="background: rgb(180, 180, 180)"
                             id="file-ip-1-preview" width="320px" height="200px" style="padding-top: 5px"/>
                           </div>

                        <div style="margin-top: 10px" class="form-input">
                            <label class="custom-label" for="file-ip-1">Upload Image</label>
                            <input name="cat_image"  type="file" id="file-ip-1" accept="image/*"
                            onchange="showPreview(event, 'file-ip-1-preview');">
                        </div>
                    </div>

                    <button  style="margin-top:15px" class="btn" type="submit">Thêm</button>
                </form>
            </div>
        </div>
    </div>
@endsection
