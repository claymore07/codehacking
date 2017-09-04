<?php

namespace App\Http\Controllers;

use App\Comment;
use App\CommentReply;
use Auth;
use Illuminate\Http\Request;
use Session;

class CommentRepliesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $replies = CommentReply::all();

        return view('admin.comments.replies.index', compact('replies'));
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
    }

    public function createReply(Request $request){

        $user= Auth::user();
      //  return $request->all();
        $data = [
            'user_id'=>$user->id,
            'comment_id'=>$request->comment_id,
            'post_id'=>$request->post_id,
            'body'=>$request->body,
        ];

        CommentReply::create($data);
        Session::flash('reply_result','پاسخ شما به نظر با موفقیت ثبت شد و پس از تایید نمایش داده خواهد شد. با تشکر');
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // this function gets the id of comment and displays the related replies!
    public function show($id)
    {
        //
        $comment= Comment::findOrFail($id);
        $replies = $comment->replies;
        return view('admin.comments.replies.show', compact('replies','comment'));
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
        $reply = CommentReply::findOrFail($id);
        $reply->update(['is_active'=>$request->is_active]);
        Session::flash('o_reply_approval', 'وضعیت نمایش پاسخ با موفقیت ویرایش شد!');
        return redirect()->back();
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
        $reply =CommentReply::findOrFail($id);

        $reply->delete();
        Session::flash('o_reply_deleted', 'پاسخ مورد نظر با موفقیت حذف شد!');
        return redirect('/admin/comment/replies');
    }



}
