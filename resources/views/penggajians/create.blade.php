@extends('layout/app')
@section('content')



 <h1><center>Create Penggajian</h1></center>
    {!! Form::open(['url' => 'penggajians']) !!}

     <div class="form-group">
        {!! Form::label('Kode Tunjangan Pegawai', 'Kode Tunjangan Pegawai:') !!}
    </div>
      <select class="form-control" name="tunjangan_pegawai_id"><option>--Pilih Kode Tunjangan Pegawai--</option>
            @foreach($tunjangan_pegawais as $data)
                <option value="{{$data->id}}">{{$data->tunjangans->Kode_tunjangan}}</option>
            @endforeach
            </select>
         <div class="form-group">
        {!! Form::label('Gaji Pokok', 'Gaji Pokok:') !!}
        {!! Form::text('Gaji_pokok',null,['class'=>'form-control']) !!}
    </div>
    </select>
         <div class="form-group">
        {!! Form::label('Total Gaji', 'Total Gaji:') !!}
        {!! Form::text('Total_gaji',null,['class'=>'form-control']) !!}
    </div>
         <div class="form-group">
        {!! Form::label('Tanggal Pengambilan', 'Tanggal Pengambilan:') !!}
        {!! Form::date('Tanggal_pengambilan',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('Status Pengambilan', 'Status Pengambilan:') !!}
        {!! Form::text('Status_pengambilan',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('Petugas Penerima', 'Petugas Penerima:') !!}
        {!! Form::text('Petugas_Penerima',null,['class'=>'form-control']) !!}
    </div>


    <div class="form-group">
        {!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}
    </div>
    {!! Form::close() !!}
    @stop