<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostResquest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Photo;
use App\Role;
use App\User;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $userImagePath = 'images/users';
    protected $defaultImage = 'user-defualt.png';
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
        $input['password'] = bcrypt($request->password);
        $user = User::create($input);
        if ($file = $request->file('file')) {

            $name = time() . $file->getClientOriginalName() ;
            $file->move($this->userImagePath, $name);

            $user->photos()->create(['path'=>$name]);



        }else{
            $user->phtos()->create(['path'=>$this->defaultImage]);

        }


        Session::flash('o_user_created', 'ایجاد کاربر با موفقیت انجام شد!');
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
     * @param  CreatePostResquest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        //

        $user = User::findOrFail($id);

        $input = $request->all();
        $photo = $user->photos()->first();

        if($file = $request->file('file')){
            $name = time().$file->getClientOriginalName();
            $file->move($this->userImagePath,$name);


            File::delete(substr($photo->path,1)); // remove the / from the path
            $photo->update(['path'=>$name]);
        }



        if ($request->has('password')) {
            $user->update($input);
            $user->password = bcrypt($request->input('password'));
            $user->save();
        }else{
            $input['password']=$user->password;
            $user->update($input);
        }


        Session::flash('o_user_updated', 'ویرایش کاربر با موفقیت انجام شد!');
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

        $user = User::findOrFail($id);

        /**** one way to remove user image file  **/
       // File::delete(substr($user->photo->path,1)); // remove the / from the pat

        /**** ohter way to remove user image file  **/

        unlink(public_path().$user->photos()->first()->path);
        $user->photos()->first()->delete();

        $user->delete();


        Session::flash('o_user_deleted', 'حذف کاربر با موفقیت انجام شد!');


        return redirect('/admin/users');
    }
}
