<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class santri extends Model
{
    use HasFactory;
    protected $primaryKey = 'nisn';
    protected $table = "santri";
    protected $fillable = ["nisn","nama_santri","email_santri","telepon_santri","kelas_santri","perusahaan_santri","daerah_perusahaan_santri","pembimbing_id"];

    public function walsan()
    {
        return $this->hasOne(walsan::class);
    }

    public function pembimbing()
    {
        return $this->belongsTo(pembimbing::class);
    }

    public function jurnal()
    {
        return $this->hasMany(jurnal::class);
    }
}
