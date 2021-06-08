<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\santri;
use App\Models\walsan;
use Validator;

class walsanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = walsan::with('santri')->get();
        return ["result"=>$data];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            "nama_walsan"=>"required",
            "email_walsan"=>"required|email|unique:walsan",
            "telepon_walsan"=>"required",
        );

        $cek = Validator::make($request->all(),$rules);

        if($cek->fails()){
            return $cek->errors();
        }else{
            $data = new walsan;
            $data->santri_nisn = $request->santri_nisn;
            $data->nama_walsan = $request->nama_walsan;
            $data->email_walsan = $request->email_walsan;
            $data->telepon_walsan = $request->telepon_walsan;

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
        $data = walsan::where('id',$id)->with('santri')->first();
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
        $data = walsan::where('id',$id)->with('santri')->first();
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
        $cekId = walsan::where('id',$id)->first();
        if(!$cekId){
            return ["result"=>"ID tidak ditemukan"];
        }

        $cekNisn = santri::where('nisn',$request->santri_nisn)->first();
        if(!$cekNisn){
            return ["result"=>"Nisn tidak ditemukan"];
        }

        $rules = array(
            "santri_nisn"=>"required",
            "nama_walsan"=>"required",
            "email_walsan"=>"required|email",
            "telepon_walsan"=>"required",
        );

        $cek = Validator::make($request->all(),$rules);

        if($cek->fails()){
            return $cek->errors();
        }else{
            $data = $cekId;
            $data->santri_nisn = $request->santri_nisn;
            $data->nama_walsan = $request->nama_walsan;
            $data->email_walsan = $request->email_walsan;
            $data->telepon_walsan = $request->telepon_walsan;

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
        $data = walsan::where('id',$id)->first();
        
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
