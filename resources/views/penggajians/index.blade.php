@extends('layouts/app')
@section('content')

<h1><center>Penggajian</h1></center>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{url('penggajians/create')}}" class="btn btn-success">Create</a>
<hr>
<table class="table table-striped table-bordered table-hover">
<thead>
<tr class="bg-info">
<th>NO</th>
<th>Kode Tunjangan Pegawai</th>
<th>Jumlah Jam Lembur</th>
<th>Jumlah Uang Lembur</th>
<th>Gaji Pokok</th>
<th>Total Gaji</th>
<th>Tanggal Pengambilan</th>
<th>Status Pengambilan</th>
<th>Petugas Penerima</th>
<th colspan="3"><center>Actions</th></center>
</tr>
</thead>
<tbody>
@php
$no=1;
@endphp
@foreach($penggajians as $data)
<tr>
	<td>{{$no++}}</td>
	<td>{{$data->Tunjangan_pegawai->id}}</td>
	<td>{{$data->Lembur_pegawai->Jumlah_jam}}</td>
	<td>{{$data->Kategori_lembur->Besaran_uang * $data->Jumlah_jam}}</td>
	<td>{{$data->Gaji_pokok}}</td>
	<td>{{$data->Total_gaji}}</td>
	<td>{{$data->Tanggal_pengambilan}}</td>
	<td>{{$data->Status_pengambilan}}</td>
	<td>{{$data->Petugas_penerima}}</td>
	<td> <a href="{{url('penggajians',$data->id)}}" class="btn btn-primary">Read</a></td>
	<td> <a href="{{route('penggajians.edit',$data->id)}}" class="btn btn-warning">Update</a></td>
	<td>
	{!! Form::open(['method'=>'DELETE','route'=>['penggajians.destroy', $data->id]]) !!}

	{!! Form::Submit('Delete',['class'=>'btn btn-danger']) !!}

	{!! Form::close() !!}
	</td>
	</tr>
	@endforeach
	</tbody>
</table>
@endsection