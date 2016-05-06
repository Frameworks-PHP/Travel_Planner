@extends('layouts.app')

@section('content')
	@if(Auth::check())
    <form class="form-horizontal" role="form" method="POST" action="/trip">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">
            <label class="col-sm-3 control-label">Trip name</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="name">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Description</label>
            <div class="col-sm-3">
                <textarea rows="3" class="form-control" name="description"></textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-default">
                    <i class="fa fa-plus"></i> Add a new trip
                </button>
            </div>
        </div>
    </form>
	@endif

    <!-- Current Tasks -->
	<div class="panel panel-default">
		<div class="panel-heading">
			Current Trips
		</div>

		<form class="form-horizontal" role="form" method="POST" action="">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="type" value="search">
			<div class="form-group">
				<label class="col-sm-3 control-label">Search Criteria</label>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Name</label>
				<div class="col-sm-3">
					@if (isset($name))
						<input type="text" class="form-control" name="name" value= "{{ $name }}">
					@else
						<input type="text" class="form-control" name="name">
					@endif
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">Description</label>
				<div class="col-sm-3">
					@if (isset($name))
						<input type="text" class="form-control" name="description" value= "{{ $description }}">
					@else
						<input type="text" class="form-control" name="description">
					@endif
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-6">
					<button type="submit" class="btn btn-default">
						<i class="fa fa-plus"></i> Search
					</button>
				</div>
			</div>
		</form>
		<table>
			<tr>
				<td>
					<form class="form-horizontal" role="form" method="POST" action="">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="type" value="all">
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-6">
								<button type="submit" class="btn btn-default">
									<i class="fa fa-plus"></i> All Trips
								</button>
							</div>
						</div>
					</form>
				</td>
				@if (Auth::check())
				<td>
					<form class="form-horizontal" role="form" method="POST" action="">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="type" value="user">
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-6">
								<button type="submit" class="btn btn-default">
									<i class="fa fa-plus"></i> Your Trips
								</button>
							</div>
						</div>
					</form>
				</td>
				@endif
			</tr>
		</table>
	</div>
	@if (count($trips) > 0)		
		<div class="panel-body">
			<table class="table table-striped task-table">

				<!-- Table Headings -->
				<thead>
				<th>Trip</th>
				<th>&nbsp;</th>
				</thead>

				<!-- Table Body -->
				<tbody>
				@foreach ($trips as $trip)
					<tr>
						<!-- Task Name -->
						<td class="table-text">
							<div>{{ $trip->name }}</div>
						</td>
						
						<!-- Buttons -->
						@if (Auth::check() && (($trip->user_id === Auth::user()->id) || Auth::user()->name === 'admin'))
						
						<td>
							<form action="/tripedit/{{ $trip->id }}" method="GET">
								<button>Details</button>
							</form>
						</td>
						<td>
							<form action="/location/{{$trip->id}}" method="GET">
								<button>Add budget</button>
							</form>
						</td>
						<td>
							<form action="/tripdestroy/{{ $trip->id }}" method="POST">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<button>Delete</button>
							</form>
						</td>
						@else
						<td colspan="3">
							<form action="/tripshow/{{ $trip->id }}" method="GET">
								<button>Details</button>
							</form>
						</td>
						@endif
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	@else
		<div class="panel panel-default">
            <div class="panel-heading">
                You currently have no trips.
            </div>
        </div>
	@endif
@endsection