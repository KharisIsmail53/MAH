<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\RecapZakat;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\Support\Responsable;

class RekapExport implements FromCollection,WithHeadings,Responsable
{
    protected $headers;
    protected $selectedYear;
    public function __construct(array $headers,$selectedYear)
    {
        $this->headers = $headers;
        $this->selectedYear = $selectedYear;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $query = RecapZakat::query();

        // $query = AkadZakat::query();

        if (!empty($this->selectedYear)) {
            $query->where('tahun', '=', $this->selectedYear);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return $this->headers;
    }

    public function toResponse($request)
    {
        $fileName = 'Rekap_akad_zakat.xlsx';

        return Excel::download($this, $fileName);
    }

}
