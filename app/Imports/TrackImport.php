<?php

namespace App\Imports;

use App\Models\ControlTower;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use function PHPUnit\Framework\returnCallback;

class TrackImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return Model|null
    */
    public function model(array $row)
    {
        return new ControlTower([
            'vehicle_id' => $row['vehicle_id'],
            'track_id' => $row['track_id'],
            'track_type' => $row['track_type'],
            'freight' => $row['freight'],
            'eta' => $row['eta'],
        ]);
     }
}
