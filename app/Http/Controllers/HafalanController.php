<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\hafalan as Hafalan;
use App\Models\OrangTua;
use App\Models\Siswa;
use App\Service\DataTableFormat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Http;

class HafalanController extends Controller
{
    public function show($id = null)
    {
        $data["siswa"] = Siswa::where("status_siswa", "active")->get();
        $data["Juz"] = Hafalan::Juzz();
        $data["Surat"] = Hafalan::Surat();
        $data["id"] = $id;
        return view("Page.hafalan.show", $data);
    }
    public function siswa_hafalan_show($id = null)
    {
        return DataTableFormat::Call()->query(function () use ($id) {
            return Hafalan::where("siswa_id", $id)
                ->with(["guru", "siswa"]);
        })
            ->formatRecords(function ($result, $start) {
                return $result->map(function ($item, $index) use (&$start) {
                    $createdAt = Carbon::parse($item['created_at']);
                    $item['no'] = $start++;
                    $item['nama_siswa'] = $item['siswa']["nama_lengkap"];
                    $item['nama_guru'] = $item['guru']["nama"];
                    $item['juz'] = $item["juz"];
                    $item['nama_surat'] = $item["nama_surat"];
                    $item['ayat_start'] = $item["ayat_start"];
                    $item['ayat_end'] = $item["ayat_end"];
                    $item['catatan'] = $item["catatan"];
                    $item["tanggal"] = $createdAt->format('d M  Y');
                    return $item;
                });
            })
            ->Short("id")
            ->get()
            ->json();
    }
    public function store(Request $request)
    {
        try {
            $data = [
                'siswa_id' => $request->siswa_id,
                'guru_id' => Guru::whereUserId(auth()->user()->id)->first()->id,
                'juz' => $request->juz,
                'nama_surat' => $request->nama_surat,
                'ayat_start' => $request->ayat_start,
                'ayat_end' => $request->ayat_end,
                'catatan' => $request->catatan
            ];
            Hafalan::create($data);
            $siswa = Siswa::find($request->siswa_id);
            $msg = "Assalamualaikum, kami informasikan kepada orangtua " . $siswa->nama_lengkap . " update terbaru progres hafalan anada pada Juz {$request->juz} surat {$request->nama_surat} ayat {$request->ayat_start} sampai dengan $request->ayat_end";
            if (!empty($request->catatan)) {
                $msg .= " dengan catatan {$request->catatan}";
            }
            $use_sessions = \DB::table("user_connections")->where("status_connecting", true)->first();
            Http::post('http://localhost:5040/send-message', [
                "session" => $use_sessions->session_name,
                "to" => $siswa->orangTua->telepon,
                "text" => $msg
            ]);
            Alert::success('Success', 'Data berhasil disimpan');
            return redirect("hafalan/show/" . $request->siswa_id);
        } catch (\Exception $e) {
            Alert::error($e->getMessage());
            return redirect()->back();
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $hafalan = Hafalan::find($id);
            $data = [
                'siswa_id' => $request->siswa_id,
                'guru_id' => auth()->user()->id ?? 1,
                'juz' => $request->juz,
                'nama_surat' => $request->nama_surat,
                'ayat_start' => $request->ayat_start,
                'ayat_end' => $request->ayat_end,
                'catatan' => $request->catatan
            ];
            $hafalan->update($data);
            Alert::success('Success', 'Data berhasil diedit');
            return redirect("hafalan/show/" . $request->siswa_id);
        } catch (\Exception $e) {
            Alert::error($e->getMessage());
            return redirect()->back();
        }
    }
    public function destroy($id)
    {
        try {
            $hafalan = Hafalan::find($id);
            $siswaId = $hafalan->siswa->id;
            $hafalan->delete();
            Alert::success('Success', 'Data berhasil diedit');
            return redirect("hafalan/show/" . $siswaId);
        } catch (\Exception $e) {
            Alert::error($e->getMessage());
            return redirect()->back();
        }
    }
    public function laporan($id)
    {
        $data["rep"] = Hafalan::where("siswa_id", $id)
            ->with(["guru", "siswa"])->get();
        return view("Page.hafalan.report", $data);
    }
    public function show_bywali()
    {
        $orantua = OrangTua::where("user_id", auth()->user()->id)->first();
        $data = [
            "santri" => Siswa::where("orang_tua_id", $orantua->id)->first()
        ];
        return view("Page.hafalan.show_rep_wali", $data);
    }
    public function show_Id($id)
    {
        $data = [
            "santri" => Siswa::where("id", $id)->first()
        ];
        return view("Page.hafalan.show_rep_wali", $data);
    }
}
