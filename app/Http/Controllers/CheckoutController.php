<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Cartalyst\Stripe\Exception\CardErrorException;
use App\Http\Requests\CheckoutRequest;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('checkout');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckoutRequest $request)
    {
        $contents = Cart::content()->map(function($item){
            return $item->model->name . ', '. $item->qty;
        })->values()->toJson();

        try {
            $charge = Stripe::charges()->create([
                'amount' => presentPrice(getCoupon()->get('newTotal')),
                'currency' => 'USD',
                'source' => $request->stripeToken,
                'description' => 'Order',
                'receipt_email' => $request->email,
                'metadata' => [
                    'contents' => $contents,
                    'quantity' => Cart::instance('default')->count(),
                    // 'discount' => (getCoupon()->get('code'))->toJson(),
                ],
            ]);

            //Successfull
            Cart::instance('default')->destroy();
            session()->forget('coupon');
            // return back()->with('success_message', 'Thank you! Your payment has been successfully accepted!');
            return redirect()->route('thankyou.index')->with('success_message', 'Thank you! Your payment has been successfully accepted!');
        } catch(CardErrorException $e) {
            return back()->withErrors('Error! ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
