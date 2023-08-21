<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;

class TransactionSortReport implements FromQuery
{
    use Exportable;

    public $from;
    public $to;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($from, $to)
    {
        $this->from = $from;
        $this->to = $to;
    }
    public function query()
    {
        return Transaction::query()->whereBetween('created_at', [$this->from . ' 00:00:00', $this->to . ' 23:59:59']);
    }
}
