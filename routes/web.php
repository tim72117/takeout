<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', 'OrderController@index');
Route::get('orders', 'OrderController@all');
Route::get('materials', 'OrderController@materials');
Route::get('products', 'OrderController@products');
Route::post('checkout', 'OrderController@checkout');


Route::get('products', function () {

    $products =  App\Product::all();

    return ['products' => $products];
});

Route::get('buy', 'CustomerController@buy');
Route::post('buy/checkout', 'CustomerController@checkout');

Route::post('order', function (Illuminate\Http\Request $request) {

    $products = array_reduce($request->input('items'), function ($carry, $item) {
        $carry[$item['id']] = ['amount' => $item['amount']];
        return $carry;
    }, []);

    $total = App\Product::find(array_keys($products))->reduce(function ($carry, $product) use ($products) {
        $carry += $products[$product->id]['amount'] * $product->price;
        return $carry;
    }, 0);

    $no = App\Order::withTrashed()->max('no') ?: 0;
    $taked_at = Carbon\Carbon::now()->addMinutes(10)->toDateTimeString();

    $ordered = App\Order::create(['no' => $no+1, 'total' => $total, 'taked_at' => $taked_at]);

    $ordered->products()->attach($products);

    return ['ordered' => $ordered];
});

Route::post('cart', function (Illuminate\Http\Request $request) {

    $cartItems = $request->session()->get('items', []);

    array_set($cartItems, $request->input('item')['id'], $request->input('item'));

    $request->session()->put('items', $cartItems);

    return ['items' => $cartItems];
});

Route::get('cart', function (Illuminate\Http\Request $request) {
    $products = array_values($request->session()->get('items', []));
    return ['products' => $products];
});

Route::delete('cart', function (Illuminate\Http\Request $request) {
    $request->session()->forget('items');
    $products = array_values($request->session()->get('items', []));
    return ['products' => $products];
});

Route::delete('cart/item/{id}', function ($id, Illuminate\Http\Request $request) {

    $cartItems = $request->session()->get('items', []);

    array_forget($cartItems, $id);

    $request->session()->put('items', $cartItems);

    return ['product' => $cartItems];
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
