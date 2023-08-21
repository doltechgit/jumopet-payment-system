<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;



class MethodReport implements FromQuery, WithHeadings
{
    use Exportable;

    public $from;
    public $to;
    public $method;
    
    /**
     * @return \Illuminate\Support\Collection
     */
    public function __construct($from, $to, $method)
    {
        $this->from = $from;
        $this->to = $to;
        $this->method = $method;
    }
    public function headings(): array{
        return [
            'ID',
            'transaction ID',
            'Product ID',

        ];
    }
    public function query()
    {
        return Transaction::query()->whereBetween('created_at', [$this->from . ' 00:00:00', $this->to . ' 23:59:59'])->where('pay_method', $this->method);
    }
    
}