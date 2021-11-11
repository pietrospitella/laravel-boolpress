<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;
use App\Category;
use App\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        $tags=Tag::all();

        return view('admin.posts.create', compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|max:255',
            'content'=>'required',
            'category_id'=>'nullable|exists:categories,id',
            'tags'=>'exists:tags,id'
        ]);

        $form_data = $request->all();
        $new_post = new Post;
        $new_post->fill($form_data);       

        $slug=Str::slug($new_post->title);
        $current_slug=Post::where('slug', $slug)->first();

        $counter=1;
        while($current_slug){
            $slug= $slug.'-'.$counter;
            $current_slug=Post::where('slug', $slug)->first();
            $counter++;
        }

        $new_post->slug=$slug;
        $new_post->save();
        $new_post->tags()->attach($form_data['tags']);


        return redirect()->route('admin.posts.index')->with('status', 'The post has been saved correctly.');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::where('id', $id)->first();
        if (!$post){
            abort(404);
        }
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if (!$post){
            abort(404);
        }

        $categories=Category::all();
        $tags=Tag::all();

        return view('admin.posts.edit', compact('post','categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title'=>'required|max:255',
            'content'=>'required',
            'category_id'=>'nullable|exists:categories,id',
            'tags'=>'exists:tags,id'
        ]);

        $form_data = $request->all();
        if ($form_data['title'] != $post->title){

            $slug=Str::slug($form_data['title'], '-');
            $current_slug=Post::where('slug', $slug)->first();
    
            $counter=1;
            while($current_slug){
                $slug= $slug.'-'.$counter;
                $current_slug=Post::where('slug', $slug)->first();
                $counter++;
            }

            $form_data['slug']=$slug;
        }

        $post->update($form_data);

        if(array_key_exists('tags',$form_data)){
            $post->tags()->sync($form_data['tags']);
        }
        else{
            $post->tags()->sync([]);
        }

        return redirect()->route('admin.posts.index')->with('status', 'Post updated correctly.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->tags()->detach($post->id);
        $post->delete();
        return redirect()->route('admin.posts.index')->with('status', 'The post has been deleted.');
    }
}
