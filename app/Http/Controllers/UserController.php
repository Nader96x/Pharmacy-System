<?php

namespace App\Http\Controllers;


use App\Models\User;

class UserController extends Controller
{
    public function index(){
        $users = User::withTrashed()->paginate(10);
        return view('admin.users.index',['users'=>$users]);
    }
    public function destroy($id){
        $user = User::where('id',$id)->first();
        if ($user) {
            $user->delete();
            return to_route('users.index');
        }else
            return back()->with('error', 'user not found');
    }
}
