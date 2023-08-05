<?php

namespace App\Api;

use App\Http\Controllers\Controller;
use App\Models\Operator;
use App\Models\User;
use App\Service\DataTableFormat;
use App\Service\ResponseApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OperatorController extends Controller
{

    public function show()
    {
        return DataTableFormat::Call()->query(function () {
            return Operator::query();
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
            $validator = \Validator::make($request->all(), [
                'nama' => 'required|string|max:100',
                'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan,Lainnya',
                'tanggal_lahir' => 'nullable|date',
                'alamat' => 'nullable|string|max:255',
                'no_telepon' => 'nullable|string|max:20',
                'jabatan' => 'required|string|max:100',
            ]);
            if ($validator->fails())
                return response()->json($validator->messages(), 401);


            return DB::transaction(function () use ($request, $validator) {
                $user = User::create([
                    'nama' => $request->input('nama'),
                    'email' => $request->input('email'),
                    'password' => bcrypt($request->input('password')),
                ]);

                $operatorData = $request->except(['nama', 'email', 'password']);
                $operatorData['user_id'] = $user->id;
                $operatorData += $validator->validated();
                $operator = Operator::create($operatorData);
                return response()->json(['message' => 'Operator created successfully', 'data' => $operator], 201);
            });
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = \Validator::make($request->all(), [
                'nama' => 'nullable|string|max:100',
                'jenis_kelamin' => 'nullable|in:Laki-Laki,Perempuan,Lainnya',
                'tanggal_lahir' => 'nullable|date',
                'alamat' => 'nullable|string|max:255',
                'no_telepon' => 'nullable|string|max:20',
                'jabatan' => 'nullable|string|max:100',
            ]);

            if ($validator->fails())
                return response()->json($validator->messages(), 401);

            return DB::transaction(function () use ($validator, $id) {
                $operator = Operator::findOrFail($id);
                $operator->update($validator->validated());
                return response()->json(['message' => 'Operator updated successfully', 'data' => $operator]);
            });
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }
}
