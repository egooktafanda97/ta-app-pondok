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
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Http;

class PendaftaranController extends Controller
{
    public function show()
    {
        return view("Page.Pendaftaran.show");
    }
    public function show_detail($id)
    {
        $data = $this->show_dataId($id);
        return view("Page.Pendaftaran.show_detail", $data);
    }
    public function show_update($id)
    {
        $data = $this->show_dataId($id);
        return view("Page.Pendaftaran.update", $data);
    }
    public function laporan(Request $request)
    {
        $currentYear = Carbon::now()->year;
        $nextYear = $currentYear + 1;
        $academicYear = $currentYear . '/' . $nextYear;
        $th = $request->get("tahun_ajaran");
        $status = $request->get("status");

        if (!empty($th))
            $academicYear = $th;

        $data = [
            "result" =>  Pendaftaran::with(["siswa", "OrangTua"])->where(function ($us) use ($academicYear, $status) {
                $us->where("tahun_ajaran", $academicYear)
                    ->where("status", $status);
            })
                ->orderBy("id", "desc")->get()
        ];
        return view("Page.Pendaftaran.laporan", $data);
    }
    public function show_dataId($id)
    {
        $pendaftar = Pendaftaran::with(["siswa", "OrangTua"])->where("id", $id)->first();
        $data = [
            "siswa" => [
                'Nis' => $pendaftar->siswa->nis,
                'Nama Lengkap' => $pendaftar->siswa->nama_lengkap,
                'Jenis Kelamin' => $pendaftar->siswa->jenis_kelamin,
                'Tempat Lahir' => $pendaftar->siswa->tempat_lahir,
                'Tanggal Lahir' => $pendaftar->siswa->tanggal_lahir,
                'Agama' => $pendaftar->siswa->agama,
                'Alamat Lengkap' => $pendaftar->siswa->alamat_lengkap,
                'Status Siswa' => $pendaftar->siswa->status_siswa
            ],
            "orangtua" => [
                'Nik' => $pendaftar->OrangTua->nik,
                'Nama' => $pendaftar->OrangTua->nama,
                'Jenis Kelamin' => $pendaftar->OrangTua->jenis_kelamin,
                'Tempat Lahir' => $pendaftar->OrangTua->tempat_lahir,
                'Tanggal Lahir' => $pendaftar->OrangTua->tanggal_lahir,
                'Telepon' => $pendaftar->OrangTua->telepon,
                'Alamat Lengkap' => $pendaftar->OrangTua->alamat_lengkap
            ],
            "pendaftar" => $pendaftar
        ];
        return $data;
    }
    public function show_data(Request $request)
    {
        $currentYear = Carbon::now()->year;
        $nextYear = $currentYear + 1;
        $academicYear = $currentYear . '/' . $nextYear;
        $th = $request->get("tahun_ajaran");
        $status = $request->get("status");

        if (!empty($th))
            $academicYear = $th;

        return DataTableFormat::Call()->query(function () use ($academicYear, $status) {
            return Pendaftaran::where(function ($us) use ($academicYear, $status) {
                if (!empty($academicYear))
                    $us->where("tahun_ajaran", $academicYear);
                if (!empty($status))
                    $us->where("status", $status);
            })
                ->with(["siswa", "OrangTua"]);
        })
            // ->filter(function ($query) {
            //     $query->where("jenis_kelamin", "Laki-laki");
            // })
            ->formatRecords(function ($result, $start) {
                return $result->map(function ($item, $index) use (&$start) {
                    $item['no'] = $start++;
                    $item['nis'] = $item['siswa']["nis"];
                    $item['nama'] = $item['siswa']["nama_lengkap"];
                    $item['alamat_lengkap'] = $item['siswa']["alamat_lengkap"];
                    $item['asal_sekolah'] = $item["asal_sekolah"];
                    return $item;
                });
            })
            ->Short("id")
            ->get()
            ->json();
    }

    public function form()
    {
        return view("Page.Pendaftaran.form");
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
                "status_siswa" => "active"
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
                'user_pendaftar_id' => auth()->user()->id ?? 1,
                'siswa_id' => $insSiswaSave->id,
                'orang_tua_id' => $insOrangtuaSave->id,
                'tahun_ajaran' => $request->input("tahun_ajaran") ?? "2023/2024",
                'asal_sekolah' => $request->input("asal_sekolah"),
                'metode_pendaftaran' => "operator",
                'lampiran' => $useUpload->name,
                'status' => "valid",
            ];
            if (!$insPendaftaranSave = Pendaftaran::create($pendaftaran)) {
                throw new \Exception("pastikan data anda input dengan benar dan tidak boleh kosong!");
            }

            Alert::success('Pendaftaran berhasil');
            return redirect("/register-siswa");
        } catch (\Exception $e) {
            Alert::error($e->getMessage());
            return redirect()->back();
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $use = Pendaftaran::find($id);
            $orangtua = [
                "nik" => $request->input("ortu_nik"),
                "nama" => $request->input("ortu_nama"),
                "jenis_kelamin" => $request->input("ortu_jenis_kelamin"),
                "tempat_lahir" => $request->input("ortu_tempat_lahir"),
                "tanggal_lahir" => $request->input("ortu_tanggal_lahir"),
                "telepon" => $request->input("ortu_telepon"),
                "alamat_lengkap" => $request->input("ortu_alamat_lengkap")
            ];
            $siswa = [
                "nis" => $request->input("nis"),
                "nama_lengkap" => $request->input("nama_lengkap"),
                "jenis_kelamin" => $request->input("jenis_kelamin"),
                "tempat_lahir" => $request->input("tempat_lahir"),
                "tanggal_lahir" => $request->input("tanggal_lahir"),
                "agama" => $request->input("agama"),
                "alamat_lengkap" => $request->input("alamat_lengkap")
            ];
            $use->orangTua()->update($orangtua); // Melakukan update data orang tua
            $use->siswa()->update($siswa); // Melakukan update data siswa

            $useUpload = Helper::Images($request, "lampiran", "lampiran");
            if ($useUpload->status) {
                $use->lampiran = $useUpload->name;
            }

            $use->tahun_ajaran = $request->input("tahun_ajaran") ?? "2023/2024";
            $use->asal_sekolah = $request->input("asal_sekolah");
            $use->save();
            Alert::success('Pendaftaran berhasil');
            return redirect("/register-siswa");
        } catch (\Exception $e) {
            Alert::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        try {
            $pendaftaran = Pendaftaran::find($id);

            if (!$pendaftaran) {
                throw new \Exception("tidak ada data yang anda pilih");
            }

            $pendaftaran->delete();
            $siswa = Siswa::find($pendaftaran->siswa_id);
            $siswa->delete();
            $pendaftaran->orangTua()->delete();
            Alert::success("berhasil di hapus");
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error($e->getMessage());
            return redirect()->back();
        }
    }
    public function acc($id)
    {
        try {
            $pen = Pendaftaran::find($id);
            $pen->status = "valid";
            $pen->siswa->status_siswa = "active";
            $pen->siswa->save();
            $pen->save();
            $use_sessions = \DB::table("user_connections")->where("status_connecting", true)->first();
            Http::post('http://localhost:5040/send-message', [
                "session" => $use_sessions->session_name,
                "to" => $pen->orangTua->telepon,
                "text" => "Assalamualaikum, kami informasikan kepada orangtua ananda " . $pen->siswa->nama_lengkap . " bahwa Pendaftaran di terima." 
            ]);
            Alert::success("Siswa Telah Diterima");
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error($e->getMessage());
            return redirect()->back();
        }
    }
    public  function reject($id)
    {
        try {
            $pen = Pendaftaran::find($id);
            $pen->status = "reject";
            $pen->save();
            $use_sessions = \DB::table("user_connections")->where("status_connecting", true)->first();
            Http::post('http://localhost:5040/send-message', [
                "session" => $use_sessions->session_name,
                "to" => $pen->orangTua->telepon,
                "text" => "Assalamualaikum, kami informasikan kepada orangtua ananda " . $pen->siswa->nama_lengkap . " bahwa Mohon ma'af Pendaftaran atas belum di terima."
            ]);
            Alert::success("Siswa Ditolak");
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error($e->getMessage());
            return redirect()->back();
        }
    }
}
