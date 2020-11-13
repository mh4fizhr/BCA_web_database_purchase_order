<?php

namespace App\Imports;

use App\historydriver;
use Maatwebsite\Excel\Concerns\ToModel;

class HdriverImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new historydriver([
            //
        ]);
    }
}
