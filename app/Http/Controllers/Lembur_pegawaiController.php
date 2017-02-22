<?php

namespace App\Http\Controllers;

use App\Kategori_lembur;
use App\Pegawai;
use App\Lembur_pegawai;
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

class Lembur_pegawaiController extends Controller
{


     public function index()
    {
        $kategori_lemburs=Kategori_lembur::all();
        $pegawais=Pegawai::all();
        $lembur_pegawais=Lembur_pegawai::all();
        $lembur_pegawais=Lembur_pegawai::where('Kode_lembur_id',request('Kode_lembur_id'))->paginate(0);
        if(request()->has ('Kode_lembur_id'))
        {
         $lembur_pegawais=Lembur_pegawai::where('Kode_lembur_id',request('Kode_lembur_id'))->paginate(0);
 
        }
        else
        {
            $lembur_pegawais=Lembur_pegawai::paginate(3);
        }
        return view('lembur_pegawais.index',compact('kategori_lemburs','pegawais','lembur_pegawais'));
    }
     public function create()
    {
        $kategori_lemburs=Kategori_lembur::all();
        $pegawais=Pegawai::all();
        return view('lembur_pegawais.create',compact('kategori_lemburs','pegawais'));
    }

    public function store(Request $request)
    {
        $rules = array(
  'Kode_lembur_id'=> 'required|Kode_lembur_id|unique:lembur_pegawais',   
  'pegawai_id' => 'required',  
  'Jumlah_jam' => 'required', 
   'Besaran_uang'=> 'required',
 
 );


 $validator = Validator::make(Input::all(), $rules);

 // check if the validator failed -----------------------
 if ($validator->fails()) {

 
  $messages = $validator->messages();

 
  return Redirect::to('lembur_pegawais')
   ->withErrors($validator);

 } else {
 
  $lembur_pegawais = new Duck;
  $lembur_pegawais->Kode_lembur_id     = Input::get('Kode_lembur_id');
  $lembur_pegawais->pegawai_id    = Input::get('pegawai_id');
   $lembur_pegawais->Jumlah_jam    = Input::get('Jumlah_jam');
  $lembur_pegawais->Besaran_uang = Hash::make(Input::get('Besaran_uang'));

 
 
  $lembur_pegawais->save();

 
  return Redirect::to('lembur_pegawais');

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
         $lembur_pegawais=Lembur_pegawai::find($id);
         $kategori_lemburs=Kategori_lembur::find($id);
        $pegawais=Pegawai::find($id);
        return view('lembur_pegawais.show',compact('lembur_pegawais','kategori_lemburs','pegawais'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lembur_pegawais=Lembur_pegawai::find($id);
        $kategori_lemburs=Kategori_lembur::all();
        $pegawais=Pegawai::all();
        return view('lembur_pegawais.edit',compact('lembur_pegawais','kategori_lemburs','pegawais'));
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
        $lembur_pegawaisUpdate=Request::all();
        $lembur_pegawais=Lembur_pegawai::find($id);
        $lembur_pegawais->update($lembur_pegawaisUpdate);
        return redirect('lembur_pegawais');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Lembur_pegawai::find($id)->delete();
        return redirect('lembur_pegawais');
    }



}

