<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    //
    public function show(Post $post){
        
        return view('blog-post', ['post' => $post]);//or i can use with($post)
    }

    public function create(){
        return view('admin.posts.create');
    }

    public function store(){
        $post = request()->validate([
            'title' => 'required|min:8|max:255',
            'post_image' => 'file',//mimes:jpeg,png this will restrict the file to be those extensions
            'body'  => 'required'
        ]);//saved data in $post array
        
        if(request('post_image')){
            $post['post_image'] = request('post_image')->store('images');//'image' is creating directory if we dont have one
        }

        auth()->user()->posts()->create($post);

        Session::flash('post-created-message', 'Post was created');//flash message

       // return back();//returns no the same page
       return redirect()->route('post.index');

    // dd(request()->all());

    }

    public function index(){
        $posts = auth()->user()->posts()->paginate(3);//this will divide the records into 5 sets
        return view('admin.posts.index', ['posts' => $posts]);
    }

    public function destroy(Post $post){//i dont have to do Post::all or something because i am getting the post from the request
        $this->authorize('delete', $post);
        $post->delete();
        Session::flash('message', 'Post was deleted');//flash message

        return back();//returns to same page
    }

    public function edit(Post $post){

        $this->authorize('view', $post);
        
        return view('admin.posts.edit', ['post' => $post]);
    }

    public function update(Post $post){
        //i will check if the fields are valid
        $inputs = request()->validate([
            'title' => 'required|min:8|max:255',
            'post_image' => 'file',//mimes:jpeg,png this will restrict the file to be those extensions
            'body'  => 'required'
        ]);


        if(request('post_image')){//checking if image is valid
            $inputs['post_image'] = request('post_image')->store('images');//'image' is creating directory if we dont have one
            $post->post_image = $inputs['post_image'];
        }

        $post->title = $inputs['title'];
        $post->body = $inputs['body'];

        $this->authorize('update', $post);//using the update method in policy

        $post->save();//here i will not use user()->post() because i don't want the owner to be changed to the logged in user
        
        Session::flash('post-updated-message', 'Post was updated');

        return redirect()->route('post.index');

    }
}
