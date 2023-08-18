<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\Pengasuh;
use App\Models\User;
use App\Service\DataTableFormat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PengasuhController extends Controller
{
    public function show()
    {
        return view("Page.Pengasuh.show");
    }
    public function show_data()
    {
        return DataTableFormat::Call()->query(function () {
            return Pengasuh::query()->with("user");
        })
            ->formatRecords(function ($result, $start) {
                return $result->map(function ($item, $index) use (&$start) {
                    $item['no'] = $start++;
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
                    'email' => $request->input('email'),
                    'password' => bcrypt($request->input('password')),
                    'role' => 'pengasuh'
                ]);

                $pengasuhData = $request->except(['nama', 'email', 'password']);
                $pengasuhData['user_id'] = $user->id;
                $pengasuhData += $validator->validated();
                $pengasuh = Pengasuh::create($pengasuhData);
                if (!$pengasuh) {
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
                'alamat_lengkap' => 'sometimes|required|string',
                'jabatan' => 'sometimes|required',
                'telepon' => 'sometimes|required|string',
                'email' => 'nullable', // Validasi email unik pada tabel users
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

            // Cari pengasuh berdasarkan id
            $pengasuh = Pengasuh::findOrFail($id);

            // Update data pengasuh
            $pengasuh->update($request->only([
                'nama', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'alamat_lengkap', 'jabatan', 'telepon'
            ]));

            if ($request->filled('nama')) {
                $pengasuh->user->email = $request->input('nama');
            }
            // Update data user (akun) jika input tidak kosong
            if ($request->filled('email')) {
                $pengasuh->user->email = $request->input('email');
            }

            if ($request->filled('password')) {
                $pengasuh->user->password = bcrypt($request->input('password'));
            }

            // Simpan perubahan pada user (akun)
            $pengasuh->user->save();
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
            $p = Pengasuh::find($id);
            $userDelete = User::where("id", $p->user_id);
            $p->delete();
            Alert::success('Success', 'Data berhasil dihapus');
            return redirect()->back();
        } catch (\Throwable $th) {
            Alert::error('Validation Error', 'fatal error!');
            return redirect()->back();
        }
    }
}
