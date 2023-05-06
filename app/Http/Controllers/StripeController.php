<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Exception;
use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Stripe;

class StripeController extends Controller
{
    public function stripe(Request $request)
    {
        $order = Order::where('id', $request->query('id'))->firstOrFail();
        return view('stripe', compact('order'));
    }

    public function stripePost(Request $request)
    {
        $order = Order::find($request->order_id);

        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));
            Charge::create([
                'amount' => $order->total_price * 100,
                'currency' => 'usd',
                'description' => 'Example charge',
                'source' => $request->stripeToken,
            ]);
            $order->status = 'Confirmed';
            $order->save();
            // go to /stripe?id=order->id
            return redirect()->route('stripe', ['id' => $order->id])->with('success', 'Payment successful!');
        } catch (Exception $e) {
            return redirect()->route('stripe', ['id' => $order->id])->with('error', "Payment failed! " . $e->getMessage());
        }
    }
}
