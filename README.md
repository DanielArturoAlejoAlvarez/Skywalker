# SKYWALKER
## Description

This repository is a Application software with PHP7, Laravel and MYSQL, this application contains a simple Blog.

## Installation
Using PHP7 and laravel 5.5 preferably.

## Usage
```html
$ git clone https://github.com/DanielArturoAlejoAlvarez/Skywalker.git [NAME APP] 
```
Follow the following steps and you're good to go! Important:


![alt text](https://mattstauffer.com/assets/images/content/st-click-to-definition.gif)


## Coding

### Urls

```php
...
Route::get('/', function () {
    return redirect()->route('blog');
});


Auth::routes();

//CLIENT
Route::get('blog','Web\PageController@blog')->name('blog');
Route::get('blog/{slug}','Web\PageController@post')->name('post');
Route::get('blog/category/{slug}','Web\PageController@category')->name('category');
Route::get('blog/tag/{slug}','Web\PageController@tag')->name('tag');

//ADMIN
Route::resource('tags','Admin\TagController');
Route::resource('categories','Admin\CategoryController');
Route::resource('posts','Admin\PostController');
...

```

### Controllers


```php

...
 public function tag($slug){
        $posts = Post::whereHas('tags', function($query) use($slug){ 
            $query->where('slug',$slug);
        })->orderBy('id','DESC')
        ->where('status','PUBLISHED')
        ->paginate(3);
        return view('web.posts',compact('posts'));
    }
...

```


### Views

```php
...
<div class="col-md-8 col-md-offset-2">
            <h1>{{ $post->name }}</h1>
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    Category:
                    <a href="{{ route('category',$post->category->slug) }}">{{ $post->category->name }}</a>
                </div>
                <div class="panel-body">
                    @if($post->file)
                    <img src="{{ $post->file }}" class="img-responsive">
                    @endif
                    {{ $post->excerpt }}
                    <hr>
                    {!! $post->body !!}
                    <hr>
                    Tags: 
                    @foreach($post->tags as $tag)
                    <a href="{{ route('tag',$tag->slug) }}">{{ $tag->name }}</a>
                    @endforeach
                </div>
            </div>

            
        </div>
...
```

### Model

```php
...
class Post extends Model
{
    protected $fillable=[
        'user_id','category_id','name','slug','excerpt','body','status','file'
    ];

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
...
```

### Requests
```php
...
 public function rules()
    {
        $rules = [
            'name'=>'required',
            'slug'=>'required|unique:posts,slug',  
            'user_id'=>'required|integer',
            'category_id'=>'required|integer', 
            'tags'=>'required|array',
            'body'=>'required',
            'status'=>'required|in:DRAFT,PUBLISHED',
        ];

        if($this->get('file'))
            $rules = array_merge($rules, ['file'=>'mines:jpg,jpeg,png']);

        return $rules;
    }
...
```

### Factory

```php
...
$factory->define(Skywalker\Post::class, function (Faker $faker) {
    $title=$faker->sentence(4);
    return [
        'user_id'=>rand(1,30),
        'category_id'=>rand(1,20),
        'name'=>$title,
        'slug'=>str_slug($title),
        'excerpt'=>$faker->text(200),
        'body'=>$faker->text(500),
        'file'=>$faker->imageUrl($width=1200,$height=400),
        'status'=>$faker->randomElement(['DRAFT','PUBLISHED']),
    ];
});
...
```
### Seed

```php
...
public function run()
    {
        factory(Skywalker\Post::class,300)->create()->each(function(Skywalker\Post $post){
            $post->tags()->attach([
                rand(1,5),
                rand(6,14),
                rand(15,20),
            ]);
        });
    }
...
```

## Contributing

Bug reports and pull requests are welcome on GitHub at https://github.com/DanielArturoAlejoAlvarez/Skywalker. This project is intended to be a safe, welcoming space for collaboration, and contributors are expected to adhere to the [Contributor Covenant](http://contributor-covenant.org) code of conduct.


## License

The gem is available as open source under the terms of the [MIT License](http://opensource.org/licenses/MIT).