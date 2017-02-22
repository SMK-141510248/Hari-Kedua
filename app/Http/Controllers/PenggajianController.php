<?php

namespace App\Http\Controllers;

use App\Penggajian;
use App\Lembur_pegawai;
use App\Jabatan;
use App\Kategori_lembur;
use App\Golongan;
use App\Tunjangan_pegawai;
use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Form;
use View;
use Html;
use DB;
use Alert;
use Validator;
use Input;
use Redirect;

class PenggajianController extends Controller
{
	 public function index()
    {
        $penggajians=Penggajian::all();
    $tunjangan_pegawais=Tunjangan_pegawai::all();
        $lembur_pegawais=Lembur_pegawai::all();
        $golongans=Golongan::all();
        $jabatans=Jabatan::all();
        $kategori_lemburs=Kategori_lembur::all();
        return view('penggajians.index',compact('penggajians','tunjangan_pegawais','lembur_pegawais','golongans','jabatans','kategori_lemburs'));
    }

     public function create()
    {
        $tunjangan_pegawais=Tunjangan_pegawai::all();
        $lembur_pegawais=Lembur_pegawai::all();
        $golongans=Golongan::all();
        $jabatans=Jabatan::all();
        $kategori_lemburs=Kategori_lembur::all();
     
        return view('penggajians.create',compact('tunjangan_pegawais','lembur_pegawais','golongans','jabatans','kategori_lemburs'));
    }
     public function store(Request $request)
    {
        $penggajians=Request::all();
        Tunjangan_pegawai::create($penggajians);
        return redirect('penggajians');

        
    }

}
