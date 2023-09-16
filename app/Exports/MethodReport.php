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



class MethodReport implements FromView
{
    use Exportable;

    public $methods;
    
    /**
     * @return \Illuminate\Support\Collection
     */
    public function __construct($methods)
    {
        $this->methods = $methods;
    }
    
    public function view(): View
    {
        return view('transactions.methods', [
            'methods' => $this->methods
        ]);
    }
}