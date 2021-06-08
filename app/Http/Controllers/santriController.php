<?php

namespace App\Http\Controllers;

use App\Models\santri;
use Illuminate\Http\Request;
use Validator;
use App\Imports\santriImport;
use Maatwebsite\Excel\Facades\Excel;

class santriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = santri::get();
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
            "nisn"=>"required|unique:santri",
            "nama_santri"=>"required",
            "email_santri"=>"required|unique:santri",
            "telepon_santri"=>"required",
            "kelas_santri"=>"required",
            "perusahaan_santri"=>"required",
            "daerah_perusahaan_santri"=>"required",
            "pembimbing_id"=>"required"
        );

        $cek = Validator::make($request->all(),$rules);

        if($cek->fails()){
            return ["result"=>$cek->errors()];
        }else{
            $data = new santri;
            $data->nisn = $request->nisn;
            $data->nama_santri = $request->nama_santri;
            $data->email_santri = $request->email_santri;
            $data->telepon_santri = $request->telepon_santri;
            $data->kelas_santri = $request->kelas_santri;
            $data->perusahaan_santri = $request->perusahaan_santri;
            $data->daerah_perusahaan_santri = $request->daerah_perusahaan_santri;
            $data->pembimbing_id = $request->pembimbing_id;

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
        $data = santri::where('nisn',$id)->first();
        
        if($data){
            return ["result"=>$data];
        }else{
            return ["result"=>"Nisn tidak ditemukan"];
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
        $data = santri::where('nisn',$id)->first();
        
        if($data){
            return ["result"=>$data];
        }else{
            return ["result"=>"Nisn tidak ditemukan"];
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
        $updateEmail = false;
        $cekNisn = santri::where('nisn',$id)->first();

        if(!$cekNisn){
            return ["result"=>"Nisn tidak ditemukan"];
        }

        $rules = array(
            "nama_santri"=>"required",
            "email_santri"=>"required|email",
            "telepon_santri"=>"required",
            "kelas_santri"=>"required",
            "perusahaan_santri"=>"required",
            "daerah_perusahaan_santri"=>"required",
            "pembimbing_id"=>"required"
        );

        $cek = Validator::make($request->all(),$rules);

        if($cek->fails()){
            return $cek->errors();
        }else{
            if($request->email_santri != $cekNisn->email_santri){
                $cekEmail = santri::where('email_santri',$request->email_santri)->first();
                if(!$cekEmail){
                    $updateEmail = true;
                }else{
                    return ["result"=>["email_santri"=>["The email santri has already been taken."]]];
                }
            }

            $data = $cekNisn;
            $data->nama_santri = $request->nama_santri;
            $data->email_santri = $updateEmail == false ? $cekNisn->email_santri : $request->email_santri ;
            $data->telepon_santri = $request->telepon_santri;
            $data->kelas_santri = $request->kelas_santri;
            $data->perusahaan_santri = $request->perusahaan_santri;
            $data->daerah_perusahaan_santri = $request->daerah_perusahaan_santri;
            $data->pembimbing_id = $request->pembimbing_id;

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
        $data = santri::where('nisn',$id)->first();
        
        if($data){
            if($data->delete()){
                return ["result"=>"Berhasil Menghapus Data"];
            }else{
                return ["result"=>"Gagal Menghapus Data"];
            }
        }else{
            return ["result"=>"Nisn tidak ditemukan"];
        }
        
    }

    public function uploadExcel(Request $request)
    {
        if(!$request->file('file')){
            return ["result"=>"Harus menyertakan file"];
        }
        $data = Excel::import(new santriImport, $request->file('file')->store('temp'));
        if ($data) {
            return ["result"=>"Berhasil Mengupload Data"];
        } else {
            return ["result"=>"Gagal Mengupload Data"];
        }
    }
}
