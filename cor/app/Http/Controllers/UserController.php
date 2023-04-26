<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $users = User::whereNotIn('id', [$user->id])->get();
        return view('users.list', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'roles' => Role::get(),
        ];
        return view('users.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $attributes = new User;
        $attributes['name'] = $request->name;
        $attributes['email'] = $request->email;
        $attributes['password'] = Hash::make($request->password);
        $attributes->save();
        $attributes->roles()->attach($request->roles_id);
        return redirect()->route('users.index')->with('success', '#');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'roles' => Role::get(),
            'users' => User::findOrFail($id),
            'users_array' => User::findOrFail($id)->roles->pluck('id')->toArray(),
        ];
        return view('users.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $attributes = User::findOrFail($id);
        $attributes['name'] = $request->name;
        $attributes['email'] = $request->email;
        if ($request->password != '') {
            $attributes['password'] = Hash::make($request->password);
        }
        $attributes->save();
        $attributes->roles()->sync($request->roles_id);
        return redirect()->route('users.index')->with('success', '#');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $users = User::findOrFail($id);
        $users->delete();
        return redirect()->route('users.index')->with('success', '#');
    }

    public function destroyAttach($id)
    {
        $users = User::findOrFail($id);
        $users->roles()->detach();

        return redirect()->route('users.index')->with('success', '#');
    }
}
