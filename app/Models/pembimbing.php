<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pembimbing extends Model
{
    use HasFactory;
    protected $table = "pembimbing";

    public function santri()
    {
        return $this->hasMany(santri::class);
    }
}
