<?php

namespace App\Http\Controllers;

use App\Exports\StockExport;
use App\Models\CurrentStock;
use App\Models\Product;
use App\Models\Stock;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stocks = Stock::all();
        return view('stocks.index', [
            'stocks' => $stocks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        return view('stocks.create', [
            'products' => $products,
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
        $product = Product::find($request->product_id);

        $request->validate([
            'quantity' => 'numeric'
        ]);
        $stock = Stock::create([
            'product_id' => $product->id,
            'prev_quantity' => $request->quantity,
            'add_quantity' => $request->add_quantity,
            'new_quantity' => $request->new_quantity,
            'user_id' => auth()->user()->id,
            'store_id' => auth()->user()->store->id
        ]);
        $stock->save();
        $product->quantity = $stock->new_quantity;
        $product->save();
        $rgb = CurrentStock::find(1);
        if (strpos($product->category->slug, 'rgb') === 0) {
            $rgb->quantity = $rgb->quantity - $stock->add_quantity;
            $rgb->save();
        }

        return back()->with('message', 'Success! Product Stock updated.');
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

    public function export()
    {
        return Excel::download(new StockExport, 'mtg_stocks.csv');
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
        //
    }
}
