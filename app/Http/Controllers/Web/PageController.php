<?php

namespace Skywalker\Http\Controllers\Web;

use Illuminate\Http\Request;
use Skywalker\Http\Controllers\Controller;
//my uses
use Skywalker\Post;
use Skywalker\Category;

class PageController extends Controller
{
    public function blog()
    {
        $posts = Post::orderBy('id', 'DESC')
                    ->where('status', 'PUBLISHED')
                    ->paginate(3);
        return view('web.posts', compact('posts'));
    }

    public function post($slug)
    {
        $post = Post::where('slug', $slug)
                    ->first();
        if(!$post){
            abort(404); 
        }
         
        return view('web.post', compact('post'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->pluck('id')->first();
        $posts = Post::where('category_id',$category)
                    ->orderBy('id','DESC')
                    ->where('status','PUBLISHED')
                    ->paginate(3);
        return view('web.posts',compact('posts'));
    }

    public function tag($slug){
        $posts = Post::whereHas('tags', function($query) use($slug){ 
            $query->where('slug',$slug);
        })->orderBy('id','DESC')
        ->where('status','PUBLISHED')
        ->paginate(3);
        return view('web.posts',compact('posts'));
    }
}
