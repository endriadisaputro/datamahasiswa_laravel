@extends('layout.master')

@section('content')
<div class="main">
	<div class="main-content">
		<div class="container-fluid">
			<!-- Alert -->
			@if(session('sukses'))
			<div class="alert alert-success" role="alert">
				{{session('sukses')}}
			</div>
			@endif
			<!-- Akhir Alert -->
			<div class="row">
				<div class="col-md-12">
					<div class="panel">
						<div class="panel-heading">
							<h3 class="panel-title">Inputs</h3>
						</div>
						<div class="panel-body">
							<form action="/students/{{$students->id}}/update" method="post" enctype="multipart/form-data">
				        	{{csrf_field()}}
							  <div class="form-group">
							    <label for="exampleInputEmail1">Nama Depan</label>
							    <input type="text" class="form-control" id="exampleModalLabel" name="nama_depan" value="{{$students->nama_depan}}">
							  </div>
							  <div class="form-group">
							    <label for="exampleInputPassword1">Nama Belakang</label>
							    <input type="text" class="form-control" id="exampleModalLabel" name="nama_belakang" value="{{$students->nama_belakang}}">
							  </div>
							  <div class="form-group">
							    <label for="exampleFormControlSelect1">Jenis Kelamin</label>
							    <select class="form-control" id="exampleFormControlSelect1" name="jenis_kelamin">
							      <option value="L" @if($students->jenis_kelamin == 'L') selected @endif>Laki-Laki</option>
							      <option value="P" @if($students->jenis_kelamin == 'P') selected @endif>Perempuan</option>
							    </select>
							  </div>
							  <div class="form-group">
							    <label for="exampleInputPassword1">Agama</label>
							    <input type="text" class="form-control" id="exampleModalLabel" name="agama" value="{{$students->agama}}">
							  </div>
							  <div class="form-group">
							    <label for="exampleInputPassword1">Alamat</label>
							    <textarea class="form-control" rows="3" id="exampleModalLabel" name="alamat">{{$students->alamat}}</textarea>
							  </div>
							  <div class="form-group">
							    <label for="exampleInputPassword1">Foto Profile</label>
							    <input type="file" name="avatar" class="form-control">
							  </div>
					   		<button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
					        <button type="submit" class="btn btn-primary">Simpan</button>
					  		</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop
@section('content1')
	<div class="container">
		

		<div class="row">
			<div class="col">
				<h1>Edit Data Mahasiswa</h1>	
			</div>
		</div>
		<div class="row">
			<div class="col">
				
		     </div>	      
			</div>
		</div>
	</div>
@endsection