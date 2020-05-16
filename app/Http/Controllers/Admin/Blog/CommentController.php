<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravelista\Comments\Comment;
use App\Model\user\blog\post;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::all();
        return view('admin/blog/comment/comment', compact('comments'));

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

    public function status($id,$status){
        $comment = Comment::find($id);
        $comment -> approved = $status;
        $comment ->save();
        return redirect()->route('comment.index');
    }

    public static function totalPendingComment(){
        $totalPendingComment = Comment::all()->where('approved','=',0)->count();
        return $totalPendingComment;
    }
    
    public static function commentedBy($id){
        $commentedBy = Comment::all()->where('id', $id)->first();
        return $commentedBy->commenter->email;
    }
    
    public static function commentedPost($id){
        $commentedPost = Comment::where('id', $id)->first();
        $postTitle = post::all()->where('id', $commentedPost->commentable_id)->first();
        return $postTitle->title;
    }
    
}
