<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Exception;
use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class StripeController extends Controller
{
    public function stripe(Request $request)
    {
        $url = $request->root();
        $order = Order::where('id', $request->query('id'))->firstOrFail();

        if ($order->status != 'Waiting') {
            return redirect()->route('order.status', ['id' => $order->id]);
        }

        $products = [];
        $total_price = 0;
        foreach ($order->medicines as $medicine) {
            $products[] = ['price_data' =>
                [
                    'currency' => 'usd',
                    'unit_amount' => $medicine->pivot->price * 100,
                    'product_data' => [
                        'name' => $medicine->name,
                        'description' => $medicine->type->name,
                        //'images' => [$order->pharmacy?->avatar?->getUrl()],
                    ],
                ],
                'quantity' => $medicine->pivot->quantity,
            ];
            $total_price += $medicine->pivot->price * $medicine->pivot->quantity;
        }
        $order->total_price = $total_price;
        $order->save();


        Stripe::setApiKey(env('STRIPE_SECRET'));
        $checkout_session = Session::create([
            'line_items' => $products,
            'mode' => 'payment',
            "customer_email" => $order->user->email,
            "payment_method_types" => ["card"],
            'success_url' => route('stripe.success', ['id' => $order->id]),
            'cancel_url' => route('stripe.cancel', ['id' => $order->id]),
            'client_reference_id' => $order->id,
        ]);

        return redirect($checkout_session->url, 303);
    }

    public function stripeSuccess(Request $request)
    {
        $order = Order::find($request->id);
        $order->status = 'Confirmed';
        $order->save();
        return redirect()->route('order.status', ['id' => $order->id])->with('success', 'Payment successful!');
    }

    public function stripeCancel(Request $request)
    {
        $order = Order::find($request->id);
        $order->status = 'Canceled';
        $order->save();
        return redirect()->route('order.status', ['id' => $order->id])->with('error', 'Payment failed!');
    }

    public function status($id)
    {
        $order = Order::find($id);
        return view('status', compact('order'));
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
