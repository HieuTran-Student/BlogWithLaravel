@section('title', $title)
<!DOCTYPE html>
<html>

<head>
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <style>
        html,
        body {
         justify-content: 
            min-height: 100%;
        }


        body,
        div,
        form,
        input,
        select,
        textarea,
        p {
            padding: 0;
            margin: 0;
            outline: none;
            font-family: Roboto, Arial, sans-serif;
            font-size: 14px;
            color: #666;
            line-height: 22px;
        }

        h1 {
            position: absolute;
            margin: 0;
            font-size: 32px;
            color: #fff;
            z-index: 2;
        }

        .testbox {
            display: flex;
            justify-content: center;
            align-items: center;
            height: inherit;
            padding: 20px;
        }

        form {
            width: 100%;
            padding: 20px;
            border-radius: 6px;
            background: #fff;
            box-shadow: 0 0 30px 0 #8ebf42;
        }

        .banner {
            position: relative;
            height: 210px;
            background-image: url("/uploads/media/default/0001/01/a3df023f124a8bec3b213347404fe0a7318161de.jpeg");
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .banner::after {
            content: "";
            background-color: rgba(0, 0, 0, 0.5);
            position: absolute;
            width: 100%;
            height: 100%;
        }

        p.top-info {
            margin: 10px 0;
        }

        input,
        select,
        textarea {
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input {
            width: calc(100% - 10px);
            padding: 5px;
        }

        select {
            width: 100%;
            padding: 7px 0;
            background: transparent;
        }

        textarea {
            width: calc(100% - 12px);
            padding: 5px;
        }

        .item:hover p,
        .item:hover i,
        .question:hover p,
        .question label:hover,
        input:hover::placeholder {
            color: #8ebf42;
        }

        .item input:hover,
        .item select:hover,
        .item textarea:hover {
            border: 1px solid transparent;
            box-shadow: 0 0 8px 0 #8ebf42;
            color: #8ebf42;
        }

        .item {
            position: relative;
            margin: 10px 0;
        }

        input[type="date"]::-webkit-inner-spin-button {
            display: none;
        }

        .item i,
        input[type="date"]::-webkit-calendar-picker-indicator {
            position: absolute;
            font-size: 20px;
            color: #a9a9a9;
        }

        .item i {
            right: 2%;
            top: 30px;
            z-index: 1;
        }

        [type="date"]::-webkit-calendar-picker-indicator {
            right: 1%;
            z-index: 2;
            opacity: 0;
            cursor: pointer;
        }

        input[type=radio] {
            width: 0;
            visibility: hidden;
        }

        label.radio {
            position: relative;
            display: inline-block;
            margin: 5px 20px 25px 0;
            cursor: pointer;
        }

        .question span {
            margin-left: 30px;
        }

        label.radio:before {
            content: "";
            position: absolute;
            left: 0;
            width: 17px;
            height: 17px;
            border-radius: 50%;
            border: 2px solid #8ebf42;
        }

        label.radio:after {
            content: "";
            position: absolute;
            width: 8px;
            height: 4px;
            top: 6px;
            left: 5px;
            background: transparent;
            border: 3px solid #8ebf42;
            border-top: none;
            border-right: none;
            transform: rotate(-45deg);
            opacity: 0;
        }

        input[type=radio]:checked+label:after {
            opacity: 1;
        }

        .btn-block {
            margin-top: 10px;
            text-align: center;
        }

        button {
            width: 150px;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background: #8ebf42;
            font-size: 16px;
            color: #fff;
            cursor: pointer;
        }

        button:hover {
            background: #82b534;
        }

        @media (min-width: 568px) {

            .name-item,
            .city-item {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
            }

            .name-item input,
            .city-item input {
                width: calc(50% - 20px);
            }

            .city-item select {
                width: calc(50% - 8px);
            }
        }
    </style>
</head>

<body>
    <div class="testbox">
        <form action="{{url('admin/post/updateDescription')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="banner">
                <h1>Tạo Nội Dung Cho Bài Viết</h1>
            </div>
            <div class="item">
                <div style="display: flex">
                    <p>Tiêu đề bài viết</p>
                    <p style="margin-left:44%">Thể loại</p>
                    <input type="hidden" name="post_id" value="{{$post->id}}">
                </div>
                <div class="name-item">
                    <input type="text" name="post_title" value="{{$post->post_title}}" disabled />
                    <input type="text" name="cat_title" value="{{$post->cat_title}}" disabled />
                </div>
            </div>
            <div class="item">
            <p style="text-align: center">Mô tả</p>
                <textarea rows="3" name="short_description">{{$post_short_desc->short_description}}</textarea>
            </div>
            <div class="item">
                <p style="text-align: center;">Nội dung chính</p>
                <textarea class="form-control" id="post_description" name="post_description">{{$post_desc->descriptions}}</textarea>
                <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
                <script>
                    CKEDITOR.replace('post_description');
                    CKEDITOR.config.height = '600px';
                </script>
            </div>
            {{-- <div class="question">
                <p>College</p>
                <div class="question-answer">
                    <input type="radio" value="none" id="radio_11" name="college" />
                    <label for="radio_11" class="radio"><span>Yes</span></label>
                    <input type="radio" value="none" id="radio_12" name="college" />
                    <label for="radio_12" class="radio"><span>No</span></label>
                </div> --}}
                <div style="width:100%; height:25px" ></div>
                <div style="display: flex; justify-content: center" >
                    <div class="btn-block" >
                    <button style="width: 500px; height: 75px; font-size: 20px; margin-left:70px"  type="submit">
                        <a  href="{{url('admin/post/postDescription/'.$post->id)}}" style=" text-align: center ;display: block ; width: 100%; height: 100%; ;color: #fff; text-decoration: none">
                        <img  src="{{asset('admin/dashboard_admin/images/cancel.png' )}}" width="60px" height="60px" >
                        </a>
                    </button>
                    </div>
                    <div class="btn-block" >
                        <button style="width: 500px; height: 75px; font-size: 20px; margin-left:70px"  type="submit">Sửa</button>
                        </div>
                </div>


        </form>
    </div>
</body>

</html>
