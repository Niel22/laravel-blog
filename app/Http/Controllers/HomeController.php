<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::id()) {
            $user_type = Auth()->user()->user_type;

            $posts = Post::all()->where('post_status', 'active');

            if ($user_type == 'user') {
                return view("home.homepage", compact("posts"));
            } else if ($user_type == "admin") {
                return view("admin.adminhome", compact("posts"));
            } else {
                return redirect()->back();
            }
        }
    }

    public function homepage()
    {
        $posts = Post::all()->where('post_status', 'active');

        return view("home.homepage", compact("posts"));
    }

    public function post_details($slug)
    {
        $post = Post::where('slug', $slug && 'post_status', 'active')->firstOrFail();

        if ($post) {
            return view('home.post_details', compact('post'));
        }

        abort(404);
    }

    public function create_post()
    {
        return view('home.create_post');
    }

    public function user_post(Request $request)
    {
        if ($request->isMethod('post')) {

            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'image' => 'required',
            ]);

            $post = new Post;

            $post->title = $request->title;

            $post->slug = Str::of($request->title)->slug('-');
            
            $post->description = $request->description;

            $post->post_status = 'pending';
    
            $post->name = $request->user()->name;
    
            $post->user_id = $request->user()->id;
    
            $post->user_type = $request->user()->user_type;


            if ($request->image) {
                $imageName = time() . '' . $request->image->getClientOriginalExtension();

                $request->image->move('postimage', $imageName);

                $post->image = $imageName;
            }

            $post->save();

            Alert::success('Congrats', 'You have added a post Successfully');

            return redirect()->back();

        }


    }

    public function my_post()
    {
        $userId = Auth::user()->id;

        $datas = Post::where('user_id', $userId)->get();
        
        return view('home.my_post', compact('datas'));
    }

    public function mypost_delete($id)
    {
        $post = Post::find($id);

        $post->delete();
        Alert::info('Deleted', 'Post deleted successfully');

        return redirect()->back();
    }

    public function mypost_edit($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        return view('home.mypost_edit', compact('post'));
    }

    public function mypost_update($id, Request $request)
    {
        $data = Post::find($id);

            $request->validate([
                'title'=> 'required',
                'description'=> 'required',
            ]);

            $data->title = $request->title;

        $data->slug = Str::of($request->title)->slug('-');

        $data->description = $request->description;

        if($request->image){
            $image = $request->image;

            $imagename = time().'.'.$image->getClientOriginalExtension();
   
           $request->image->move('postimage', $imagename);
   
           $data->image = $imagename;
        }

        $data->save();

        Alert::success('Post Updates', 'Your post has been Updated successfully');

        return redirect()->route('my_post');

    }
}
