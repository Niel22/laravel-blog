<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      @include('home.homecss')
   </head>
   <body>
      <!-- header section start -->
      <div class="header_section">
         @include('home.header')
         <!-- header section end -->
          <!-- banner section start -->
          @include('home.banner')
         <!-- banner section end -->
      </div>
      <!-- services section start -->
      @include('home.blog')
      <!-- services section end -->
      <!-- about section start -->
      @include('home.aboutus')
      <!-- about section end -->

      <!-- footer section start -->
      @include('home.footer')