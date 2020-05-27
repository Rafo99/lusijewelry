<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dimsav\Translatable\Translatable;

class Product extends Model
{
	use SoftDeletes;
	use Translatable;

	/**
	 * The attributes that are translatable.
	 *
	 * @var array
	 */
	public $translatedAttributes = ['name', 'description'];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['sku', 'price', 'type', 'sex', 'qty', 'picture', 'color', 'karat', 'size'];

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = ['deleted_at'];

    /**
     * Get the category of the product.
     */
	public function category()
    {
        return $this->belongsTo(Category::class)->withoutGlobalScope('onlyParents');
    }

    public function pictures()
    {
        return $this->hasMany('App\Picture');
    }

    public function insertPicture($picture)
    {
        if($picture == null)
            return;
        $array = explode('/', $picture);
        $picture = end($array);
        $result =  $this->pictures()->create([
            'picture' =>  $picture
        ]);
        $this->save();
        return $result;
    }
}
