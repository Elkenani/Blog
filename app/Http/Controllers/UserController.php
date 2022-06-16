<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function show(User $user){
        return view('admin.users.profile', [
            'user' => $user,
            'roles'=> Role::all()
            ]);
    }
    
    public function update(User $user){

        $input = request()->validate([
            'username' => ['required', 'string', 'max:255', 'alpha_dash'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'avatar' => ['file'],//i can say file:jpeg,png
            //'password' => ['min:6', 'max:255', 'confirmed']//confirmed is for pass and pass confirmation
        ]);

        if(request('avatar')){
           $input['avatar'] = request('avatar')->store('images');
        }

        $user->update($input);

        return back();
    }

    public function index(){
        $users = User::all();
        return view('admin.users.index', ['users'=>$users]);
    }

    public function Destroy(User $user){
        $user->delete();
        session()->flash('user-deleted', 'user has been deleted');
        return back();
    }

    public function attach(User $user){
        $user->roles()->attach(request('role'));
        return back();
    }

    public function detach(User $user){
        $user->roles()->detach(request('role'));
        return back();
    }
}
