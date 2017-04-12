<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserEditRequest;
use App\Http\Requests\UserRequest;
use App\Photo;
use App\Role;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users =User::all();

        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles=Role::lists('name','id')->all();
        return view('admin.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $input=$request->all();
        $input['password']=bcrypt($request->password);
        unset($input['photo_id']);
        $user=User::create($input);

       if($file=$request->file('photo_id')){
            $name=time().$file->getClientOriginalName();
            $file->move('images',$name);
            Photo::create(['file'=>$name, 'user_id'=>$user->id ,'post_id'=>0,'is_profile'=>1]);
       }



        return redirect('admin/users');

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
        $user = User::find($id);
        $roles =Role::lists('name','id')->all();
        return view('admin.users.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, $id)
    {
        //
        $user = User::find($id);


        if (trim($request->password)==''){
            $input=$request->except('password');
        }else{
            $input = $request->all();
        }

        if ($file =$request->file('photo_id')) {

            $name=time().$file->getClientOriginalName();
            $file->move('images',$name);
            Photo::create(['file'=>$name, 'user_id'=>$user->id ,'post_id'=>0,'is_profile'=>1]);
        }
        $user->update($input);
        $user->save();
        return redirect('admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user= User::find($id);

        if ($photos=$user->photo){
            foreach ($photos as $photo) {
                unlink(public_path(). $photo->file);
                $photo->delete();
            }

        }
        $user->delete();
        Session::flash('delete_user',$user->name ." has been deleted.");
        return redirect('admin/users');

    }
}
