<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\AkadZakat;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AkadZakatExport implements FromCollection,WithHeadings
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
        return AkadZakat::all();
    }

    public function headings(): array
    {
        return $this->headers;
    }
}
