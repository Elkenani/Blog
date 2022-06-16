<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Role;

class RoleController extends Controller
{
    //
    public function index(){
        return view('admin.roles.index',[
            'roles' => Role::all()
        ]);
    }

    public function store(){
        request()->validate([
            'name' => ['required']
        ]);
        Role::create([
            'name' => Str::ucfirst(request('name')),
            'slug' => Str::of(Str::lower(request('name')))->slug('-'),//for and slug makes the separation between words as a dash
        ]);
        return back();
    }

    public function destroy(Role $role){
        $role->delete();
        session()->flash('role-deleted', 'Role was deleted : ' . $role->name);
        return back();
    }

    public function edit(Role $role){
        return view('admin.roles.edit', ['role' => $role]);
    }

    public function update(Role $role){
        $role->name = Str::ucfirst(request('name'));
        $role->slug = Str::of(request('name'))->slug('-');

        if($role->isDirty('name')){//means it has been updated
            session()->flash('role-updated', 'Role was updated');
            $role->save();
        }
        else{
            session()->flash('role-updated', 'Nothing to update');   
        }
            
        return back();

    }
}
