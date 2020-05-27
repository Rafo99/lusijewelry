<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use OpenGraph;
use Illuminate\Http\Request;
use LaravelLocalization;

class CategoriesController extends Controller
{
    public function gold($id, Request $request)
    {
        $data = [];
        $category = Category::withoutGlobalScope('onlyParents')->find($id);
        $products = $category->products()->where('type', 'golden');

        // min and max prices for PriceSlider
        $data['minPrice'] = $products->get()->min('price');
        $data['maxPrice'] = $products->get()->max('price');

        // filtering
        $products = Category::filter($products, $request);

        //paginate
        $products = $products->paginate(9);

        $data['category'] = $category;
        $data['products'] = $products;
        $data['title'] = trans($category->name);

        // openGraph
        $og = OpenGraph::title($category->getTranslation()->name . ' | LusiJewelry')
            ->siteName(config('app.name', 'LusiJewelry'))
            ->locale(LaravelLocalization::getCurrentLocale())
            ->localeAlternate(LaravelLocalization::getSupportedLanguagesKeys())
            ->type('website')
            ->url();

        return view('pages.categories.index', compact( 'data', 'og'));
    }

    public function engagementRings(Request $request)
    {
        $data = [];
        $products = Product::where('type', 'oblige');

        // min and max prices for PriceSlider
        $data['minPrice'] = $products->get()->min('price');
        $data['maxPrice'] = $products->get()->max('price');

        // filtering
        $products = Category::filter($products, $request);

        //paginate
        $products = $products->paginate(9);
        $data['products'] = $products;
        $data['title'] = 'Engagement Rings';
        // openGraph
        $og = OpenGraph::title('Engagement Rings' . ' | LusiJewelry')
            ->siteName(config('app.name', 'LusiJewelry'))
            ->locale(LaravelLocalization::getCurrentLocale())
            ->localeAlternate(LaravelLocalization::getSupportedLanguagesKeys())
            ->type('website')
            ->url();

        return view('pages.categories.index', compact( 'data', 'og'));
    }

    public function gifts(Request $request)
    {
        $data = [];
        $products = Product::where('price', '<=', 200);

        // min and max prices for PriceSlider
        $data['minPrice'] = $products->get()->min('price');
        $data['maxPrice'] = $products->get()->max('price');

        // filtering
        $products = Category::filter($products, $request);

        //paginate
        $products = $products->paginate(9);
        $data['products'] = $products;
        $data['title'] = 'Gifts';
        // openGraph
        $og = OpenGraph::title('Gifts' . ' | LusiJewelry')
            ->siteName(config('app.name', 'LusiJewelry'))
            ->locale(LaravelLocalization::getCurrentLocale())
            ->localeAlternate(LaravelLocalization::getSupportedLanguagesKeys())
            ->type('website')
            ->url();

        return view('pages.categories.index', compact( 'data', 'og'));
    }

}
