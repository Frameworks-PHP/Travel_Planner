@extends('layouts.app')
@section('content')
    @if(Auth::check())
        <div class="panel panel-default">
		<!-- Display Validation Errors -->
            @include('common.errors')
            <div class="panel-heading">
                Step 1: Add a new location or choose an existing one and add a budget
            </div>
        </div>
        <form class="form-horizontal" role="form" method="POST" action="/locationstore/{{$tripid}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group">
                <label class="col-sm-3 control-label">Name</label>
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
                <label class="col-sm-3 control-label">City</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" name="city">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Province</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" name="province">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Country Code</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" name="country_code">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Next
                    </button>
                </div>
            </div>
        </form>
		<form class="form-horizontal" role="form" method="GET" action="/tripedit/{{$tripid}}">
			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-6">
					<button type="submit" class="btn btn-default" >
						<i class="fa fa-plus"></i> Back
					</button>
				</div>
			</div>
		</form>

        <!-- Current locations -->
		<div class="panel panel-default">
			<div class="panel-heading">
				Existing locations
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
					<label class="col-sm-3 control-label">City</label>
					<div class="col-sm-3">
						@if (isset($city))
							<input type="text" class="form-control" name="city" value= "{{ $city }}">
						@else
							<input type="text" class="form-control" name="city">
						@endif
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Country Code</label>
					<div class="col-sm-3">
						@if (isset($countrycode))
							<input type="text" class="form-control" name="countrycode" value= "{{ $countrycode }}">
						@else
							<input type="text" class="form-control" name="countrycode">
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
			@if (count($locations) > 0)
                <div class="panel-body">
                    <table class="table table-striped task-table">

                        <!-- Table Headings -->
                        <thead>
                        <th>Location</th>
                        <th>&nbsp;</th>
                        </thead>

                        <!-- Table Body -->
                        <tbody>
                        @foreach ($locations as $location)
                            <tr>
                                <!-- Location Name -->
                                <td class="table-text">
                                    <div>{{ $location->name }}</div>
                                </td>
                                <!-- Buttons -->
									<td>
										<form action="/locationshow/{{ $location->id }} {{$tripid}}" method="GET">
											<button>Details</button>
										</form>
									</td>
									<td colspan="2">
                                    <form action="/budget/{{$location->id}} {{$tripid}}" method="GET">
                                        <button>Add budget</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
				<script>
					window.scrollTo(0,document.body.scrollHeight);
				</script>
			@else
				<div class="panel panel-default">
					<div class="panel-heading">
						No locations found.
					</div>
				</div>
			@endif
        </div>
    @endif
@endsection