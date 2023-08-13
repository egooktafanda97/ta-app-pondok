<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\Guru;
use App\Models\User;
use App\Service\DataTableFormat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GuruController extends Controller
{
    public function show()
    {
        return view("Page.Guru.show");
    }
    public function show_data()
    {
        return DataTableFormat::Call()->query(function () {
            return Guru::query()->with("user");
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
    { {
            $validator = Validator::make($request->all(), [
                'nuptk' => 'required|string|max:100',
                'nama' => 'required|string|max:100',
                'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan,Lainnya',
                'tempat_lahir' => 'nullable|string|max:255',
                'tanggal_lahir' => 'nullable|date',
                'alamat_lengkap' => 'nullable|string|max:255',
                'jabatan' => 'required|max:100',
                'telepon' => 'nullable|string|max:20',
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
                    'role' => 'guru',
                ]);

                $guruData = $request->except(['nama', 'email', 'password']);
                $guruData['user_id'] = $user->id;
                $guruData += $validator->validated();
                $guru = Guru::create($guruData);
                if (!$guru) {
                    Alert::error('Validation Error', 'gagal menyimpan data');
                    return redirect()->back();
                }
            });
            Alert::success('Success', 'Data berhasil disimpan');
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nuptk' => 'sometimes|required|string',
                'nama' => 'sometimes|required|string',
                'jenis_kelamin' => 'sometimes',
                'tempat_lahir' => 'sometimes|required|string',
                'tanggal_lahir' => 'sometimes|required|date',
                'alamat_lengkap' => 'sometimes|required|string',
                'jabatan' => 'sometimes|required',
                'telepon' => 'sometimes|required|string',
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

            // Cari guru berdasarkan id
            $guru = Guru::findOrFail($id);

            // Update data guru
            $guru->update($request->only([
                'nama',
                'nuptk',
                'jenis_kelamin',
                'tempat_lahir',
                'tanggal_lahir',
                'alamat_lengkap',
                'jabatan',
                'telepon'
            ]));

            if ($request->filled('nama')) {
                $guru->user->email = $request->input('nama');
            }
            // Update data user (akun) jika input tidak kosong
            if ($request->filled('email')) {
                $guru->user->email = $request->input('email');
            }

            if ($request->filled('password')) {
                $guru->user->password = bcrypt($request->input('password'));
            }

            // Simpan perubahan pada user (akun)
            $guru->user->save();
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
            $g = Guru::find($id);
            $userDelete = User::where("id", $g->user_id);
            $g->delete();
            Alert::success('Success', 'Data berhasil dihapus');
            return redirect()->back();
        } catch (\Throwable $th) {
            Alert::error('Validation Error', 'fatal error!');
            return redirect()->back();
        }
    }
}
