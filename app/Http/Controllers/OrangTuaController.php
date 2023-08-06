<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\OrangTua;
use App\Models\User;
use App\Service\DataTableFormat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrangTuaController extends Controller
{
    public function show()
    {
        return view("Page.OrangTua.show");
    }
    public function show_data()
    {
        return DataTableFormat::Call()->query(function () {
            return OrangTua::query()->with("user");
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
                'tempat_lahir' => 'nullable|string|max:255',
                'tanggal_lahir' => 'nullable|date',
                'telepon' => 'nullable|string|max:20',
                'status_perkawinan' => 'nullable|string|max:255',
                'jumlah_wali' => 'required|max:100',
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
                    'email' => $request->input('email'),
                    'password' => bcrypt($request->input('password')),
                    'role' => 'orangtua'
                ]);

                $orangtuaData = $request->except(['nama', 'email', 'password']);
                $orangtuaData['user_id'] = $user->id;
                $orangtuaData += $validator->validated();
                $orangtua = OrangTua::create($orangtuaData);
                if (!$orangtua) {
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
                'tempat_lahir' => 'sometimes|required|string',
                'tanggal_lahir' => 'sometimes|required|date',
                'telepon' => 'sometimes|required|string',
                'status_perkawinan' => 'sometimes|required|string',
                'jumlah_wali' => 'sometimes|required',
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

            // Cari orangtua berdasarkan id
            $orangtua = OrangTua::findOrFail($id);

            // Update data orangtua
            $orangtua->update($request->only([
                'nama',
                'jenis_kelamin',
                'tempat_lahir',
                'tanggal_lahir',
                'telepon',
                'status_perkawinan',
                'jumlah_wali'
            ]));

            if ($request->filled('nama')) {
                $orangtua->user->email = $request->input('nama');
            }
            // Update data user (akun) jika input tidak kosong
            if ($request->filled('email')) {
                $orangtua->user->email = $request->input('email');
            }

            if ($request->filled('password')) {
                $orangtua->user->password = bcrypt($request->input('password'));
            }

            // Simpan perubahan pada user (akun)
            $orangtua->user->save();
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
            $ot = OrangTua::find($id);
            $userDelete = User::where("id", $ot->user_id);
            $ot->delete();
            Alert::success('Success', 'Data berhasil dihapus');
            return redirect()->back();
        } catch (\Throwable $th) {
            Alert::error('Validation Error', 'fatal error!');
            return redirect()->back();
        }
    }
}