<?php

namespace App\Http\Controllers;

use App\Golongan;
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

class GolonganController extends Controller
{
    public function index()
    {
        $golongans=Golongan::all();
        $golongans=Golongan::where('Nama_golongan',request('Nama_golongan'))->paginate(0);
        if(request()->has ('Nama_golongan'))
        {
         $golongans=Golongan::where('Nama_golongan',request('Nama_golongan'))->paginate(0);
 
        }
        else
        {
            $golongans=Golongan::paginate(3);
        }

     
        return view('golongans.index',compact('golongans'));
    }

     public function create()
    {
        $golongans=Golongan::all();
        return view('golongans.create',compact('golongans'));
    }

    public function store(Request $request)
    {
       $rules = array(
  'Kode_golongan'             => 'required|Kode_golongan|unique:golongans',       // just a normal required validation
  'Nama_golongan'            => 'required',  // required and must be unique in the ducks table
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
  return Redirect::to('golongans')
   ->withErrors($validator);

 } else {
  // validation successful ---------------------------

  // our duck has passed all tests!
  // let him enter the database

  // create the data for our duck
  $jabatans = new Duck;
  $jabatans->Kode_golongan     = Input::get('Kode_golongan');
  $jabatans->Nama_golongan    = Input::get('Nama_golongan');
  $jabatans->Besaran_uang = Hash::make(Input::get('Besaran_uang'));

  // save our duck
  $jabatans->save();

  // redirect ----------------------------------------
  // redirect our user back to the form so they can do it all over again
  return Redirect::to('golongans');

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
        $golongans=Golongan::find($id);
        return view('golongans.show',compact('golongans'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $golongans=Golongan::find($id);
        return view('golongans.edit',compact('golongans'));
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
        $golongansUpdate=Request::all();
        $golongans=Golongan::find($id);
        $golongans->update($golongansUpdate);
        return redirect('golongans');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Golongan::find($id)->delete();
        return redirect('golongans');
    }






}
