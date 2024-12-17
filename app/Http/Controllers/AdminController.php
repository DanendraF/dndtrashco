<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function userlist()
    {
        $users = User::all();

        return view('admin.userlist', compact('users'));
        return view('admin.userlist');

    }

    public function deleteUser($id)
    {

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.userlist')->with('success', 'User has been deleted successfully');
    }

    public function tps()
    {
        return view('admin.tps');
    }

    public function blog()
    {
        return view('admin.blog');
    }

    public function market()
    {
        return view('admin.market');
    }
}
