<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\PostCresteRequest;
use App\Photo;
use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::all();
        return view('admin.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories=Category::lists('name','id')->all();
        return view('admin.posts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCresteRequest $request)
    {
        $user=Auth::user();
        $input= $request->all();
        $post=$user->posts()->create($input);
        if ( $file=$request->file('photo_id')) {
            $name = time().$file->getClientOriginalName();
            $file->move('images', $name);
            Photo::create(['file' => $name, 'user_id'=>$user->id , 'post_id'=>$post->id ,'is_profile'=>0]);

        }
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
    {   $categories=Category::lists('name','id')->all();
        $post= Post::find($id);
        return view('admin.posts.edit' ,compact(['post','categories']));
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

        $input = $request->all();
        $user=Auth::user();
        $user->posts()->whereId($id)->first()->update($input);
        if ( $file=$request->file('photo_id')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);
            Photo::create(['file' => $name ,'user_id'=>$user->id ,'post_id'=>$id ,'is_profile'=>0]);
        }

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
        $post=Post::find($id);
        if ($photos=$post->photo){
            foreach ($photos as $photo) {
                unlink(public_path(). $photo->file);
                $photo->delete();
            }

        }
        $post->delete();
        return redirect('admin/posts');
    }
}
