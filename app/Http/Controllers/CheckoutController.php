<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Session;
use Cart;
use Mail;

class CheckoutController extends Controller
{
    public function index()
    {
        $title = 'Checkout';

        return view('frontend.checkout')->with(compact('title'));
    }

    public function pay(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $charge = Charge::create([
            'amount' => Cart::total() * 100,
            'currency' =>'usd',
            'description' => 'Test payment',
            'source' => $request->stripeToken
        ]);

        Session::flash('success', 'Purchase Successful. Wait for our email');
        Cart::destroy();

        Mail::to($request->stripeEmail)->send(new \App\Mail\purchaseSuccessful);

        return redirect()->route('index');
    }
}
