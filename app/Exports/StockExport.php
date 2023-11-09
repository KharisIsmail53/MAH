<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Zakat;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StockExport implements FromCollection,WithHeadings
{
    protected $headers;

    public function __construct(array $headers)
    {
        $this->headers = $headers;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Zakat::orderBy('harga_beras', 'asc')->get();
    }

    public function headings(): array
    {
        return $this->headers;
    }
}
