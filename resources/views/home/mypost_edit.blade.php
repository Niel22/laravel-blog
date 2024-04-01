<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
    <style>
        .div_design
        {
            text-align: center;
            padding: 30px;
        }

        .title_design
        {
            font-size: 30px;
            font-weight: bold;
            color: white;
        }

        label
        {
            display: inline-block;
            width: 200px;
            color: white;
            font-size: 15px;
            font-weight: bold;
        }
        .field_design
        {
            padding: 25px;
        }
    </style>
    <!-- basic -->
    @include('home.homecss')
</head>

<body>
    
    <!-- header section start -->
    <div class="header_section">
        @include('home.header')
        <!-- header section end -->
    <div class="div_design">

        <h1 class="title_design">Edit Post</h1>

        <form action="{{ url('mypost_update', $post->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="field_design">
                <label>Title</label>
                <input value="{{ $post->title}}" type="text" name="title">
            </div>

            <div class="field_design">
                <label>Description</label>
                <textarea name="description">{{ $post->description}}</textarea>
            </div>

            <div class="field_design">
                <label>Old images</label>
                <img src="postimage/{{$post->image}}" style="margin: auto;" width="100px" alt="">
            </div>

            <div class="field_design">
                <label>Add images</label>
                <input value="{{ $post->image}}" type="file" name="image">
            </div>

            <div>
                <input type="submit" value="Update post" class="btn btn-outline-secondary">
            </div>
        </form>
    </div>
    <!-- footer section start -->
    @include('home.footer')
</div>
