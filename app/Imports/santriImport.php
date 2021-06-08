<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\santri;

class santriImport implements ToModel
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        return new santri([
            "nisn"=>$row[0],
            "nama_santri"=>$row[1],
            "email_santri"=>$row[2],
            "telepon_santri"=>$row[3],
            "kelas_santri"=>$row[4],
            "perusahaan_santri"=>$row[5],
            "daerah_perusahaan_santri"=>$row[6],
            "pembimbing_id"=>$row[7]
        ]);
    }
}
