<?php

namespace App\Http\Controllers;

use App\Billings;
use Illuminate\Http\Request;
use App\Cart;
use App\Mail\OrderShipped;
use App\Product;
use App\sale;
use App\Shippings;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    function Payment(Request $request)
    {
        $sub_total = $request->session()->get('sub_total');
        $discount = $request->session()->get('discount');

        $shipping_id = Shippings::insertGetId([
            'user_id' => Auth::user()->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'company_name' => $request->company_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
            'zipcode' => $request->zipcode,
            'notes' => $request->notes,
            'created_at' => Carbon::now()
        ]);

        $sale_id = sale::insertGetId([
            'user_id' => Auth::user()->id,
            'shoping_id' => $shipping_id,
            'grand_total' => $sub_total,
            'discount' => $discount,
            'created_at' => Carbon::now()
        ]);

        $user_ip = $_SERVER['REMOTE_ADDR'];
        $carts = Cart::with('product')->where('user_ip', $user_ip)->get();

        foreach ($carts as $item) {
            Billings::insert([
                'user_id' => Auth::user()->id,
                'sale_id' => $sale_id,
                'product_id' => $item->product_id,
                'shipping_id'=>$shipping_id,
                'product_price' => $item->product->product_price,
                'product_quantity' => $item->product_quantity,
                'created_at' => Carbon::now()
            ]);

            Product::findOrFail($item->product_id)->decrement('product_quantity', $item->product_quantity);
            $item->delete();
        }

        \Stripe\Stripe::setApiKey('sk_test_51GugviJIXUh75oNJpGwmevLZLIR46LIQmvWPBmjXIHR443YrfjmntsOkvIzavXJFmSHJQ4jn8pD4grWjwmsXuztg00RdvGW3zB');

        \Stripe\Charge::create([
            'amount' => $sub_total *100,
            'currency' => 'usd',
            "source" => $request->stripeToken,
        ]);
        return redirect('/');

        $orderdata =  Billings::where('shipping_id',$shipping_id)->get();

        Mail::to(Auth::user()->email)->send(new OrderShipped($orderdata));
    }
}
