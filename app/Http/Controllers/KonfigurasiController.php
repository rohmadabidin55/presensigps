<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KonfigurasiController extends Controller
{
    public function lokasikantor(){
        $lok_kantor=DB::table('konfigurasi_lokasi')->where('id',1)->first();
        return view('konfigurasi.lokasikantor',compact('lok_kantor'));
    }

    public function updateLokasiKantor(Request $request){
        $lokasi_kantor=$request->lokasi_kantor;
        $radius=$request->radius;
        $update=DB::table('konfigurasi_lokasi')->where('id',1)->update(['lokasi_kantor'=>$lokasi_kantor,'radius'=>$radius]);
        if($update){
            return redirect()->back()->with(['success'=>'Data Lokasi Kantor Berhasil Diperbarui']);
        }else{
            return redirect()->back()->with(['error'=>'Data Lokasi Kantor Gagal Diperbarui']);
        }
    }

    public function jambelajar(){
        return view('konfigurasi.jambelajar');
    }
}
