<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class Category extends Model
{
	use Translatable;

	/**
	 * The attributes that are translatable.
	 *
	 * @var array
	 */
	public $translatedAttributes = ['name'];

	/**
	 * The "booting" method of the model.
	 *
	 * @return void
	 */
	protected static function boot()
	{
		parent::boot();

		static::addGlobalScope('onlyParents', function ($query) {
            $query->where('parent_id', null);
		});
	}

	protected static function filter($products, $request) {
        if ($request->has('color') && $request->color)
        {
            $products = $products->where('color', $request->color);
        }
        if ($request->has('carat') && $request->carat)
        {
            $products = $products->where('karat', $request->carat);
        }
        if ($request->has('from') && $request->from)
        {
            $products = $products->where('price', '>=', $request->from);
        }
        if ($request->has('to') && $request->to)
        {
            $products = $products->where('price', '<=', $request->to);
        }
        if ($request->has('sex') && $request->sex)
        {
            $products = $products->where('sex', $request->sex);
        }
        if ($request->has('sort') && $request->sort)
        {
            if ($request->sort == 2) {
                $products = $products->orderBy('created_at', 'desc');
            }
            elseif ($request->sort == 3) {
                $products = $products->orderBy('price', 'asc');
            }
            elseif ($request->sort == 4) {
                $products = $products->orderBy('price', 'desc');
            }
            else {
                $products = $products->orderBy('created_at', 'asc');
            }
        }

        return $products;
    }

    /**
     * Get the parent of the category.
     */
	public function parent()
	{
		return $this->belongsTo(Category::class, 'parent_id', 'id');
	}

    /**
     * Get the subcategories for the category.
     */
    public function children()
    {
    	return $this->hasMany(Category::class, 'parent_id', 'id')->withoutGlobalScope('onlyParents');
    }

    /**
     * Get the products for the category.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
