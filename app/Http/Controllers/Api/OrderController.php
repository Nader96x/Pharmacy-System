<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Order\StoreOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\OrderPrescriptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OrderController extends BaseController
{
    /**
     * list all orders for authenticated user
     */
    public function index()
    {
        $user = Auth::user();
        $orders = $user->orders;
        return $this->sendResponse(OrderResource::collection($orders));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $user = Auth::user();
        $order = new Order();
        $prescriptions = $request->validated('prescription');
        $order->user_id = $user->id;
        $order->is_insured = $request->is_insured;
        $order->delivering_address_id = $request->delivering_address_id;
        $order->status = "New";
        $order->save();
        $this->StorePrescription($prescriptions,$order->id);
        return $this->sendResponse(new OrderResource($order));
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
    private function StorePrescription ($prescriptions, $order_id) {
        foreach ($prescriptions as $prescription) {
            $prescriptionName = time() .'-'.$prescription->getClientOriginalName();
            $prescriptionPath = $prescription->storeAs('public/prescription_images', $prescriptionName);
            $orderPrescription = new OrderPrescriptions([
                'image' => $prescriptionName,
                'order_id' => $order_id
            ]);
            $orderPrescription->save();
        }
    }
}
