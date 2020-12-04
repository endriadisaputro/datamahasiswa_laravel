@extends('layout.master')

@section('content')

<div class="main">
	<!-- MAIN CONTENT -->
	<div class="main-content">
		<div class="container-fluid">
			
			<div class="panel panel-profile">
				<div class="clearfix">
					<!-- LEFT COLUMN -->
					<div class="profile-left">
						<!-- PROFILE HEADER -->
						<div class="profile-header">
							<div class="overlay"></div>
							<div class="profile-main">
								<img src="" class="img-circle" style="width: 150px" alt="Avatar">
								<h3 class="name">{{$teachers->nama}}</h3>
								<span class="online-status status-available">Available</span>
							</div>
						</div>
						<!-- END PROFILE HEADER -->
						<!-- PROFILE DETAIL -->
						<div class="profile-detail">
							
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
						</div>
						<!-- END PROFILE DETAIL -->
					</div>
					<!-- END LEFT COLUMN -->
					<!-- RIGHT COLUMN -->
					<div class="profile-right">
						<!-- TABBED CONTENT -->
						
						<div class="tab-content">
							<div class="tab-pane fade in active" id="tab-bottom-left1">
								<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Mata Kuliah Yang Diajar Oleh <strong>{{$teachers->nama}}</strong></h3>
								</div>
								<div class="panel-body">
									<table class="table table-striped">
										<thead>
											<tr>
												<th>Mata Kuliah</th>
												<th>Semester</th>
											</tr>
										</thead>
										<tbody>
											@foreach($teachers->makul as $makul)
											<tr>
												<td>{{$makul->nama}}</td>
												<td>{{$makul->semester}}</td>
												
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
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


@endsection
