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
					<!-- TABLE HOVER -->
					<div class="panel">
						<div class="panel-heading">
							<h2>Daftar Mahasiswa</h2>
							<div class="right">
								<a href="/students/exportExcel" class="btn btn-primary btn-md">Cetak Excel</a>
								<a href="/students/exportPdf" class="btn btn-primary btn-md">Cetak PDF</a>
								<button type="button" class="btn" style="padding: 8px" data-toggle="modal" data-target="#exampleModal">Tambah Data <i class="lnr lnr-plus-circle"></i></button>
							</div>
						</div>
						<div class="panel-body">
							<table class="table table-hover">
								<thead class="thead-dark">
									<tr>
										<th>#</th>
										<th>Nama Depan</th>
										<th>Nama Belakang</th>
										<th>Jenis Kelamin</th>
										<th>Agama</th>
										<th>Alamat</th>
										<th>Nilai Rata-Rata</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($students as $student)
									<tr>
										<th scope="row">{{$loop->iteration}}</th>
										<td><a href="/students/{{$student->id}}/profile">{{$student->nama_depan}}</td>
										<td><a href="/students/{{$student->id}}/profile">{{$student->nama_belakang}}</td>
										<td><a href="/students/{{$student->id}}/profile">{{$student->jenis_kelamin}}</td>
										<td><a href="/students/{{$student->id}}/profile">{{$student->agama}}</td>
										<td><a href="/students/{{$student->id}}/profile">{{$student->alamat}}</td>
										<td>{{$student->rataRataNilai()}}</td>
										<td>
			    							<a href="/students/{{$student->id}}/profile" class="btn btn-warning text-white">Detail</a>
			    							<a href="/students/{{$student->id}}/delete" class="btn btn-danger" onclick="return confirm('Yakin Data akan Dihapus?')">Delete</a>
			    						</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
					<!-- END TABLE HOVER -->
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Mahasiswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/students/create" method="post" enctype="multipart/form-data">
        	{{csrf_field()}}
		  <div class="form-group {{$errors->has('nama_depan') ? 'has-error' : ''}}">
		    <label for="exampleInputEmail1">Nama Depan</label>
		    <input type="text" class="form-control" id="exampleModalLabel" name="nama_depan" value="{{old('nama_depan')}}">
		    @if($errors->has('nama_depan'))
		    	<span class="help-block">{{$errors->first('nama_depan')}}</span>
		    @endif
		  </div>
		  <div class="form-group {{$errors->has('nama_belakang') ? 'has-error' : ''}}">
		    <label for="exampleInputPassword1">Nama Belakang</label>
		    <input type="text" class="form-control" id="exampleModalLabel" name="nama_belakang" value="{{old('nama_belakang')}}">
		    @if($errors->has('nama_belakang'))
		    	<span class="help-block">{{$errors->first('nama_belakang')}}</span>
		    @endif
		  </div>
		  <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
		    <label for="exampleInputPassword1">Email</label>
		    <input type="email" class="form-control" id="exampleModalLabel" name="email" value="{{old('email')}}">
		    @if($errors->has('email'))
		    	<span class="help-block">{{$errors->first('email')}}</span>
		    @endif
		  </div>
		  <div class="form-group {{$errors->has('jenis_kelamin') ? 'has-error' : ''}}">
		    <label for="exampleFormControlSelect1">Jenis Kelamin</label>
		    <select class="form-control" id="exampleFormControlSelect1" name="jenis_kelamin">
		      <option value="L" {{(old('jenis_kelamin') == 'L') ? 'selected' : ''}}>Laki-Laki</option>
		      <option value="P" {{(old('jenis_kelamin') == 'P') ? 'selected' : ''}}>Perempuan</option>
		    </select>
		    @if($errors->has('jenis_kelamin'))
		    	<span class="help-block">{{$errors->first('jenis_kelamin')}}</span>
		    @endif
		  </div>
		  <div class="form-group {{$errors->has('agama') ? 'has-error' : ''}}">
		    <label for="exampleInputPassword1">Agama</label>
		    <input type="text" class="form-control" id="exampleModalLabel" name="agama" value="{{old('agama')}}">
		    @if($errors->has('agama'))
		    	<span class="help-block">{{$errors->first('agama')}}</span>
		    @endif
		  </div>
		  <div class="form-group">
		    <label for="exampleInputPassword1">Alamat</label>
		    <textarea class="form-control" rows="3" id="exampleModalLabel" name="alamat">{{old('alamat')}}</textarea>
		  </div>
		  <div class="form-group {{$errors->has('avatar') ? 'has-error' : ''}}">
		    <label for="exampleInputPassword1">Foto Profile</label>
		    <input type="file" name="avatar" class="form-control">
		    @if($errors->has('avatar'))
		    	<span class="help-block">{{$errors->first('avatar')}}</span>
		    @endif
		  </div>
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Akhir Modal -->

@endsection