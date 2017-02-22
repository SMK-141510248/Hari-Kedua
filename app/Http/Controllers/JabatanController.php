<?php

namespace App\Http\Controllers;
use App\Jabatan;
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

class JabatanController extends Controller
{
     
    
    public function index()
    {
        $jabatans=Jabatan::all();
         $jabatans=Jabatan::where('Nama_jabatan',request('Nama_jabatan'))->paginate(0);
        if(request()->has ('Nama_jabatan'))
        {
         $jabatans=Jabatan::where('Nama_jabatan',request('Nama_jabatan'))->paginate(0);
 
        }
        else
        {
            $jabatans=Jabatan::paginate(3);
        }

     
        return view('jabatans.index',compact('jabatans'));
    }

     public function create()
    {
        $jabatans=Jabatan::all();
        return view('jabatans.create',compact('jabatans'));

}

    public function store(Request $request)
    {
   
$rules = array(
  'Kode_jabatan'             => 'required|Kode_jabatan|unique:jabatans',       // just a normal required validation
  'Nama_jabatan'            => 'required',  // required and must be unique in the ducks table
  'Besaran_uang'         => 'required',
 
 );

 // do the validation ----------------------------------
 // validate against the inputs from our form
 $validator = Validator::make(Input::all(), $rules);

 // check if the validator failed -----------------------
 if ($validator->fails()) {

  // get the error messages from the validator
  $messages = $validator->messages();

  // redirect our user back to the form with the errors from the validator
  return Redirect::to('jabatans')
   ->withErrors($validator);

 } else {
  // validation successful ---------------------------

  // our duck has passed all tests!
  // let him enter the database

  // create the data for our duck
  $jabatans = new Jabatan;
  $jabatans->Kode_jabatan     = Input::get('Kode_jabatan');
  $jabatans->Nama_jabatan    = Input::get('Nama_jabatan');
  $jabatans->Besaran_uang = Hash::make(Input::get('Besaran_uang'));

  // save our duck
  $jabatans->save();

  // redirect ----------------------------------------
  // redirect our user back to the form so they can do it all over again
  return Redirect::to('jabatans');

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
        $jabatans=Jabatan::find($id);
        return view('jabatans.show',compact('jabatans'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jabatans=Jabatan::find($id);
        return view('jabatans.edit',compact('jabatans'));
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
         $jabatansUpdate=Request::all();
        $jabatans=Jabatan::find($id);
        $jabatans->update($jabatansUpdate);
        return redirect('jabatans');

             $mm=['Kode_jabatan'=>'required|unique:Jabatan',
        'Nama_jabatan'=>'required',
        'Besaran_uang'=>'required|numeric|min:0'];

        $ds=['Kode_jabatan.required'=>'Tidak Boleh Kosong',
        'Kode_jabatan.unique'=>'Tidak Boleh Kosong',
        'Nama_jabatan.required'=>'Tidak Boleh Kosong',
        'Besaran_uang.required'=>'Tidak Boleh Kosong',
        'Besaran_uang.numeric'=>'Tidak Boleh Kosong',
        'Besaran_uang.min:0'=>'min:0',
        ];

        $ya=Validator::make(Input::all(),$mm,$ds);
        if($ya->fails()) {
            return redirect('jabatans/create')->withErrors($ya)->withInput();


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
        Jabatan::find($id)->delete();
        return redirect('jabatans');
    }


}
