<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ['title', 'price', 'image'];

    public function materials()
    {
        return $this->belongsToMany('App\Material', 'product_materials', 'product_id', 'material_id');
    }
}