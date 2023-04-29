<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()->collection(Order::with([
                'user:id,name',
                'doctor:id,name',
                'pharmacy:id,name',
                'delivering_address:id,street_name,building_number',

            ])->get())->toJson();
        }
        return view('admin.orders.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        dd($request->all());
//        dd(Auth::user()->getRoleNames()->first());
        $order = new Order();
        $order->user_id = $request->user_id;
        $order->pharmacy_id = Auth::user()->pharmacy_id;
        $order->doctor_id = $request->doctor_id;
        $order->status = 'Processing';
        $order->delivering_address_id = User::find($request->user_id)->addresses()->where('is_main', 1)->first()->id;
        $order->is_insured = $request->is_insured;
        $order->creation_type = Auth::user()->getRoleNames()->first();

        $order->save();

        return redirect()->route('orders.edit', $order->id);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('admin.orders.create', compact('users'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $order, Request $request)
    {
        if ($request->ajax()) {
            return datatables()->eloquent($order->medicines()->with('medicine'))->toJson();
        }
        $order = Order::find($order);
        $medicines = Medicine::all();
        return view('admin.orders.edit', compact('order', 'medicines'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $order)
    {
        $order = Order::find($order);
        $medicine = Medicine::find($request->medicine_id);
        $order->medicines()->attach($medicine->id, ['quantity' => $request->quantity, 'price' => $medicine->price]);
        return redirect()->route('orders.edit', $order->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
