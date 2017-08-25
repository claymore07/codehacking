<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CreatePostResquest;
use App\Photo;
use App\Post;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminPostsController extends Controller
{
    protected $postImagePath = 'images/posts';
    protected $defaultImage = 'laravel-migration.jpg';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        //
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
        //
        $categories = Category::pluck('name', 'id')->all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostResquest $request)
    {
        //
        $user = Auth::user();
        $input = $request->all();
        $input['user_id']= $user->id;
        $post = Post::create($input);

        if($file = $request->file('file')){
            $name = time().$file->getClientOriginalName();
            $file->move($this->postImagePath, $name);
            $photo =$post->photos()->create(['path'=>$name]);

        }else{
            $photo =$post->photos()->create(['path'=>$this->defaultImage]);
        }

        Session::flash('o_post_created', 'مطلب جدید با موفقیت ذخیره شد.');
        return redirect('/admin/posts');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        return view('admin.posts.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
