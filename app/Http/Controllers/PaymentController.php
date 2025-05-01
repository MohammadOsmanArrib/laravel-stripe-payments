<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;

class PaymentController extends Controller
{
    public function showForm()
        {
            return view('payment');
        }

    public function process(Request $request)
        {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            Charge::create([
                "amount" => $request->amount * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Stripe payment example",
            ]);

            return back()->with('success', 'Payment successful!');
        }
}
