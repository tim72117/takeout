<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Order;
use App\Material;

class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return View::make('orders');
    }

    /**
     * Show all orders.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        $orders = Order::with('products')->get();

        return ['orders' => $orders];
    }

    public function checkout(Request $request)
    {
        Order::find($request->input('order_id'))->delete();

        $orders =  Order::with('products')->get();

        return ['orders' => $orders];
    }

    public function materials()
    {
        $materials = Order::with('products.materials')->get()->reduce(function ($carry, $order) {
            $order->products->each(function ($product) use ($carry) {
                foreach ($product->materials as $material) {
                    $carry[$material->id]->amount += $product->pivot->amount;
                }
            });
            return $carry;
        }, Material::all()->keyBy('id'))->values();

        return ['materials' => $materials];
    }

    public function products()
    {
        
    }
}
