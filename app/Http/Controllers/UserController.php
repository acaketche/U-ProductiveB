<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function showUsers()
    {
        $user = User::all();
        return view('user.user-profile', compact('user'));
    }

    // public function createUser()
    // {
    //     return view('contoh-crud.create-user');
    // }

    // public function showUserDetail($user_id)
    // {
    //     $user = User::findOrFail($user_id);
    //     return view('contoh-crud.user-detail', compact('user'));
    // }

    // public function editUser($user_id)
    // {
    //     $user = User::findOrFail($user_id);
    //     return view('contoh-crud.edit-user', compact('user'));
    // }

    // public function store(Request $request)
    // {
    //     User::create($request->all());
    //     return redirect()->route('user.index');
    // }

    // public function update(Request $request, $user_id)
    // {
    //     $user = User::findOrFail($user_id);
    //     $user->update($request->all());
    //     return redirect()->route('user.index');
    // }

    // public function destroy($user_id)
    // {
    //     User::destroy($user_id);
    //     return redirect()->route('user.index');
    // }
}
?>
