<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jurnal extends Model
{
    use HasFactory;
    protected $table = "jurnal";

    public function santri()
    {
        return $this->belongsTo(santri::class);
    }
}
