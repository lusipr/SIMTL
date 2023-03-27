<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TemaController extends Controller
{
    public function index()
    {
        $users = User::where('role', '=', 'Tema')->get();

        return view('tema.index', ['users' => $users, 'title' => 'Tema']);
    }

    public function index_add()
    {
        return view('tema.add', ['title' => 'Tema']);
    }

    public function store_add(Request $request)
    {
        $validatedData = $request->validate([
            'nip' => 'required',
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        $validatedData['role'] = 'Tema';
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect('data-tema');
    }

    public function index_edit(User $user)
    {
        return view('tema.edit', ['user' => $user, 'title' => 'Tema']);
    }

    public function store_edit(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'nip' => 'required',
            'name' => 'required',
            'username' => 'required',
        ]);

        if (!empty($request->password))
        {
            $validatedData['password'] = Hash::make($request->password);
        }

        User::where('id', '=', $user->id)->update($validatedData);

        return redirect('data-tema');
    }

    public function delete(User $user)
    {
        User::where('id', '=', $user->id)->delete();

        return redirect('data-tema')->with('swal_msg', 'Hapus Data Berhasil');
    }
}
