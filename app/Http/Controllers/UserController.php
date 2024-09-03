<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function kelolaUser()
        {
            {
                $users = User::all();
                return view('admin.kelola-user', compact('users'));
            }
        }

        public function destroy($id)
        {
            $users = User::findOrFail($id);
            $users->delete();

            return redirect()->route('kelola.user')->with('success', 'Kategori berhasil dihapus.');
        }
}
?>
