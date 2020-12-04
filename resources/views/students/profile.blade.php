@extends('layout.master')

@section('css')
	<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
@endsection

@section('content')

<div class="main">
	<!-- MAIN CONTENT -->
	<div class="main-content">
		<div class="container-fluid">
			<!-- Alert -->
			@if(session('sukses'))
			<div class="alert alert-success" role="alert">
				{{session('sukses')}}
			</div>
			@endif

			@if(session('error'))
			<div class="alert alert-danger" role="alert">
				{{session('error')}}
			</div>
			@endif
			<!-- Akhir Alert -->
			<div class="panel panel-profile">
				<div class="clearfix">
					<!-- LEFT COLUMN -->
					<div class="profile-left">
						<!-- PROFILE HEADER -->
						<div class="profile-header">
							<div class="overlay"></div>
							<div class="profile-main">
								<img src="{{$students->getAvatar()}}" class="img-circle" style="width: 150px" alt="Avatar">
								<h3 class="name">{{$students->nama_depan}} {{$students->nama_belakang}}</h3>
								<span class="online-status status-available">Available</span>
							</div>
							<div class="profile-stat">
								<div class="row">
									<div class="col-md-4 stat-item">
										{{$students->makul->count()}} <span>Mata Kuliah</span>
									</div>
									<div class="col-md-4 stat-item">
										{{$students->rataRataNilai()}} <span>Nilai Rata-Rata</span>
									</div>
									<div class="col-md-4 stat-item">
										2174 <span>Points</span>
									</div>
								</div>
							</div>
						</div>
						<!-- END PROFILE HEADER -->
						<!-- PROFILE DETAIL -->
						<div class="profile-detail">
							<div class="profile-info">
								<h4 class="heading">Basic Info</h4>
								<ul class="list-unstyled list-justify">
									<li>Jenis Kelamin <span>{{$students->jenis_kelamin}}</span></li>
									<li>Agama <span>{{$students->agama}}</span></li>
									<li>Alamat <span>{{$students->alamat}}</span></li>
									<li>Website <span><a href="https://www.themeineed.com">www.themeineed.com</a></span></li>
								</ul>
							</div>
							<div class="profile-info">
								<h4 class="heading">Social</h4>
								<ul class="list-inline social-icons">
									<li><a href="#" class="facebook-bg"><i class="fa fa-facebook"></i></a></li>
									<li><a href="#" class="twitter-bg"><i class="fa fa-twitter"></i></a></li>
									<li><a href="#" class="google-plus-bg"><i class="fa fa-google-plus"></i></a></li>
									<li><a href="#" class="github-bg"><i class="fa fa-github"></i></a></li>
								</ul>
							</div>
							<div class="profile-info">
								<h4 class="heading">About</h4>
								<p>Interactively fashion excellent information after distinctive outsourcing.</p>
							</div>
							<div class="text-center">
									<a href="/students/{{$students->id}}/edit" class="btn btn-primary">Edit Profile</a>
							</div>
						</div>
						<!-- END PROFILE DETAIL -->
					</div>
					<!-- END LEFT COLUMN -->
					<!-- RIGHT COLUMN -->
					<div class="profile-right">
						<!-- TABBED CONTENT -->
						<div class="custom-tabs-line tabs-line-bottom left-aligned">
							<ul class="nav" role="tablist">
								<li class="active"><a href="#tab-bottom-left1" role="tab" data-toggle="tab">Recent Activity</a></li>
								<li><a href="#tab-bottom-left2" role="tab" data-toggle="tab">Projects <span class="badge">7</span></a></li>
							</ul>
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
							  + Tambah Nilai
							</button>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade in active" id="tab-bottom-left1">
								<div class="panel">
<!-- 								<div class="panel-heading">
									<h3 class="panel-title">Striped Row</h3>
								</div> -->
								<div class="panel-body">
									<table class="table table-striped">
										<thead>
											<tr>
												<th>Kode Makul</th>
												<th>Mata Kuliah</th>
												<th>Semester</th>
												<th>Nilai</th>
												<th>Dosen</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($students->makul as $makul)
											<tr>
												<td>{{$makul->kode}}</td>
												<td>{{$makul->nama}}</td>
												<td>{{$makul->semester}}</td>
												<td>
													<a href="#" class="nilai" data-type="text" data-pk="{{$makul->id}}" data-url="/api/students/{{$students->id}}/editnilai" data-title="Ubah Nilai Mahasiswa">{{$makul->pivot->nilai}}</a>
												</td>
												<td><a href="/teachers/{{$makul->teacher_id}}/profile">{{$makul->teacher->nama}}</a></td>
												<td>
													<a href="/students/{{$students->id}}/{{$makul->id}}/deletenilai" class="btn btn-danger" onclick="return confirm('Yakin Data akan Dihapus?')">Delete</a>
												</td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
								<div class="margin-top-30 text-center" style="margin-bottom: 200px"><a href="#" class="btn btn-default">See all activity</a></div>
							</div>
							<div class="tab-pane fade" id="tab-bottom-left2">
								<div class="panel">
									<div id="chartNilai"></div>
								</div>
							</div>
						</div>
						<!-- END TABBED CONTENT -->
					</div>
					<!-- END RIGHT COLUMN -->
				</div>
			</div>
		</div>
	</div>
	<!-- END MAIN CONTENT -->
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Nilai</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/students/{{$students->id}}/addnilai" method="post" enctype="multipart/form-data">
        	{{csrf_field()}}
        	<div class="form-group">
			    <label for="makul">Pilih Mata Kuliah</label>
			    <select class="form-control" id="exampleFormControlSelect1" name="makul">
			      @foreach ($matakuliah as $mk)
			      <option value="{{$mk->id}}">{{$mk->nama}}</option>
			      @endforeach
			    </select>
			</div>
			<div class="form-group {{$errors->has('nilai') ? 'has-error' : ''}}">
			    <label for="exampleInputEmail1">Nilai</label>
			    <input type="text" class="form-control" id="exampleModalLabel" name="nilai" value="{{old('nilai')}}">
			    @if($errors->has('nilai'))
			    	<span class="help-block">{{$errors->first('nilai')}}</span>
			    @endif
			</div>
		    <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="submit" class="btn btn-primary">Simpan</button>
		    </div>
		</form>
      </div>
    </div>
  </div>
</div>

@endsection

@section('javascript')
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
	    $('.nilai').editable();
	});
</script>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript">
	Highcharts.chart('chartNilai', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Laporan Data Nilai Mahasiswa'
    },
    subtitle: {
        text: 'Source: Skawan.com'
    },
    xAxis: {
        categories: {!!json_encode($categories)!!},
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Nilai'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Nilai',
        data: {!!json_encode($data)!!}

    }]
});
</script>
@endsection