<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengasuh extends Model
{
    use HasFactory;
    protected $table = 'pengasuh';

    protected $fillable = [
        'user_id',
        'nama',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat_lengkap',
        'jabatan',
        'telepon',
       
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
