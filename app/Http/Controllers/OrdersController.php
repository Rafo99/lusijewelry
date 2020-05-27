<?php

namespace App\Http\Controllers;

use App\Order;
use App\Picture;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrdersController extends Controller
{
    public function showOrder($id, Request $request){
        $data = [];
        $data['product'] = Product::findorfail($id);
        $data['productpics'] = Picture::where('product_id', $id)->get();
        $data['category'] = $data['product']->category;

        return view('pages.order', compact('data'));
    }

    function makeOrder($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required',
            'email_phone' => 'required',
//            'g-recaptcha-response' => 'required|captcha',
        ]);

        if ($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $order = new Order;
        $order->product_id = $id;
        $order->name = $request->name;
        $order->last_name = $request->last_name;
        $order->email_phone = $request->email_phone;
        $order->message = $request->message;
        $order->address = $request->address;
        $order->save();

        return redirect(route('home'))->with('message', trans('cart.complete'));
    }
}
