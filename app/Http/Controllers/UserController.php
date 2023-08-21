<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $stores = Store::all();
        return view('settings.index', [
            'users' => $users,
            'stores' => $stores
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $userData = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        if (auth()->attempt($userData)) {
            $request->session()->regenerate();
            $user = User::find($request->id);
            // if(auth()->user()->roles->pluck('name')[0] == 'admin'){
            //     return redirect('/admin');
            // }
            return redirect('/')->with('message', 'You are logged in');
        }
        return back()->with('error', 'Invalid Credentials')->onlyInput('username');
    }

    /**
     * Log out from Session
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stores = Store::all();
        return view('auth.register', [
            'stores' => $stores
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'username' => 'required',
            'password' => 'required|confirmed',
            'store_id' => 'required' 
        ]);

        $userData['password'] = bcrypt($userData['password']);

        $user = User::create($userData);
        $user->assignRole($request->role);
        

        return redirect('/settings')->with('message', 'User Registered');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $stores = Store::all();
        return view('settings.show', [
            'user' => $user,
            'stores' => $stores
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $present_role = $user->roles->pluck('name')[0];

        if($user->roles->pluck('name')[0] !== ""){
            $user->removeRole($present_role);
            $user->assignRole($request->role);
        }
        
        if ($request->password !== "") {
            $user->password = bcrypt($request->password);

            $user->save();
        }
        $user->store_id = $request->store_id;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->save();

        return back()->with('message', 'Settings Saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        $user->delete();

        return redirect('/settings')->with('message', 'User Deleted');
    }
}
