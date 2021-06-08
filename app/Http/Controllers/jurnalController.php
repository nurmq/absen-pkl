<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\santri;
use App\Models\pembimbing;
use App\Models\jurnal;
use Validator;

class jurnalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = jurnal::get();
        return ["result"=>$data];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cekNisn = santri::where('nisn',$request->santri_nisn)->first();

        if(!$cekNisn){
            return ["result"=>"Nisn tidak ditemukan"];
        }

        $rules = array(
            "santri_nisn"=>"required",
            "judul_jurnal"=>"required",
            "deskripsi_jurnal"=>"required",
            "foto_dokumentasi_jurnal"=>"required"
        );

        $cek = Validator::make($request->all(),$rules);
        if($cek->fails()){
            return ["result"=>$cek->errors()];
        }else{
            $gambar = $request->file('foto_dokumentasi_jurnal');
            $response = cloudinary()->upload($gambar->getRealPath())->getSecurePath();
            
            $data = new jurnal;
            $data->santri_nisn = $request->santri_nisn;
            $data->judul_jurnal = $request->judul_jurnal;
            $data->deskripsi_jurnal = $request->deskripsi_jurnal;
            $data->foto_dokumentasi_jurnal = $response;

            $result = $data->save();
            if ($result) {
                return ["result"=>"Data Berhasil Tersimpan"];
            }else{
                return ["result"=>"Data Gagal Tersimpan"];
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = jurnal::where('id',$id)->first();
        if ($data) {
            return ["result"=>$data];
        } else {
            return ["result"=>"ID tidak ditemukan"];
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = jurnal::where('id',$id)->first();
        if ($data) {
            return ["result"=>$data];
        } else {
            return ["result"=>"ID tidak ditemukan"];
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = jurnal::where('id',$id)->first();
        if (!$data) {
            return ["result"=>"ID tidak ditemukan"];
        }

        $cekNisn = santri::where('nisn',$request->santri_nisn)->first();

        if(!$cekNisn){
            return ["result"=>"Nisn tidak ditemukan"];
        }

        $rules = array(
            "santri_nisn"=>"required",
            "judul_jurnal"=>"required",
            "deskripsi_jurnal"=>"required",
            "foto_dokumentasi_jurnal"=>"required"
        );

        $cek = Validator::make($request->all(),$rules);
        if($cek->fails()){
            return ["result"=>$cek->errors()];
        }else{
            $gambar = $request->file('foto_dokumentasi_jurnal');
            $response = cloudinary()->upload($gambar->getRealPath())->getSecurePath();
            
            $data->santri_nisn = $request->santri_nisn;
            $data->judul_jurnal = $request->judul_jurnal;
            $data->deskripsi_jurnal = $request->deskripsi_jurnal;
            $data->foto_dokumentasi_jurnal = $response;

            $result = $data->save();
            if ($result) {
                return ["result"=>"Data Berhasil Terubah"];
            }else{
                return ["result"=>"Data Gagal Terubah"];
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = jurnal::where('id',$id)->first();
        
        if($data){
            if($data->delete()){
                return ["result"=>"Berhasil Menghapus Data"];
            }else{
                return ["result"=>"Gagal Menghapus Data"];
            }
        }else{
            return ["result"=>"ID tidak ditemukan"];
        }
    }
}
