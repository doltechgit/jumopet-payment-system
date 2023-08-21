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
            'products' => auth()->user()->products,
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
        $formData = $request->validate([
            'name' => 'nullable',
            'quantity' => 'required | numeric',
            'price' => 'required | numeric',
            'date' => 'nullable',
        ]);
        Product::create([
            'name' => $request->name,
            'category_id' => $request->category,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'user_id' => auth()->user()->id,
            'store_id' => auth()->user()->store->id
        ]);

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
        //Get Product & Category Prices
        $product = Product::find($id);
        $enduser = $product->categories[0];
        $commercial = $product->categories[1];
        $retailer = $product->categories[2];

        // Update Product Name & Prices;
        $product->update(['name' => $request->name]);
        $enduser->update(['price'=> $request->end_user]);
        $commercial->update(['price' => $request->commercial]);
        $retailer->update(['price' => $request->retailer]);


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
        //
    }
}
