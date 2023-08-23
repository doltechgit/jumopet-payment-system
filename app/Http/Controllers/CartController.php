<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts = Cart::all();
        $cart_sum = Cart::all()->sum('price');
        return response()->json([
            'status' => 200,
            'carts' => $carts,
            'cart_sum' => $cart_sum
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cart_check = Cart::where('product_id', $request->product_id)->count();
        if($cart_check > 0){
            $cart_product = Cart::where('product_id', $request->product_id)->first();
            $unit_price = $cart_product->price / $cart_product->quantity;
            $cart_product->quantity = $cart_product->quantity + $request->quantity;
            $cart_product->price = $unit_price * $cart_product->quantity;
            $cart_product->save();
            $carts = Cart::all();
            $cart_sum = Cart::all()->sum('price');
            return response()->json([
                'status' => 200,
                'carts' => $carts,
                'cart_sum' => $cart_sum
            ]);
        }else{
            $product = Product::find($request->product_id);
            $cart = Cart::create([
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'name' => $product->name,
                'unit_price' => $product->price,
                'price' => $product->price * $request->quantity
            ]);
            $cart->save();
            $carts = Cart::all();
            $cart_sum = Cart::all()->sum('price');
            return response()->json([
                'status' => 200,
                'carts' => $carts,
                'cart_sum' => $cart_sum
            ]);
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart_item = Cart::find($id);

        $cart_item->delete();

        $carts = Cart::all();
        $cart_sum = Cart::all()->sum('price');
        return response()->json([
            'status' => 200,
            'carts' => $carts,
            'cart_sum' => $cart_sum
        ]);
    }

    public function clear_cart()
    {
        \App\Models\Cart::query()->delete();

        $carts = Cart::all();
        $cart_sum = Cart::all()->sum('price');
        return response()->json([
            'status' => 200,
            'carts' => $carts,
            'cart_sum' => $cart_sum
        ]);
    }
}
