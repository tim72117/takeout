<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $table = 'orders';

    protected $fillable = array('no', 'total', 'taked_at');

    protected $appends = ['wait'];

    public function products()
    {
        return $this->belongsToMany('App\Product', 'order_products', 'order_id', 'product_id')->withPivot('amount');
    }

    public function getWaitAttribute($value)
    {
        $wait = Carbon::now()->diffInMinutes(Carbon::parse($this->attributes['taked_at']), false);
        return $wait > 0 ? $wait : 0;
    }
}