<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;
    protected $table = 'pendaftaran';

    protected $fillable = [
        'user_pendaftar_id',
        'siswa_id',
        'orang_tua_id',
        'tahun_ajaran',
        'asal_sekolah',
        'metode_pendaftaran',
        'lampiran',
        'status'
    ];

    public function userPendaftar()
    {
        return $this->belongsTo(User::class, 'user_pendaftar_id');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function orangTua()
    {
        return $this->belongsTo(OrangTua::class, 'orang_tua_id');
    }
}
