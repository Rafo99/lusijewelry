<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('sent', '1')->where('type', '1')->orderBy('created_at', 'desc')->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function index_preparation()
    {
        $orders = Order::orderBy('sent', '1')->where('type', '0')->orderBy('created_at', 'desc')->get();
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  Request  $request
     * @return Response
     */
    public function update($id, Request $request)
    {
        $order = Order::findOrFail($id);
        if(isset($request->sent)) {
            $order->sent = 1;
        } else {
            $order->sent = 0;
        }
        $order->save();
        return redirect()->route('admin.orders');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        // delete
        $order = Order::findOrFail($id);
        $order->delete();

        // redirect
        return redirect()->route('admin.orders')
            ->with('message', 'Successfully Deleted');;
    }
}
