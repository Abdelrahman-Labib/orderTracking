<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $orders = Order::all();
        $users = User::select('id', 'name')->get();

        return view('orders.index', compact('orders', 'users'));
    }

    public function store(Request $request)
    {
        //VALIDATE REQUEST
        $rules = [
            'user_id'    => 'required|exists:users,id',
            'address'    => 'required|max:190',
            'order_info' => 'required|max:190'
        ];
        $this->validate($request, $rules);

        //INSERT USER
        Order::create([
            'user_id'    => $request->user_id,
            'address'    => $request->address,
            'order_info' => $request->order_info,
        ]);

        return back()->with('success', 'Added successfully');
    }
}
