<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Stripe;

class StripeController extends Controller
{
    public function stripe(Request $request)
    {
        $order = Order::where('id', $request->query('id'))->firstOrFail();
//        dd($order);
        return view('stripe', ["order" => $order]);
    }

    public function stripePost(Request $request)
    {
        $order = Order::find($request->order_id);
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
//        dd($order);
        Stripe\Charge::create([
            "amount" => floatval($order->total_price) * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "pay for medicines order"
        ]);
        
        Session::flash('success', 'Payment successful!');

        return to_route('order.orderConfirm', ['id' => $request->order_id]);
    }
}