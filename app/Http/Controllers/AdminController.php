<?php

namespace App\Http\Controllers;

use Slug;

use App\Models\Post;



use Illuminate\Support\Str;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    public function post_page()
    {
        return view("admin.post_page");
    }

    public function add_post(Request $request)
    {

        if ($request->isMethod('post')) {

            $post = new Post;

            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'image' => 'required'
            ]);

            $post->title = $request->title;

            // $post->slug = strtolower(str_replace(' ', '-', $request->title));

            $post->slug = Str::of($request->title)->slug('-');


            $post->description = $request->description;

            $post->post_status = 'active';

            $post->name = $request->user()->name;

            $post->user_id = $request->user()->id;

            $post->user_type = $request->user()->user_type;

            //Collecting Image Code

            $image = $request->image;

            if ($image) {

                $imagename = time() . '.' . $image->getClientOriginalExtension();

                $request->image->move('postimage', $imagename);

                $post->image = $imagename;
            }

            $post->save();

            return redirect()->back()->with('message', 'Post Added Successfully');
        }

        abort(404);
    }

    public function show_post()
    {
        $posts = Post::all();
        return view('admin.show_post', compact('posts'));
    }

    public function delete_post($id)
    {
        $post = Post::find($id);

        $post->delete();

        return redirect()->back()->with('message', 'Post Deleted Successfully');
    }

    public function edit_post($id)
    {
        $post = Post::find($id);

        return view('admin.edit_page', compact('post'));
    }

    public function update_post($id, Request $request)
    {
        $data = Post::find($id);

        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $data->title = $request->title;

        $data->slug = strtolower(str_replace(' ', '-', $request->title));

        $data->description = $request->description;

        if ($request->image) {
            $image = $request->image;

            $imagename = time() . '.' . $image->getClientOriginalExtension();

            $request->image->move('postimage', $imagename);

            $data->image = $imagename;
        }

        $data->save();

        return redirect('show_post')->with('message', 'Post Updated Successfully');
    }

    public function accept_post($id)
    {
        $post = Post::find($id);

        if ($post->post_status == 'active') {
            abort(401);
        }

        $post->post_status = 'active';

        $post->save();

        Alert::success('Approved', 'Post approved successfully');

        return redirect()->back();
    }

    public function pend_post($id)
    {
        $post = Post::find($id);

        if ($post->post_status == 'pending') {
            abort(401);
        }

        $post->post_status = 'pending';

        $post->save();

        Alert::success('Pended', 'Post has been returned to pending!');

        return redirect()->back();
    }
}
