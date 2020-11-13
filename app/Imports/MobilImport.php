<?php

namespace App\Imports;

use App\Mobil;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class MobilImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Mobil([
            'KodeMobil' => $row[1],
            'MerekMobil' => $row[2],
            'Tahun' => $row[4],
            'Type' => $row[3]
        ]);
    }

    public function sheets(): array
    {
        return [
            0 => $this,
        ];
    }

    public function startRow(): int
    {
        return 6;
    }
}
