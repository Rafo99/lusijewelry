<?php

namespace App\Http\Controllers;

use App\Mail\OrderMail;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use \LaraCart;
use App\Product;
use App\Order;
use Mail;

class CartController extends Controller
{
	function index()
	{
		$items = LaraCart::getItems();
		$count = count($items);
		$total = intval(LaraCart::total($formatted = false));
		return view('pages.cart.index', compact('items', 'total', 'count'));
	}

	function total()
	{
		$total = intval(LaraCart::total($formatted = false));
		return response()->json([
			'total' => $total,
		]);
	}

	function add(Request $request)
	{
		$this->validate($request, [
			'product_id' => 'required|integer',
			'quantity' => 'required|integer|min:1',
		]);

		try {
			Product::findOrFail( $request->product_id );
		} catch (ModelNotFoundException $e) {
			return response()->json(['success' => false])
			                 ->setStatusCode(404);
		}

		LaraCart::add(
			$request->product_id,
			$qty = intval($request->quantity)
		);

		return response()->json([
			'success' => true,
		]);
	}

	function remove($product_id)
	{
		$item = LaraCart::find(['id' => intval($product_id)]);
		if($item) {
			LaraCart::removeItem($item->getHash());
			return response()->json([
				'success' => true,
			]);

		}
		return response()->json([
			'success' => false,
		]);

	}

	function empty()
	{
		LaraCart::emptyCart();
		return response()->json([
			'success' => true,
		]);
	}

	function checkout(){
        $total = intval(LaraCart::total($formatted = false));
        return view('pages.order.index', compact('total'));
    }

    function order(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'lastName' => 'required',
            'phone' => 'required',
//            'g-recaptcha-response' => 'required|captcha',
        ]);
        $cart = LaraCart::getItems();
        $total = intval(LaraCart::total($formatted = false));
        if($total < 1) abort(409);
        $order = new Order;
        $order->name = $request->name;
        $order->last_name = $request->lastName;
        $order->phone = $request->phone;
        $order->price = $total;
        $order->sent = 0;
        $order->type = $request->type;
        $order->save();
        foreach ($cart as $product) {
            $order->products()->create([
                'product_id'  => $product->id,
                'qty'         => $product->qty,
                'price'       => $product->price,
            ]);
        }
        $products = new Collection;
        // stex hatuk poxel ei or foreach-ov select chenenq bauc vochinch
        foreach ($cart as $item) {
            $product = Product::findOrFail($item->id);
            $product->qty = $item->qty;
            $products []= $product;
        }
        $order->total = $total;
        $order->products = $products;

        Mail::to(env('ADMIN_EMAIL', ''))->send(new OrderMail($order, $total));

        $this->empty();
        return redirect()->route('cart.index')
            ->with('message', trans('cart.complete'));
    }
}
