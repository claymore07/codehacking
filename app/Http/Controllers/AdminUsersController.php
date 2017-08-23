<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Photo;
use App\Role;
use App\User;
use File;
use Illuminate\Http\Request;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $userImagePath = 'images/users';
    public function index()
    {
        //
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles =Role::pluck('name', 'id')->all();

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \app\Http\Requests\CreateUserRequest
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        //
        $input = $request->all();
        if ($file = $request->file('file')) {

            $name = time() . $file->getClientOriginalName() ;
            $file->move($this->userImagePath, $name);

            $photo = Photo::create(['path'=>$name]);


            $input['photo_id']= $photo->id;
        }else{
            $input['photo_id']= 1;

        }

        $input['password'] = bcrypt($request->password);
        User::create($input);
        return redirect('/admin/users');

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
        return view('admin.users.show');
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
        $roles =Role::pluck('name', 'id')->all();
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \app\Http\Requests\CreateUserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        //

        $user = User::findOrFail($id);

        $input = $request->all();
        $photo = Photo::findOrFail($user->photo->id);
        if($file = $request->file('file')){
            $name = time().$file->getClientOriginalName();
            $file->move($this->userImagePath,$name);


            File::delete(substr($photo->path,1)); // remove the / from the path
            $photo->update(['path'=>$name]);
        }
        $input =$request->all();
        if(trim($request->password)==''){

            //  $input = $request->except('password');
            $input['password']=$user->password;
        }else{

            $input['password']=bcrypt($request->passowrd);
        }

        $user->update($input);
        return redirect('/admin/users');
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
