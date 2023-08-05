<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\Operator;
use App\Models\User;
use App\Service\DataTableFormat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OperatorController extends Controller
{
    public function show()
    {
        return view("Page.Operator.show");
    }
    public function show_data()
    {
        return DataTableFormat::Call()->query(function () {
            return Operator::query()->with("user");
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
                    'email' => $request->input('email'),
                    'password' => bcrypt($request->input('password')),
                ]);

                $operatorData = $request->except(['nama', 'email', 'password']);
                $operatorData['user_id'] = $user->id;
                $operatorData += $validator->validated();
                $operator = Operator::create($operatorData);
                if (!$operator) {
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

            // Cari operator berdasarkan operator_id
            $operator = Operator::findOrFail($id);

            // Update data operator
            $operator->update($request->only([
                'nama', 'jenis_kelamin', 'tanggal_lahir', 'alamat', 'no_telepon', 'jabatan'
            ]));

            if ($request->filled('nama')) {
                $operator->user->email = $request->input('nama');
            }
            // Update data user (akun) jika input tidak kosong
            if ($request->filled('email')) {
                $operator->user->email = $request->input('email');
            }

            if ($request->filled('password')) {
                $operator->user->password = bcrypt($request->input('password'));
            }

            // Simpan perubahan pada user (akun)
            $operator->user->save();
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
            $op = Operator::find($id);
            $userDelete = User::where("id", $op->user_id);
            $op->delete();
            Alert::success('Success', 'Data berhasil dihapus');
            return redirect()->back();
        } catch (\Throwable $th) {
            Alert::error('Validation Error', 'fatal error!');
            return redirect()->back();
        }
    }
}
