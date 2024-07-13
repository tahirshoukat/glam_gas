<?php

namespace App\Imports;

use App\Models\Inventory;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class InventoriesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Inventory([
            'location' => $row[0],
            'name' => $row[1],
            'item_description' => $row[2],
            'uom' => $row[3],
            'closing_stock' => (int) $row[4], // Cast to integer
            'item_avg_rate' => (float) $row[5], // Cast to float
            'total_amount' => (float) $row[6], // Cast to float
        ]);
    }
}
