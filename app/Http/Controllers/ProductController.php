<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        
        $categories = Category::all();
        if (auth()->user()->roles->pluck('name')[0] == 'admin') {
            return view('products.index', [
                'products' => $products,
                'categories' => $categories
            ]);
        }
        return view('products.index', [
            'products' => auth()->user()->store->products,
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::create([
            'name' => $request->name,
            'category_id' => $request->category,
            'size' => $request->size,
            'quantity' => 0,
            'price' => $request->price,
            'user_id' => auth()->user()->id,
            'store_id' => auth()->user()->store->id
        ]);

        $product->save();

        return back()->with('message', 'Product added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        $categories = Category::all();

        return view('products.show', [
            'product' => $product,
            'categories' => $categories
        ]);
    }

    public function get_product($id)
    {

        $product = Product::find($id);
        // $clients = Client::where('name', $id)->orWhere('phone', $id)->get();
        try {
            return response()->json([
                'status' => 200,
                'product' => $product,
            ]);
        } catch (\Throwable $th) {
            http_response_code(404);
            return response()->json([
                'error' => 'Not Found'
            ], 404);
        }
        
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

        $product = Product::find($id);
        $product->update($request->input());
        return back()->with('message', 'Product Updated succesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return back()->with('message', 'Product Deleted succesfully');
    }
}
