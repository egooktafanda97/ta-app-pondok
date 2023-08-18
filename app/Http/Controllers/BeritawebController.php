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

class BeritaWebController extends Controller
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
        return view("website.berita", $data);
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
            return view("website.beritaview", $dokter);
        }

   
}
