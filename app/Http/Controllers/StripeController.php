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
//        $order = Order::find($request->order_id);
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        /*Stripe\Charge::create([
            "amount" => $order->total_price,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "pay for medicines order"
        ]);*/
        $link = Stripe\Charge::create([
            "amount" => 10.00,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "pay for medicines order"

        ]);
        dd($link);

        Session::flash('success', 'Payment successful!');

        return to_route('order.orderConfirm', ['id' => $request->order_id]);
    }
}
