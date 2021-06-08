<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class walsan extends Model
{
    use HasFactory;
    protected $table = "walsan";

    public function santri()
    {
        return $this->belongsTo(santri::class);
    }
}
