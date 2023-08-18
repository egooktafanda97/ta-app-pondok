<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\OrangTua;
use App\Models\Pendaftaran;
use App\Models\Siswa;
use App\Models\User;
use App\Service\DataTableFormat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

class WebsiteController extends Controller
{
    public function index()
    {
        return view('website.index');
    }
    public function about()
    {
        return view('website.berita');
    }
    public function newspapper()
    {
        return view('website.tentang');
    }
    public function form()
    {
        return view("website.pendaftaran");
    }
    public function tentang()
    {
        return view("website.tentang");
    }
    public function kontak()
    {
        return view("website.kontak");
    }

    public function store(Request $request)
    {

        try {
            $ortuUser = User::create([
                'nama' => $request->input('ortu_nama'),
                'username' => $request->input('ortu_nik'),
                'password' => bcrypt($request->input('ortu_nik')),
                'role' => 'orangtua'
            ]);
            $orangtua = [
                "user_id" => $ortuUser->id,
                "nik" => $request->input("ortu_nik"),
                "nama" => $request->input("ortu_nama"),
                "jenis_kelamin" => $request->input("ortu_jenis_kelamin"),
                "tempat_lahir" => $request->input("ortu_tempat_lahir"),
                "tanggal_lahir" => $request->input("ortu_tanggal_lahir"),
                "telepon" => $request->input("ortu_telepon"),
                "alamat_lengkap" => $request->input("ortu_alamat_lengkap")
            ];

            if (!$insOrangtuaSave = OrangTua::create($orangtua)) {
                throw new \Exception("pastikan data anda input dengan benar dan tidak boleh kosong!");
            }

            $siswaUser = User::create([
                'nama' => $request->input('nama_lengkap'),
                'username' => $request->input('nis'),
                'password' => bcrypt($request->input('nis')),
                'role' => 'siswa'
            ]);
            $siswa = [
                "user_id" => $siswaUser->id,
                "orang_tua_id" => $insOrangtuaSave->id,
                "nis" => $request->input("nis"),
                "nama_lengkap" => $request->input("nama_lengkap"),
                "jenis_kelamin" => $request->input("jenis_kelamin"),
                "tempat_lahir" => $request->input("tempat_lahir"),
                "tanggal_lahir" => $request->input("tanggal_lahir"),
                "agama" => $request->input("agama"),
                "alamat_lengkap" => $request->input("alamat_lengkap"),
                "status_siswa" => "inActive"
            ];

            // dd($siswa, $orangtua);
            if (!$insSiswaSave = Siswa::create($siswa)) {
                throw new \Exception("pastikan data anda input dengan benar dan tidak boleh kosong!");
            }
            $useUpload = Helper::Images($request, "lampiran", "lampiran");
            if (!$useUpload->status) {
                throw new \Exception("Opss! lampiran harus di isi");
            }


            $pendaftaran = [
                'siswa_id' => $insSiswaSave->id,
                'orang_tua_id' => $insOrangtuaSave->id,
                'tahun_ajaran' => $request->input("tahun_ajaran") ?? "2023/2024",
                'asal_sekolah' => $request->input("asal_sekolah"),
                'metode_pendaftaran' => "Daftar mandiri",
                'lampiran' => $useUpload->name,
                'status' => "pending",
            ];
            if (!$insPendaftaranSave = Pendaftaran::create($pendaftaran)) {
                throw new \Exception("pastikan data anda input dengan benar dan tidak boleh kosong!");
            }
            $use_sessions = \DB::table("user_connections")->where("status_connecting", true)->first();

            Http::post('http://localhost:5040/send-message', [
                "session" => $use_sessions->session_name,
                "to" => $request->input("ortu_telepon"),
                "text" => "ananda " . $request->input("nama_lengkap") . " berhasil di daftarkan, tunggu validasi data dari operator sekolah untuk tindak lanjut perndaftaran anda."
            ]);
            Alert::success('Data terdaftarkan !');
            return redirect("/");
        } catch (\Exception $e) {
            Alert::error($e->getMessage());
            return redirect()->back();
        }
    }
}
