<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pimpinan extends Model
{
    use HasFactory;
    protected $table = 'pimpinan';

    protected $fillable = [
        'user_id',
        'nama',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat',
        'no_telepon',
        'jabatan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
