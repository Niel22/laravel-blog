<!DOCTYPE html>
<html lang="en">
   <head>
    <base href="/public">
      <!-- basic -->
      @include('home.homecss')
   </head>
   <body>
      <!-- header section start -->
      <div class="header_section">
         @include('home.header')
         <!-- header section end -->
      </div>
      
      <div class="col-md-12" style="text-align: center">
        <img src="postimage/{{ $post->image}}" width="50%" style="padding: 20px; margin: auto;">
        <h3><b>{{ $post->title}}</b></h3>
        <h4 style="text-align: justify">{{ $post->description}}</h4>
        <p>Post by <b>{{ $post->name}}</b></p>

     </div>

      <!-- footer section start -->
      @include('home.footer')