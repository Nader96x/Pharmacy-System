<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderMedicineQuantity;
use Illuminate\Http\Request;

class OrderMedicineQuantityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // orders in my pharmacy that are not delivered
        // ['New', 'Processing', 'Waiting', 'Canceled', 'Confirmed', 'Delivered']
        $orders = Order::where('pharmacy_id', 1)
            ->where('status', 'New')
            ->get();
        return view('orders.index', ['orders' => $orders], compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderMedicineQuantity $orderMedicine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrderMedicineQuantity $orderMedicine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrderMedicineQuantity $orderMedicine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderMedicineQuantity $orderMedicine)
    {
        //
    }
}
