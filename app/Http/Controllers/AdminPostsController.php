<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CreatePostResquest;
use App\Photo;
use App\Post;
use Auth;
use File;
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
        $post = Post::findOrFail($id);
        $categories = Category::all();
        $comments = $post->comments()->whereIsActive(1)->get();


        return view('post', compact('post', 'categories','comments'));
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
        $post = Post::findOrFail($id);
        $categories = Category::pluck('name', 'id')->all();

        return view('admin.posts.edit', compact('post','categories'));
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
        $user = Auth::user();
        $input = $request->all();

        //$input['user_id']= $user->id;
         $user->posts()->whereId($id)->first()->update($input);

        $post =$user->posts()->whereId($id)->first();

        if($file = $request->file('file')){
            $name = time().$file->getClientOriginalName();
            $file->move($this->postImagePath, $name);
            if($post->photos()->count() > 0) {
                if (File::exists(public_path() . $post->photos()->first()->path)) {
                    unlink(public_path() . $post->photos()->first()->path);
                }
                $photo =$post->photos()->update(['path'=>$name]);
            }else{
                $photo =$post->photos()->create(['path'=>$name]);
            }


        }

        Session::flash('o_post_updated', 'مطلب ویرایش با موفقیت ذخیره شد.');
        return redirect('/admin/posts');
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
        $post = Post::findOrFail($id);
        // unlink(public_path().$post->photos()->first()->path);
        /*$post->photos()->first()->delete();*/  // Know this action will be done on the post model delete function override
        $post->delete();

        Session::flash('o_post_deleted', 'حذف مطلب با موفقیت انجام شد!');
        return redirect('/admin/posts');
    }
}
