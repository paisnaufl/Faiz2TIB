<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::check()){
			return redirect()->route('auth.login');
		}
        $data['dataUser'] = User::all();
		return view('admin.user.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'name' => 'required|string',
        'email'  => 'required|email',
        'password'   => 'required|string',
        'role'   => 'required|string',
    ]);

        $data['name'] = $request->name;
		$data['email'] = $request->email;
		$data['password'] = Hash::make($request->string);
		$data['role'] = $request->role;

		User::create($data);

		return redirect()->route('user.index')->with('success','Penambahan Akun Berhasil!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['dataUser'] = User::findOrFail($id);
        return view('admin.user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
        'name' => 'required|string',
        'email'      => 'required|email',
        'password'      => 'required|string',
        'role'      => 'required|string',
    ]);

        $user_id = $id;
        $user = User::findOrFail($user_id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = hash::make($request->password);
        $user->role = $request->role;

        $user->save();
        return redirect()->route('user.index')->with('success','Perubahan Akun Berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $user->delete();
        return redirect()->route('user.index')->with('success','Akun berhasil dihapus');
    }
}
