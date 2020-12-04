@extends('layout.master')

@section('content')
<div class="main">
	<div class="main-content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-6">
					<div class="panel">
						<div class="panel-heading">
							<h3 class="panel-title">TOP 5 RANKING</h3>
						</div>
						<div class="panel-body">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>Ranking</th>
										<th>Nama</th>
										<th>Nilai</th>
									</tr>
								</thead>
								<tbody>
									@php
										$ranking=1;
									@endphp
									@foreach(ranking5Besar() as $s)
									<tr>
										<td>{{$ranking}}</td>
										<td>{{$s->nama_lengkap()}}</td>
										<td>{{$s->rataRataNilai}}</td>
									</tr>
									@php
										$ranking++;
									@endphp
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="metric">
						<span class="icon"><i class="fa fa-users"></i></span>
						<p>
							<span class="number">{{totalStudents()}}</span>
							<span class="title">Jumlah Mahasiswa</span>
						</p>
					</div>
					<div class="metric">
						<span class="icon"><i class="fa fa-users"></i></span>
						<p>
							<span class="number">{{totalTeachers()}}</span>
							<span class="title">Jumlah Dosen</span>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection