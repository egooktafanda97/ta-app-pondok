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

class SiswaController extends Controller
{
    public function show()
    {
        return view("Page.Siswa.show");
    }
    public function show_detail($id)
    {
        $data = $this->show_dataId($id);
        return view("Page.Siswa.show_detail", $data);
    }
    public function show_update($id)
    {
        $data = $this->show_dataId($id);
        return view("Page.Siswa.update", $data);
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
    public function show_data()
    {
        $currentYear = Carbon::now()->year;
        $nextYear = $currentYear + 1;
        $academicYear = $currentYear . '/' . $nextYear;
        return DataTableFormat::Call()->query(function () use ($academicYear) {
            return Pendaftaran::where("tahun_ajaran", $academicYear)
                ->with(["siswa", "OrangTua"]);
        })
            ->formatRecords(function ($result, $start) {
                return $result->map(function ($item, $index) use ($start) {
                    $item['no'] = $start + 1;
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
        return view("Page.Siswa.form");
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
                'metode_pendaftaran' => "mandiri",
                'lampiran' => $useUpload->name,
                'status' => "pending",
            ];
            if (!$insPendaftaranSave = Pendaftaran::create($pendaftaran)) {
                throw new \Exception("pastikan data anda input dengan benar dan tidak boleh kosong!");
            }

            Alert::success('Pendaftaran berhasil');
            return redirect("/siswa_register");
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
            return redirect("/siswa_register");
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
}
