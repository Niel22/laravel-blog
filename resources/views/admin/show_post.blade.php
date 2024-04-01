<!DOCTYPE html>
<html>
  <head> 

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @include("admin.css")
    <style>
        .title_design
        {
            font-size: 30px;
            font-weight: bold;
            color: white;
            padding: 30px;
            text-align: center;
        }

        .table_design
        {
            border: 1px solid white;
            width: 95%;
            text-align: center;
            margin: 20px
        }

        .th_design
        {
            background-color: skyblue;
        }
    </style>
  </head>
  <body>
    @include('sweetalert::alert')
    @include('admin.header')
    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      @include('admin.sidebar')
      <!-- Sidebar Navigation end-->
      <div class="page-content">

        @if(session()->has('message'))

        @if(session()->get('message') == "Post Deleted Successfully")
        <div class="alert alert-danger">
            <button class="close" type="button" data-dismiss="alert" aria-hidden="true">X</button>

            {{session()->get('message')}}
        
          </div>
        @elseif(session()->get('message') == "Post Updated Successfully")

        <div class="alert alert-success">
          <button class="close" type="button" data-dismiss="alert" aria-hidden="true">X</button>

          {{session()->get('message')}}
      
        </div>
        @endif
        @endif

        <h1 class="title_design">All Post</h1>

        <table class="table_design">
            <tr class="th_design">
                <th>Post Title</th>
                <th>Description</th>
                <th>Post by</th>
                <th>Post Status</th>
                <th>User Type</th>
                <th>Image</th>
                <th>Delete</th>
                <th>Edit</th>
                <th>Accept</th>
            </tr>
            @if(count($posts) > 0)
            @foreach($posts as $post)
            <tr style="text-align: left">
                <td>{{ Str::words($post->title, 5)}}</td>
                <td>{{ Str::words($post->description, 10)}}</td>
                <td>{{ $post->name}}</td>
                <td>{{ $post->post_status}}</td>
                <td>{{ $post->user_type}}</td>
                <td><img src="postimage/{{ $post->image}}" alt="{{ $post->title}}" width="70px" style="margin: auto;"></td>
                <td><a href="{{ url('delete_post', $post->id)}}" class="btn btn-danger" onclick="confirmation(event)">Delete</a></td>
                <td><a href="{{ url('edit_post', $post->id)}}" class="btn btn-success">Edit</a></td>
                <td>
                  @if($post->post_status == 'pending')
                  <a href="{{ url('accept_post', $post->id)}}" class="btn btn-success">Accept</a>
                  @else
                  <a href="{{ url('pend_post', $post->id)}}" class="btn btn-warning">Pend</a>
                  @endif
                </td>
            </tr>
            @endforeach
            @else
            <tr>
              <td colspan="6">No Post Available</td>
            </tr>
            @endif
        </table>
      </div>
      


    <!-- JavaScript files-->
   @include('admin.footer')

   <script>
    function confirmation(ev)
    {
      ev.preventDefault();

      var urlToRedirect = ev.currentTarget.getAttribute('href');

      console.log(urlToRedirect);
      
      swal({
        title: "Are you sure to delete this ",
        text: "You wont be able to revert this delete.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })

      .then((willCancel)=>{

        if(willCancel)
        {
          window.location.href = urlToRedirect;
        }
      })
    }
   </script>