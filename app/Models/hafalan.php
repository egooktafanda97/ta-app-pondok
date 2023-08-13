<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hafalan extends Model
{
    use HasFactory;
    protected $table = 'hafalan';

    protected $fillable = [
        'siswa_id',
        'guru_id',
        'juz',
        'nama_surat',
        'ayat_start',
        'ayat_end',
        'catatan',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }

    public static function Juzz()
    {
        return $juz = [
            'Juz 1',
            'Juz 2',
            'Juz 3',
            'Juz 4',
            'Juz 5',
            'Juz 6',
            'Juz 7',
            'Juz 8',
            'Juz 9',
            'Juz 10',
            'Juz 11',
            'Juz 12',
            'Juz 13',
            'Juz 14',
            'Juz 15',
            'Juz 16',
            'Juz 17',
            'Juz 18',
            'Juz 19',
            'Juz 20',
            'Juz 21',
            'Juz 22',
            'Juz 23',
            'Juz 24',
            'Juz 25',
            'Juz 26',
            'Juz 27',
            'Juz 28',
            'Juz 29',
            'Juz 30',
        ];
    }
    public static function Surat()
    {
        $namaSurat = [
            "Al-Fatiha",
            "Al-Baqarah",
            "Aali Imran",
            "An-Nisa'",
            "Al-Ma'idah",
            "Al-An'am",
            "Al-A'raf",
            "Al-Anfal",
            "At-Tawbah",
            "Yunus",
            "Hud",
            "Yusuf",
            "Ar-Ra'd",
            "Ibrahim",
            "Al-Hijr",
            "An-Nahl",
            "Al-Isra'",
            "Al-Kahf",
            "Maryam",
            "Ta-Ha",
            "Al-Anbiya'",
            "Al-Hajj",
            "Al-Mu'minun",
            "An-Nur",
            "Al-Furqan",
            "Ash-Shu'ara",
            "An-Naml",
            "Al-Qasas",
            "Al-Ankabut",
            "Ar-Rum",
            "Luqman",
            "As-Sajda",
            "Al-Ahzab",
            "Saba'",
            "Fatir",
            "Ya-Sin",
            "As-Saffat",
            "Sad",
            "Az-Zumar",
            "Ghafir",
            "Fussilat",
            "Ash-Shura",
            "Az-Zukhruf",
            "Ad-Dukhan",
            "Al-Jathiya",
            "Al-Ahqaf",
            "Az-Zariyat",
            "At-Tur",
            "An-Najm",
            "Al-Qamar",
            "Ar-Rahman",
            "Al-Waqi'a",
            "Al-Hadid",
            "Al-Mujadila",
            "Al-Hashr",
            "Al-Mumtahina",
            "As-Saff",
            "Al-Jumu'a",
            "Al-Munafiqun",
            "At-Taghabun",
            "At-Talaq",
            "At-Tahrim",
            "Al-Mulk",
            "Al-Qalam",
            "Al-Haaqqa",
            "Al-Ma'arij",
            "Nuh",
            "Al-Jinn",
            "Al-Muzzammil",
            "Al-Muddathir",
            "Al-Qiyama",
            "Al-Insan",
            "Al-Mursalat",
            "An-Naba'",
            "An-Nazi'at",
            "'Abasa",
            "At-Takwir",
            "Al-Infitar",
            "Al-Mutaffifin",
            "Al-Inshiqaq",
            "Al-Buruj",
            "At-Tariq",
            "Al-Ala",
            "Al-Ghashiyah",
            "Al-Fajr",
            "Al-Balad",
            "Ash-Shams",
            "Al-Lail",
            "Adh-Dhuha",
            "Ash-Sharh",
            "At-Tin",
            "Al-Alaq",
            "Al-Qadr",
            "Al-Bayyina",
            "Az-Zalzalah",
            "Al-Adiyat",
            "Al-Qari'a",
            "At-Takathur",
            "Al-Asr",
            "Al-Humazah",
            "Al-Fil",
            "Quraish",
            "Al-Ma'un",
            "Al-Kawthar",
            "Al-Kafirun",
            "An-Nasr",
            "Al-Masad",
            "Al-Ikhlas",
            "Al-Falaq",
            "An-Nas"
        ];
        return  $namaSurat;
    }
}
