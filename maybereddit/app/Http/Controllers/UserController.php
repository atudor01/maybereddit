<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query()->paginate();
        return view('users.index', ['users' => $users]);
    }

    public function show($id)
    {
        return view('users.show', ['user' => User::findOrFail($id)]);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $user = User::create($request->all());
        return redirect()->route('users.show', $user);
    }

    public function edit($id)
    {
        return view('users.edit', ['user' => User::findOrFail($id)]);
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return redirect()->route('users.show', $user);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index');
    }
}
