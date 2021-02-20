<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::get();
        return view('users.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::with('topics')->find($id);
        return view('users.show', compact('user'));
    }

    public function store(Request $request)
    {
        //VALIDATE REQUEST
        $this->checkValidation($request);

        //INSERT USER
        User::create([
            'name'      => $request->name,
            'phone'     => $request->phone,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
        ]);

        return back()->with('success', 'Added successfully');
    }

    public function update(Request $request, $id)
    {
        //VALIDATE REQUEST
        $this->checkValidation($request, $id);

        //UPDATE USER
        User::find($id)->update([
            'name'      => $request->name,
            'phone'     => $request->phone,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
        ]);

        return back()->with('success', 'Updated successfully');
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return back()->with('success', 'Deleted successfully');
    }

    public function checkValidation($input, $id = null)
    {
        $input->validate([
            'name'      => 'required',
            'phone'     => 'required|unique:users,phone,'.$id,
            'email'     => 'required|unique:users,email,'.$id,
            'password'  => 'required_with'.$id.'|min:6',
        ]);
    }
}
