<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use Carbon\Carbon;
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
        $laststartWeek = Carbon::now()->subWeek()->startOfWeek()->toDateTimeString();
        $lastendWeek = Carbon::now()->subWeek()->endOfWeek()->toDateTimeString();
        $laststartMonth = Carbon::now()->subMonth()->startOfMonth()->toDateTimeString();
        $lastendMonth = Carbon::now()->subMonth()->endOfMonth()->toDateTimeString();
        $startWeek = Carbon::now()->startOfWeek()->toDateTimeString();
        $endWeek = Carbon::now()->endOfWeek()->toDateTimeString();
        $this_week_qty = Order::whereBetween('created_at', [$startWeek, $endWeek])->where('product_id', $id)->sum('quantity');
        $last_week_qty = Order::whereBetween('created_at', [$laststartWeek, $lastendWeek])->where('product_id', $id)->sum('quantity');
        $last_month_qty = Order::whereBetween('created_at', [$laststartMonth, $lastendMonth])->where('product_id', $id)->sum('quantity');
        $today_qty = Order::where('created_at', Carbon::now()->toDateTimeString())->where('product_id', $id)->sum('quantity');
        $this_week_amt = Order::whereBetween('created_at', [$startWeek, $endWeek])->where('product_id', $id)->sum('amount');
        $last_week_amt = Order::whereBetween('created_at', [$laststartWeek, $lastendWeek])->where('product_id', $id)->sum('amount');
        $last_month_amt = Order::whereBetween('created_at', [$laststartMonth, $lastendMonth])->where('product_id', $id)->sum('amount');
        $today_amt = Order::where('created_at', Carbon::now()->toDateTimeString())->where('product_id', $id)->sum('amount');
        

        return view('products.show', [
            'product' => $product,
            'categories' => $categories,
            'this_week_qty' => $this_week_qty,
            'last_week_qty' => $last_week_qty,
            'last_month_qty' => $last_month_qty,
            'today_qty' => $today_qty,
            'this_week_amt' => $this_week_amt,
            'last_week_amt' => $last_week_amt,
            'last_month_amt' => $last_month_amt,
            'today_amt' => $today_amt
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
