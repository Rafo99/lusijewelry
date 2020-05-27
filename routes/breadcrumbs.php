<?php

// Home
Breadcrumbs::register('home', function($breadcrumbs)
{
    $breadcrumbs->push(trans('navigation.home'), route('home'));
});

// Home > About
Breadcrumbs::register('about', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('navigation.about'), route('about'));
});

// Home > About
Breadcrumbs::register('cart', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('cart.cart'), route('cart'));
});

// Home > [Category]
Breadcrumbs::register('showCategory', function($breadcrumbs, $category)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push($category->category->getTranslation()->name, route('home'));
    $breadcrumbs->push(htmlspecialchars($category->getTranslation()->name), route('showCategory', $category->id));
});

// Home > [Category] > [Product]
Breadcrumbs::register('showProduct', function($breadcrumbs, $product)
{
    $breadcrumbs->parent('showCategory', $product->subCategory);
    $breadcrumbs->push(htmlspecialchars($product->getTranslation()->name), route('showProduct', $product->id));
});
