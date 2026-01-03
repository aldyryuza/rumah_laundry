<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;

class UserController extends Controller
{
    public function index()
    {
        $data = User::all();
        return view('web.users.index', compact('data'));
    }

    public function create()
    {
        return view('web.users.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|min:3|confirmed',
            'role'     => 'required',
            'phone'    => 'required|string|max:20',
            'address'  => 'required|string|max:255',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'role'     => $request->role,
            'phone'    => $request->phone,
            'address'  => $request->address,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')
            ->with('success', 'User berhasil ditambahkan');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('web.users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('web.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->name  = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->role  = $request->role;
        $user->phone = $request->phone;
        $user->address = $request->address;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('users.index')
            ->with('success', 'User berhasil diupdate');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return redirect()->route('users.index')
            ->with('success', 'User berhasil dihapus');
    }
}
