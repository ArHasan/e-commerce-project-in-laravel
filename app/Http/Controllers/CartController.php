<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart($coupon = '')
    {
        if ($coupon == '') {
            $discount = 0;
            $user_ip = $_SERVER['REMOTE_ADDR'];
            $carts = Cart::with('product')->where('user_ip', $user_ip)->get();
            session(['discount' =>$discount]);
            return view('frontend.cart', compact('carts','discount'));
        } else {

            if (Coupon::where('coupon_code', $coupon)->exists()) {
                $validity = Coupon::where('coupon_code', $coupon)->first()->coupon_validity;

                if (Carbon::now()->format('Y-m-d') <= $validity) {

                    $user_ip = $_SERVER['REMOTE_ADDR'];
                    $carts = Cart::with('product')->where('user_ip', $user_ip)->get();
                    $discount = Coupon::where('coupon_code', $coupon)->first()->coupon_discount;
                    session(['discount' =>$discount]);
                    return view('frontend.cart', compact('carts','discount'));

                } else {
                    return back()->with('expired','Coupon date is expired');
                }
            } else {
                return back()->with('coupon_error','This Coupon is Not Valied');
            }

        }

    }

    public function SingleCartDelete($cart_id)
    {
        $user_ip = $_SERVER['REMOTE_ADDR'];
        Cart::where('id', $cart_id)->where('user_ip', $user_ip)->delete();
        return back()->with('CartDelete', 'Cart Item Deleted Sussufully');
    }

    public function CartUpdate(Request $request)
    {

        foreach ($request->cart_id as $key => $item) {
            Cart::findOrFail($item)->update([
                'product_quantity' => $request->product_quantity[$key],
                'update_at' => Carbon::now(),
            ]);
        }

        return back();
    }
}
