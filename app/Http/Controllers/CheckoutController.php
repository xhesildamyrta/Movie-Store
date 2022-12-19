<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Order;
use Braintree\Gateway;
use Carbon\Carbon;
use Cartalyst\Stripe\Exception\CardErrorException;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!auth()->check())
            return redirect('/');
        $gateway = new Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);

        $paypalToken = $gateway->ClientToken()->generate();
        return view('checkout')->with('paypalToken', $paypalToken);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckoutRequest $request)
    {
        $contents = Cart::content()->map(function ($item) {
            return $item->model->title;
        })->values()->toJson();

        try {
            $charge = Stripe::charges()->create([
                'amount' => Cart::total(),
                'currency' => 'USD',
                'source' => $request->stripeToken,
                'description' => 'Order',
                'receipt_email' => $request->email,
                'metadata' => [
                    'contents' => $contents,
                ],
            ]);

            $date = Carbon::now();
            $purchase_date = $date->toDateString();
            $due_date = $date->addMonth(1)->toDateString();

            foreach (Cart::content() as $item) {
                $order = Order::create([
                    'user_id' => auth()->user() ? auth()->user()->id : null,
                    'dateOfPurchase' => $purchase_date,
                    'dueDate' => $due_date,
                    'video_id' => $item->model->id,
                ]);
            }


            Cart::instance('default')->destroy();
            return redirect()->route('confirmation')->with('success_message', 'Thank you! Your payment has been successfully accepted!');

        } catch (CardErrorException $e) {
            return back()->withErrors('Error! ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function paypalCheckout(Request $request)
    {

        $gateway = new \Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);

        $nonce = $request->payment_method_nonce;

        $result = $gateway->transaction()->sale([
            'amount' => Cart::total(),
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        $transaction = $result->transaction;

        if ($result->success) {
            $date = Carbon::now();
            $purchase_date = $date->toDateString();
            $due_date = $date->addMonth(1)->toDateString();

            foreach (Cart::content() as $item) {
                $order = Order::create([
                    'user_id' => auth()->user() ? auth()->user()->id : null,
                    'dateOfPurchase' => $purchase_date,
                    'dueDate' => $due_date,
                    'video_id' => $item->model->id,
                ]);
            }

            Cart::instance('default')->destroy();
            return redirect()->route('confirmation')->with('success_message', 'Thank you! Your payment has been successfully accepted!');

        } else {
            return back()->withErrors('An error occurred with the message: ' . $result->message);
        }
    }
}
