<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;

class TransactionSortReport implements FromView
{
    use Exportable;

    public $transaction;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($transaction)
    {
        $this->transaction = $transaction;
    }
    public function view(): View
    {
        return view('transactions.export', [
            'transactions' => $this->transaction
        ]);
    }
}
