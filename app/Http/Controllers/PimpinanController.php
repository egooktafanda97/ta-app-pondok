<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\Pimpinan;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Hafalan;
use App\Service\DataTableFormat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PimpinanController extends Controller
{
    public function show()
    {
        return view("Page.Pimpinan.show");
    }
    public function show_data()
    {
        return DataTableFormat::Call()->query(function () {
            return Pimpinan::query()->with("user");
        })
            ->formatRecords(function ($result, $start) {
                return $result->map(function ($item, $index) use ($start) {
                    $item['no'] = $start + 1;
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
            $validator = Validator::make($request->all(), [
                'nama' => 'required|string|max:100',
                'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan,Lainnya',
                'tanggal_lahir' => 'nullable|date',
                'alamat' => 'nullable|string|max:255',
                'no_telepon' => 'nullable|string|max:20',
                'jabatan' => 'required|string|max:100',
            ]);
            if ($validator->fails()) {
                $errorMessages = $validator->messages();
                $message = '';
                foreach ($errorMessages->all() as $msg) {
                    $message .= $msg . ',';
                }
                Alert::error('Validation Error', $message);
                return redirect()->back();
            }

            \DB::transaction(function () use ($request, $validator) {
                $user = User::create([
                    'nama' => $request->input('nama'),
                    'username' => $request->input('username'),
                    'password' => bcrypt($request->input('password')),
                    'role' => 'pimpinan'
                ]);

                $pimpinanData = $request->except(['nama', 'username', 'password']);
                $pimpinanData['user_id'] = $user->id;
                $pimpinanData += $validator->validated();
                $pimpinan = Pimpinan::create($pimpinanData);
                if (!$pimpinan) {
                    Alert::error('Validation Error', 'gagal menyimpan data');
                    return redirect()->back();
                }
            });
            Alert::success('Success', 'Data berhasil disimpan');
            return redirect()->back();
        } catch (\Throwable $th) {
            Alert::error('Validation Error', 'fatal error!');
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nama' => 'sometimes|required|string',
                'jenis_kelamin' => 'sometimes',
                'tanggal_lahir' => 'sometimes|required|date',
                'alamat' => 'sometimes|required|string',
                'no_telepon' => 'sometimes|required|string',
                'jabatan' => 'sometimes|required|string',
                'email' => 'nullable',
                // Validasi email unik pada tabel users
                'password' => 'sometimes',
            ]);
            if ($validator->fails()) {
                $errorMessages = $validator->messages();
                $message = '';
                foreach ($errorMessages->all() as $msg) {
                    $message .= $msg . ',';
                }
                Alert::error('Validation Error', $message);
                return redirect()->back();
            }

            // Cari operator berdasarkan operator_id
            $pimpinan = Pimpinan::findOrFail($id);

            // Update data operator
            $pimpinan->update($request->only([
                'nama',
                'jenis_kelamin',
                'tanggal_lahir',
                'alamat',
                'no_telepon',
                'jabatan'
            ]));

            if ($request->filled('nama')) {
                $pimpinan->user->email = $request->input('nama');
            }
            // Update data user (akun) jika input tidak kosong
            if ($request->filled('email')) {
                $pimpinan->user->email = $request->input('email');
            }

            if ($request->filled('password')) {
                $pimpinan->user->password = bcrypt($request->input('password'));
            }

            // Simpan perubahan pada user (akun)
            $pimpinan->user->save();
            Alert::success('Success', 'Data berhasil diupdate');
            return redirect()->back();
        } catch (\Throwable $th) {
            Alert::error('Validation Error', 'fatal error!');
            return redirect()->back();
        }
    }
    public function destroy($id)
    {
        try {
            $op = Pimpinan::find($id);
            $userDelete = User::where("id", $op->user_id);
            $op->delete();
            Alert::success('Success', 'Data berhasil dihapus');
            return redirect()->back();
        } catch (\Throwable $th) {
            Alert::error('Validation Error', 'fatal error!');
            return redirect()->back();
        }
    }



    public function show_hafalan()
    {
        return view("Page.Pimpinan.Laporan_hafalan.hafalan");
    }
    public function laporan($id)
    {
        $data["rep"] = Hafalan::where("siswa_id", $id)
        ->with(["guru", "siswa"])->get();
    return view("Page.Pimpinan.Laporan_hafalan.laporan", $data);  
  }



    public function show_santri()
    {
        return DataTableFormat::Call()->query(function () {
            return Siswa::query();
        })
            ->formatRecords(function ($result, $start) {
                return $result->map(function ($item, $index) use ($start) {
                    $item['no'] = $start + 1;
                    return $item;
                });
            })
            ->Short("id")
            ->get()
            ->json();
    }
}
