<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .body
        {
            display: flex;
            justify-content: center;
            align-content: center;
        }

        .post_design {
            padding: 30px;
            text-align: justify;
            width: 20%;
            margin: 40px;
            display: inline-block;
        }

        .title_design {
            font-size: 20px;
            font-weight: bold;
            color: black;
            width: 100%;
        }

        .description_design {
            font-size: 18px;
            color: black;
        }
    </style>
    <!-- basic -->
    @include('home.homecss')
</head>

<body>
    @include('sweetalert::alert')
    <!-- header section start -->
    <div class="header_section">
        @include('home.header')
        <!-- header section end -->
</div>
<div class="">
    @if(count($datas) > 0)
        @foreach ($datas as $data)
            <div class="post_design">
                <div style="width: 350px; height: 150px; object-fit:contain; overflow: hidden;"><img
                        src="postimage/{{ $data->image }}" class="services_img"></div>
                <h4 class="title_design"><b> {{ Str::words($data->title, 5) }}</b></h4>
                <h4 class="description_design">{{ Str::words($data->description, 10) }}</h4>
                <p>Post by <b>{{ $data->name }}</b></p>
                <p>Status <b><b>{{ Str::upper($data->post_status) }}</b></b></p>
                <div class="btn_main"><a href="{{ url('post_details', $data->slug)}}">Read more</a></div>
                
                <div class="btn btn-danger"><a onclick="return confirm('Are you sure to delete this?')" href="{{ url('mypost_delete', $data->id)}}">Delete</a></div>

                <div class="btn btn-primary"><a href="{{ url('mypost_edit', $data->slug)}}">Edit</a></div>
            </div>
        @endforeach
    @else
    <div class="post_design">
    <div class="alert alert-info">You have not posted anything</div>
    </div>
    @endif
    
</div>
    <!-- footer section start -->
    @include('home.footer')
