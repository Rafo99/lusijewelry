<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class Service extends Model
{
    use Translatable;

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatedAttributes = ['name', 'description'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected $primaryKey = 'id';
}
