<?php

namespace App\Http\Controllers;

use App\Exports\ClientExport;
use App\Models\Client;
use App\Models\Transaction;
use App\Models\Category;
use App\Models\Product;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $clients = Client::all();
        $categories = Category::all();
        
        return view('clients.index', [
            'clients' => $clients,
            'categories' => $categories
        ]);
    }

    public function credit()
    {

        $creditors = Transaction::where('balance', '>', 0)->pluck('client_id');

        $clients = Client::find($creditors);

        return view('clients.credit', [
            'clients' => $clients,
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::find($id);
        $categories = Category::all();
        $products = Product::all();
        $balance = $client->transactions->sum('balance');
        return view('clients.show', [
            'client' => $client,
            'categories' => $categories,
            'balance' => $balance,
            'products' => $products
        ]);
    }

    public function get_client($id)
    {
        
        $client = Client::find($id);
        $category = $client->category->price;
        if($client){
            return response()->json([
                'status' => 200,
                'client' => $client,
                'category' => $category
            ]);
        } else{
            return response()->json([
                'status' => 404,
                'error' => 'Not found'
            ]);
        }
        
    }

    public function search_client($id)
    {

        $clients = Client::where('name', 'LIKE',  "%{$id}%")->orWhere('phone', 'LIKE',"%{$id}%")->get();
        // $clients = Client::where('name', $id)->orWhere('phone', $id)->get();
        
        if (count($clients) > 0) {
            return response()->json([
                'status' => 200,
                'client' => $clients,
            ]);
        } else {
            http_response_code(404);
            return response()->json([
                'error' => 'Not Found'
            ],404);
        }
    }

    public function export()
    {
        return Excel::download(new ClientExport, 'mtg_clients.csv');
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
        // dd($request->input());
        $client = Client::find($id);

        if($client->update($request->input())){
            return back()->with('message', 'Client Details updated!');
        }else{
            return back()->with('error', 'An error occured');
        };
        
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
