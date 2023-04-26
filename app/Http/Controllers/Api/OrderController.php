<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Order\StoreOrderRequest;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $orders = $user->orders;
        return $this->sendResponse($orders);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $user = Auth::user();
        $order = new Order();
        $order->user_id = $user->id;
        $order->is_insured = $request->is_insured;
        $order->delivering_address_id = $request->delivering_address_id;
        $order->status = "New";
        $images = [];
        if($request->hasFile('prescription')){
            foreach ($request->file('prescription') as $image ){
                $path = $request->file('prescription')->store('images','public');
                append($path, $image);
            }
            $serializedImages = serialize($image);
            dd($serializedImages);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
