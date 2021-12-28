@extends('admin.layouts.app')
@section('main')
<div class="content container-fluid">
					
	<!-- Page Header -->
	<div class="page-header">
		<div class="row">
			<div class="col-sm-12">
				<h3 class="page-title">Welcome Admin!</h3>
				<ul class="breadcrumb">
					<li class="breadcrumb-item active">Dashboard</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /Page Header -->
	<div class="container">
		<div class="row ">
			<div class="col-lg-4 mx-auto mt-5 mb-5 shadow">
				<div class="card">
					<img style="max-width:200px;" class="mx-auto mt-2" src="{{URL::to('media/staff/'. $staff_data -> photo)}}" alt="">
					<div class="card-body">
					<h2 class="text-center">{{$staff_data->name}}</h2>
					<p class="text-center"></p>
						<table class="table">
							<tr>
								<td>User Name</td>
								<td>{{$staff_data->uname}}</td>
							</tr>
							<tr>
								<td>Email</td>
								<td>{{$staff_data->email}}</td>
							</tr>
							<tr>
								<td>Phone Number</td>
								<td>{{$staff_data->cell}}</td>
							</tr>
						</table>
						<a class="btn btn-outline-primary mb-3" href="{{ route('staff.index') }}">Back</a>
					</div>
				</div>
			</div>
		</div>
	 </div>
@endsection