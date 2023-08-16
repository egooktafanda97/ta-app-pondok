<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseApi;
use App\Http\Controllers\Controller;
use App\Http\Requests\BeritaRequest;
use App\Models\Berita;
use App\Models\User;
use App\Service\ResponseApi as ServiceResponseApi;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class BeritaController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Berita  $dokter
     * @return \Illuminate\View\View
     */
    public function show(Berita $news)
    {
        $data = [
            "title" => "Berita",
            "result" => $news->orderBy("id", "DESC")->paginate(20)
        ];
        return view("page.Berita.show", $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll()
    {
        $dokter =  Berita::orderBy("id", "DESC")->paginate(20);
        return ServiceResponseApi::statusSuccess()->data($dokter)->json();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getId($id)
    {
        $dokter =  Berita::orderBy("id", "DESC")
            ->where("id", $id)
            ->first();
        return ServiceResponseApi::statusSuccess()->data($dokter)->json();
    }

    public function store(BeritaRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $validatedData = $request->validated();
                Berita::create($validatedData);
                Alert::success('Success', 'Berita berhasil di buat');
                return redirect()->back();
            });
        } catch (\Exception $e) {
            Alert::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function update(BeritaRequest $request, $id)
    {
        try {
            return DB::transaction(function () use ($request, $id) {
                $dokter = Berita::findOrFail($id); // Temukan resource yang spesifik berdasarkan ID
                $updateData = $request->validated();
                // Update data pada tabel dokter
                $dokter->update($updateData);
                Alert::success('Success', 'Berita berhasil di update');
                return redirect()->back();
            });
        } catch (\Exception $e) {
            Alert::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        try {
            return DB::transaction(function () use ($id) {
                $i = Berita::findOrFail($id); // Temukan resource yang spesifik berdasarkan ID
                // Hapus data pada tabel dokter
                $i->delete();

                return ServiceResponseApi::statusSuccess()->message('Resource deleted successfully.')->json();
            });
        } catch (\Exception $e) {
            return ServiceResponseApi::statusQueryError()->message($e->getMessage())->json();
        }
    }
}
