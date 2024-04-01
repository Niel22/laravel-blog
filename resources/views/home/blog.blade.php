
<div class="services_section layout_padding">
    <div class="container">
       <h1 class="services_taital">Blog Post </h1>
       <p class="services_text">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration</p>
       <div class="services_section_2">
          <div class="row">
            
            @if(count($posts) > 0)
             @foreach($posts as $post)
             <div class="col-md-4">
                <div style="width: 350px; height: 250px; object-fit:contain; overflow: hidden;"><img src="postimage/{{ $post->image}}" class="services_img"></div>
                <h4><b> {{ Str::words($post->title, 100)}}</b></h4>
                <p>Post by <b>{{ $post->name}}</b></p>
                <div class="btn_main"><a href="{{ url('post_details', $post->slug)}}">Read more</a></div>
             </div>
             @endforeach
             @else
             <div class="col-md-4">
               <div class="alert alert-info">No Post available</div>
             </div>
             @endif
          </div>
       </div>
    </div>
 </div>