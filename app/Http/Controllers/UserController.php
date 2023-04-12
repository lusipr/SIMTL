<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // $users = User::all();
        $users = User::where('role', '<>', 'tema')->get();
        return view('users.index', ['users' => $users, 'title' => 'Pengguna']);
    }

    public function index_add()
    {
        return view('users.add', ['title' => 'Pengguna']);
    }

    public function store_add(Request $request)
    {
        $validatedData = $request->validate([
            'nip' => 'required',
            'name' => 'required',
            'role' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect('data-user');
    }

    public function index_edit(User $user)
    {
        return view('users.edit', ['user' => $user, 'title' => 'Pengguna']);
    }

    public function store_edit(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'nip' => 'required',
            'name' => 'required',
            'role' => 'required',
            'username' => 'required',
        ]);

        if (!empty($request->password))
        {
            $validatedData['password'] = Hash::make($request->password);
        }

        User::where('id', '=', $user->id)->update($validatedData);

        return redirect('data-user');
    }

    public function delete(User $user)
    {
        User::where('id', '=', $user->id)->delete();

        return redirect('data-user')->with('swal_msg', 'Hapus Data Berhasil');
    }
}
