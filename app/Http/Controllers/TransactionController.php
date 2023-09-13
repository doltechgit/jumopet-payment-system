<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use App\Models\CurrentStock;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\TransactionExport;
use App\Exports\TransactionSortReport;
use App\Exports\MethodReport;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Method;
use App\Models\Coupon;
use App\Models\Order;
use App\Notifications\TransactionNotification;
use Illuminate\Support\Facades\Notification;
use Maatwebsite\Excel\Facades\Excel;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *  
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        
            $today = date('Y-m-d', time());
            $cash = Transaction::where('pay_method', 'cash')->sum('paid');
            $cash_method = Method::where('method', 'cash')->sum('amount');
            $cash_total = $cash_method + $cash;
            $pos = Transaction::where('pay_method', 'pos')->sum('paid');
            $pos_method = Method::where('method', 'pos')->sum('amount');
            $pos_total = $pos_method + $pos;
            $transfer = Transaction::where('pay_method', 'transfer')->sum('paid');
            $transfer_method = Method::where('method', 'transfer')->sum('amount');
            $transfer_total = $transfer_method + $transfer;
            $discount = Transaction::all()->sum('discount');
            $discount_today = Transaction::whereBetween('created_at', [$today . ' 00:00:00', $today . ' 23:59:59'])->sum('discount');
            $balance =  Transaction::all()->sum('balance');
            $balance_today = Transaction::whereBetween('created_at', [$today . ' 00:00:00', $today . ' 23:59:59'])->sum('balance');
            $paid = Transaction::all()->sum('paid');
            $paid_today = Transaction::whereBetween('created_at', [$today . ' 00:00:00', $today . ' 23:59:59'])->sum('paid');
            $total = Transaction::all()->sum('price');
            $pos_today = Transaction::whereBetween('created_at', [$today . ' 00:00:00', $today . ' 23:59:59'])
                ->where('pay_method', 'pos')->sum('paid');
            $pos_method_today = Method::whereBetween('created_at', [$today . ' 00:00:00', $today . ' 23:59:59'])
            ->where('method', 'pos')->sum('amount');
            $pos_total_today = $pos_today + $pos_method_today;
            $cash_today = Transaction::whereBetween('created_at', [$today . ' 00:00:00', $today . ' 23:59:59'])
                ->where('pay_method', 'cash')->sum('paid');
            $cash_method_today = Method::whereBetween('created_at', [$today . ' 00:00:00', $today . ' 23:59:59'])
            ->where('method', 'cash')->sum('amount');
            $cash_total_today = $cash_today + $cash_method_today;
            $transfer_today = Transaction::whereBetween('created_at', [$today . ' 00:00:00', $today . ' 23:59:59'])
                ->where('pay_method', 'transfer')->sum('paid');
            $transfer_method_today = Method::whereBetween('created_at', [$today . ' 00:00:00', $today . ' 23:59:59'])
            ->where('method', 'transfer')->sum('amount');
            $transfer_total_today = $transfer_today + $transfer_method_today;
            $transactions = Transaction::all();
            return view('transactions.index', [
                'transactions' => $transactions,
                'cash' => $cash_total,
                'pos' => $pos_total,
                'discount' => $discount,
                'discount_today' => $discount_today,
                'paid' => $paid,
                'paid_today' => $paid_today,
                'balance' => $balance,
                'balance_today' => $balance_today,
                'total' => $total,
                'transfer' => $transfer_total,
                'cash_today' => $cash_total_today,
                'pos_today' => $pos_total_today,
                'transfer_today' => $transfer_total_today
            ]);
       
    }

    public function orders () {
        if (auth()->user()->roles->pluck('name')[0] == 'admin') {
            $orders = Order::all();
            $transactions = Transaction::all();
        return view('transactions.order', [
            'orders' => $orders,
            'transactions' => $transactions
        ]);
        } else {
            $store_orders = Order::where('id', auth()->user()->store->id)->get();
            $store_transactions = Transaction::where('id', auth()->user()->store->id)->get();
            return view('transactions.order', [
                'orders' => $store_orders,
                'transactions' => $store_transactions
            ]);
        }
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

       $method_amount = $request->input('method_amount', []);
        // dd($method_amount[1]);
           

       
        
        $cart_check = Cart::all()->count();

        if ($cart_check < 0 || $cart_check == 0) {
            return back()->with('error', 'Cart is empty!');
        }

        $users = User::all();
        $name = $request->name;
        $phone = $request->phone;

        if ($name == '') {
            $name = 'User_' . rand(0, 1000) . time();
        }
        if ($phone == '') {
            $phone = rand(0, 1000) . time();
        }
        if($request->exists('client_id') === false){
            $client = Client::firstOrCreate([
                'name' => $name,
                'phone' => $phone,
                'email' => $request->email,
                'address' => $request->address,
                'dob' => $request->dob,
                'store_id' =>  auth()->user()->store->id
            ]);
            $client->save();
            $client_id = $client->id;

            $transaction = Transaction::create([
                'trans_id' => $request->transaction_id,
                'user_id' => auth()->user()->id,
                'client_id' => $client_id,
                'client_name' => $client->name,
                'price' => $request->buy_price,
                'pay_method' => 'Paid',
                'discount' => $request->discount,
                'paid' => $request->paid,
                'balance' => $request->balance,
                'store_id' => auth()->user()->store->id
            ]);
            $transaction->save();
            foreach ($request->input('method', []) as $index => $method) {

                Method::create([
                    'transaction_id' => $transaction->id,
                    'method' => $method,
                    'amount' => $method_amount[$index]
                ]);
            }
        }else if($request->exists('client_id') === true){
            $client = Client::find($request->client_id);
            
            $transaction = Transaction::create([
                'trans_id' => $request->transaction_id,
                'user_id' => auth()->user()->id,
                'client_id' => $client->id,
                'client_name' => $client->name,
                'price' => $request->buy_price,
                'pay_method' => 'Paid',
                'discount' => $request->discount,
                'paid' => $request->paid,
                'balance' => $request->balance,
                'store_id' => auth()->user()->store->id
            ]);
            $transaction->save();
            foreach ($request->input('method', []) as $index => $method) {

                Method::create([
                    'transaction_id' => $transaction->id,
                    'method' => $method,
                    'amount' => $method_amount[$index]
                ]);
            }
        }
        
        
        foreach (Cart::where('user_id', auth()->user()->id)->get() as $cart) {
            $product = Product::find($cart->product_id);
            Order::create([
                'transaction_id' => $transaction->id,
                'name' => $product->name,
                'product_id' => $product->id,
                'size' => $product->size,
                'store_id' => auth()->user()->store->id,
                'unit_price' => $product->price,
                'quantity' => $cart->quantity,
                'amount' => $cart->price
            ]);
            
            $rgb = CurrentStock::find(auth()->user()->store->id);

            if (strpos($product->category->slug, 'rgb') === 0) {
                $updated_quantity = $product->quantity - $cart->quantity;
                $rgb->quantity = $rgb->quantity + $cart->quantity;
                $product->quantity = $updated_quantity;
                $product->save();
                $rgb->save();
            } else {
                $updated_quantity = $product->quantity - $cart->quantity;
                $product->quantity = $updated_quantity;
                $product->save();
            }
        }
        \App\Models\Cart::where('user_id', auth()->user()->id)->delete();
        Notification::send($users, new TransactionNotification($transaction->transaction_id));
        return redirect('transactions/' . $transaction->id)->with('message', 'Transaction Successful!');
    }

    public function client_transaction(Request $request, $id)
    {
        // dd($request->input());
        $product = Product::find($request->product);
        $users = User::all();
        $client = Client::find($id);


        if ($product->quantity == 0) {
            return back()->with('message', 'Restock, Product Quantity is low');
        }



        $transaction = Transaction::create([
            'transaction_id' => $request->transaction_id,
            'product_id' => $product->id,
            'user_id' => auth()->user()->id,
            'client_id' => $client->id,
            'quantity' => $request->buy_quantity,
            'price' => $request->buy_price,
            'pay_method' => $request->method,
            'discount' => $request->discount,
            'paid' => $request->paid,
            'balance' => $request->balance,
            'store_id' => auth()->user()->store->id
        ]);

        $updated_quantity = $product->quantity - $transaction->quantity;
        $product->quantity = $updated_quantity;
        $product->save();

        // Generate Coupon
        if (count($client->transactions) == 4 && $client->category->slug == 'end_user') {
            $code = uniqid('mtg_');
            $coupon = Coupon::create([
                'client_id' => $client->id,
                'code' => $code,
            ]);
            $coupon->save();
        }

        // Send Notification of Transaction
        Notification::send($users, new TransactionNotification($transaction->transaction_id));

        // Redirect
        return redirect('transactions/' . $transaction->id)->with('message', 'Transaction Successful!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction = Transaction::find($id);
        $orders = $transaction->orders;
        return view('transactions.show', [
            'transaction' => $transaction,
            'orders' => $orders
        ]);
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
        $transaction = Transaction::find($id);

        $transaction->paid = $transaction->paid + $request->paid;
        $transaction->balance = $transaction->balance - $request->paid;
        $transaction->save();

        return back()->with('message', 'Transaction updated!');
    }

    public function receipt_pdf($id)
    {

        $transaction = Transaction::find($id);
        $pdf = Pdf::loadView('transactions.receipt', [
            'transaction' => $transaction
        ])->setPaper('mattel', 'portrait');
        return $pdf->stream('mattel_gas_' . $transaction->transaction_id . '.pdf');
    }
    public function download_pdf($id)
    {

        $transaction = Transaction::find($id);
        $pdf = Pdf::loadView('transactions.receipt', [
            'transaction' => $transaction
        ])->setPaper('mattel', 'portrait');
        return $pdf->download('mattel_gas_' . $transaction->transaction_id . '.pdf');
    }

    public function export()
    {
        return Excel::download(new TransactionExport, 'transactions.csv');
    }

    public function generate(Request $request)
    {
        $transaction = Transaction::whereBetween('created_at', [$request->from . ' 00:00:00', $request->to . ' 23:59:59'])->get();
        return (new TransactionSortReport($transaction))->download('jt-report.csv');
    }

    public function generate_method(Request $request)
    {
        $transaction = Transaction::whereBetween('created_at', [$request->from . ' 00:00:00', $request->to . ' 23:59:59'])->where('pay_method', $request->method)->get();
        return (new MethodReport($transaction))->download('jt-' . $request->method . '.csv');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction = Transaction::find($id);
        $product = Product::find(1);

        $renew_quantity = $product->quantity + $transaction->quantity;
        $product->quantity = $renew_quantity;
        $product->save();

        $transaction->delete();

        return back()->with('message', 'Transaction deleted');
    }
}
