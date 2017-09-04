<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Auth;
use Illuminate\Http\Request;
use Session;

class PostsCommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $comments = Comment::all();
        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $user= Auth::user();

        $data = [
            'user_id'=>$user->id,
            'post_id'=>$request->post_id,
            'body'=>$request->body,
        ];

        Comment::create($data);
        Session::flash('comment_result','پیام با موفقیت ثبت شد و پس از تایید نمایش داده خواهد شد. با تشکر');
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //  displays comments for specfic post that its id provided
    // this function gets the id of post and displays the related comments!
    public function show($id)
    {
        //
         $post= Post::findOrFail($id);
        $comments = $post->comments;
        return view('admin.comments.show', compact('comments','post'));
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
        return 'fuck1';
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
        $comment = Comment::findOrFail($id);
        $comment->update(['is_active'=>$request->is_active]);
        Session::flash('o_comment_approval', 'وضعیت نمایش نظر با موفقیت ویرایش شد!');
        return redirect('/admin/comments');
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
        $comment =Comment::findOrFail($id);
        $comment->delete();
        Session::flash('o_comment_deleted', 'پاسخ مورد نظر با موفقیت حذف شد!');
        return redirect('/admin/comments');
    }
}
