<!DOCTYPE html>
<html>
  <head> 

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @include("admin.css")
    <style>
        .post_title{
            font-size: 30px;
            font-weight: bold;
            text-align: center;
            padding: 30px;
            color: white;
        }

        .div_center{
            text-align: center;
            padding: 30px;
        }

        label
        {
            display: inline-block;
            width: 200px;

        }
    </style>
  </head>
  <body>
    @include('admin.header')
    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      @include('admin.sidebar')
      <!-- Sidebar Navigation end-->
      <div class="page-content">

        @if(session()->has('message'))

        <div class="alert alert-success">
            <button class="close" type="button" data-dismiss="alert" aria-hidden="true">X</button>

            {{session()->get('message')}}

        </div>
        @endif
        <h1 class="post_title">Add Post</h1>

        <div>
            <form action="{{ route('post.store')}}" method="post" onsubmit="confirmation(event)" enctype="multipart/form-data">
                @csrf

                <div class="div_center">

                    <label for="">Post Titile</label>

                    <input type="text" name="title">

                </div>

                <div class="div_center">

                    <label for="">Post Description</label>

                    <textarea name="description"></textarea>
                    
                </div>

                <div class="div_center">

                    <label for="">Add Image</label>

                    <input type="file" name="image">
                    
                </div>

                <div class="div_center">

                    <input type="submit"  class="btn btn-primary">
                    
                </div>
            </form>
        </div>
      </div>
    <!-- JavaScript files-->
   @include('admin.footer')

   <script>
    function confirmation(ev)
    {
      ev.preventDefault();

      var form = ev.target;
      var urlToRedirect = form.action;

      console.log(urlToRedirect);

      swal({
        title: "Are you sure to post this content",
        text: "You wont be able to revert this delete.",
        icon: "info",
        buttons: true,
        successMode: true,
      })

      .then((willCancel)=>{

        if(willCancel)
        {
          form.submit();
        }
      })
    }
   </script>