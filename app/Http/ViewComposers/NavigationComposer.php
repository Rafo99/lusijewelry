<?php

namespace App\Http\ViewComposers;

use App\Service;
use Illuminate\View\View;
use App\Category;
use LaraCart;

class NavigationComposer
{
    public $categories = [];
    public $services = [];

    /**
     * Create a navigation composer.
     *
     *
     */
    public function __construct()
    {
        $this->categories = Category::with('children')->get();
        $this->services = Service::all();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('categories', $this->categories);
        $view->with('services', $this->services);
    }
}