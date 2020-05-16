<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Model\admin\admin;
use Illuminate\Http\Request;
use App\Model\user\blog\post;
use App\Model\user\blog\category;
use App\Model\user\blog\tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Laravelista\Comments\Comment;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = post::all();
        return view('admin/blog/post/post', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = category::all();
        $tags = tag::all();

        return view('admin/blog/post/new-post', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required',
            'slug' => 'required',
            'body' => 'required',
            'excerpt' => 'required',
            'thumbnail' => 'required'
        ]);

        if ($request->action == 'publish') {
            $btn = 'publish';
        } else {
            $btn = 'draft';
        }

        if($request->hasFile('thumbnail'))
        {
            $thumbnail = $request -> thumbnail -> store('public');
        }

        $post = new post;
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->body = $request->body;
        $post->excerpt = $request->excerpt;
        $post->image = $thumbnail;
        $post->posted_by = Auth::id();
        $post->status = $btn;
        $post->save();
        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);

        return redirect(route('post.index'))->with('success', 'Post created successfully!');
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
        $categories = category::all();
        $tags = tag::all();

        $post = post::with('categories','tags')->where('id', $id)->first();

        return view('admin/blog/post/edit', compact('post', 'categories', 'tags'));
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
        $this->validate($request, [
            'title' => 'required',
            'slug' => 'required',
            'body' => 'required',
            'excerpt' => 'required',
        ]);

        if ($request->action == 'publish') {
            $btn = 'publish';
        } else {
            $btn = 'draft';
        }

        if($request->hasFile('thumbnail'))
        {
            $thumbnail = $request -> thumbnail -> store('public');
        }else{
            $post = post::find($id);
            $thumbnail = $post->image;
        }

        $post = post::find($id);

        Storage::delete($post->image);

        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->body = $request->body;
        $post->excerpt = $request->excerpt;
        $post->image = $thumbnail;
        $post->posted_by = Auth::id();
        $post->status = $btn;
        $post->save();
        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);

        return redirect(route('post.index'))->with('success', 'Post updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = post::where('id', $id)->delete();
        Storage::delete($post->image);
        return redirect()->back()->with('success', 'Post deleted successfully!');
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            //get filename with extension
            $filenamewithextension = $request->file('upload')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('upload')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename . '_' . time() . '.' . $extension;

            //Upload File
            $request->file('upload')->storeAs('public/images', $filenametostore);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('storage/images/' . $filenametostore);
            $msg = 'Image successfully uploaded';
            $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            // Render HTML output 
            @header('Content-type: text/html; charset=utf-8');
            echo $re;
        }
    }

    public static function commentCount($id){
        $commentCount = Comment::where('commentable_id',$id)->count();
        return $commentCount;
    }

    public static function aprrovedCommentCount($id){
        $aprrovedCommentCount = Comment::where(['commentable_id' => $id, 'approved' => '1'])->count();
        return $aprrovedCommentCount;
    }

    public static function pendingCommentCount($id){
        $pendingCommentCount = Comment::where(['commentable_id' => $id, 'approved' => '0'])->count();
        return $pendingCommentCount;
    }

    public static function author($id){
        $author = admin::where('id', $id)->value('name');
        return $author;
    }
}
