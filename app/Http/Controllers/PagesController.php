<?php

namespace App\Http\Controllers;

use App\Picture;
use Illuminate\Support\Facades\Storage;
use App\Category;
use App\Mail\OrderMail;
use App\Product;
use Illuminate\Http\Request;
use LaravelLocalization;
use OpenGraph;
use App\Order;
use App\Message ;
use Mail;

class PagesController extends Controller
{

    public function index()
    {
        $boosted = Product::where('boost', '1')->get();
	    $og = OpenGraph::title(trans('navigation.home') . ' | LusiJewelry')
	       ->siteName(config('app.name', 'LusiJewelry'))
	       ->locale(LaravelLocalization::getCurrentLocale())
	       ->localeAlternate(LaravelLocalization::getSupportedLanguagesKeys())
           ->image('https://images.pexels.com/photos/371102/pexels-photo-371102.jpeg?auto=compress&cs=tinysrgb&h=350')
	       ->type('website')
	       ->url();


    	return view('pages.home', compact('og', 'boosted'));
    }

    /**
     * Show the about view.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function about()
    {
        return view('pages.about');
    }

	public function contact()
    {
        return view('pages.contact');
    }
    public function contacting(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'message' => 'required',
        ]);
        $message = new Message;
        $message->name = $request->name;
        $message->email = $request->email;
        $message->phone = $request->phone;
        $message->subject = $request->subject;
        $message->message = $request->message;
        $message->save();
        return redirect()->route('contact')
            ->with('message', trans('cart.complete'));
    }

    public function location()
    {
        return view('pages.location');
    }
    public function sales(){
        $products = Product::where('new_price', '!=', null)->paginate(10);
        return view('pages.sales.sales', compact('products'));
    }
}
