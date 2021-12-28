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

	<div class="row">
		
		<div class="col-lg-12">
			<a class="btn btn-sm btn-primary mb-3" href="{{route('staff.create')}}">Add new staff</a>
			<br><br>
				@if(Session::has('success'))
				<p class="alert alert-success">{{Session::get('success')}}<button class="close" data-dismiss="aler t">&times;</button></p>
				@endif
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Basic Table</h4>
					<a class="badge badge-info" href="{{route('staff.index')}}">Published</a>
					<a class="badge badge-danger" href="{{route('staff.trash.all')}}">Trash</a>
				</div>
				<div class="card-body">
					<form action="{{route('staff.search')}}" method="POST" class="form-inline mb-3">
						@csrf
						<div class="form-group">
							<input name="search" class="form-control" type="text" placeholder="search">
						</div>
						<div class="form-group mx-2">
							<input class="btn btn-primary" type="submit" value="search">
						</div>
					</form>
					<div class="table-responsive">
						<table class="table mb-0">
							<thead>
								<tr>
									<th>Serial</th>
									<th>Name</th>
									<th>Email</th>
									<th>Cell</th>
									<th>Location</th>
									<th>Gender</th>
									<th>Status</th>
									<th>Photo</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($all_data as $data)
								<tr>
									<td>{{ $loop -> index + 1 }}</td>
									<td>{{ $data -> name }}</td>
									<td>{{ $data -> email }}</td>
									<td>{{ $data -> cell }}</td>
									<td>{{ $data -> location }}</td>
									<td>{{ $data -> gender }}</td>
									<td>
										<div class="status-toggle">
											<input type="checkbox" id="status_1" class="check" checked="">
											<label for="status_1" class="checktoggle">checkbox</label>
										</div>
									</td>
									<td><img style="width:100px;" src="{{URL::to('media/staff/')}}/{{ $data -> photo }}" alt=""></td>
									<td>
										<a class="btn btn-info" href="{{route('staff.show', $data->id)}}"><i class="fa fa-eye"></i></a>
										<a class="btn btn-warning" href="{{route('staff.edit', $data->id)}}"><i class="fa fa-edit"></i></a>
										<a class="btn btn-danger" href="{{route('staff.trash', $data->id)}}"><i class="fa fa-trash"></i></a>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>


</div>
@endsection