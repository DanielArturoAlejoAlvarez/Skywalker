<?php

namespace Skywalker\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Skywalker\Http\Controllers\Controller;

//my uses
use Skywalker\Post;
use Skywalker\User;
use Skywalker\Category;
use Skywalker\Tag;
use Skywalker\Http\Requests\PostStoreRequest;
use Skywalker\Http\Requests\PostUpdateRequest;
//STORAGE
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id','DESC')
                ->where('user_id',auth()->user()->id)
                ->paginate();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::orderBy('name','ASC')->pluck('name','id');
        $categories = Category::orderBy('name','ASC')->pluck('name','id');
        $tags = Tag::orderBy('name','ASC')->get();
        return view('admin.posts.create',compact('users','categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostStoreRequest $request)
    {
        $post = Post::create($request->all());

        //Upload Images
        if($request->file('file')){
            $path = Storage::disk('public')->put('img', $request->file('file'));
            // img/posts/fdsfdsgefdgf.jpg
            $post->fill(['file'=>asset($path)])->save(); //asset totally route of image, with fill update and save
        }
        //Tags attachment
        $post->tags()->attach($request->get('tags'));

        return redirect()->route('posts.edit',$post->id)
                    ->with('info','Post created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        //POLICE AUTHORIZATION
        $this->authorize('pass',$post);
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        //POLICE AUTHORIZATION
        $this->authorize('pass',$post);

        $users = User::orderBy('name','ASC')->pluck('name','id');
        $categories = Category::orderBy('name','ASC')->pluck('name','id');
        $tags = Tag::orderBy('name','ASC')->get();
        
        return view('admin.posts.edit', compact('post','users','categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request, $id)
    {
        $post = Post::find($id);
        //POLICE AUTHORIZATION
        $this->authorize('pass',$post);
        $post->fill($request->all())->save();

        //Upload Images
        if($request->file('file')){
            $path = Storage::disk('public')->put('img', $request->file('file'));
            // img/posts/fdsfdsgefdgf.jpg
            $post->fill(['file'=>asset($path)])->save(); //asset totally route of image, with fill update and save
        }
        //Tags syncronized
        $post->tags()->sync($request->get('tags')); //sync = attach || dettach


        return redirect()->route('posts.edit',$post->id)
                    ->with('info','Post updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$post = Post::find($id)->delete($id);
        $post = Post::find($id);
        //POLICE AUTHORIZATION
        $this->authorize('pass',$post);
        $post->delete();
        return back()->with('info','Post ' .$post. ' deleted successfully!');
    }
}
