<?php

namespace App\Http\Controllers;
use App\Models\santri;
use App\Models\pembimbing;
use Validator;

use Illuminate\Http\Request;

class pembimbingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = pembimbing::get();
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
        $rules = array(
            "nama_pembimbing"=>"required",
            "email_pembimbing"=>"required|email|unique:pembimbing",
            "telepon_pembimbing"=>"required",
        );

        $cek = Validator::make($request->all(),$rules);

        if($cek->fails()){
            return $cek->errors();
        }else{
            $data = new pembimbing;
            $data->nama_pembimbing = $request->nama_pembimbing;
            $data->email_pembimbing = $request->email_pembimbing;
            $data->telepon_pembimbing = $request->telepon_pembimbing;

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
        $data = pembimbing::where('id',$id)->first();
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
        $data = pembimbing::where('id',$id)->first();
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
        $cekId = pembimbing::where('id',$id)->first();
        if(!$cekId){
            return ["result"=>"ID tidak ditemukan"];
        }

        $rules = array(
            "nama_pembimbing"=>"required",
            "email_pembimbing"=>"required|email",
            "telepon_pembimbing"=>"required",
        );

        $cek = Validator::make($request->all(),$rules);

        if($cek->fails()){
            return $cek->errors();
        }else{
            $data = $cekId;
            $data->nama_pembimbing = $request->nama_pembimbing;
            $data->email_pembimbing = $request->email_pembimbing;
            $data->telepon_pembimbing = $request->telepon_pembimbing;

            $result = $data->save();
            if ($result) {
                return ["result"=>"Data Berhasil Tersimpan"];
            }else{
                return ["result"=>"Data Gagal Tersimpan"];
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
        $data = pembimbing::where('id',$id)->first();
        
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
