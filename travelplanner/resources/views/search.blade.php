@extends('layouts.app')

@section('content')
    <form class="form-horizontal" role="form" method="POST" action="">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">
            <label class="col-sm-3 control-label">Search Criteria</label>
        </div>
		
		<div class="form-group">
            <label class="col-sm-3 control-label">Country</label>
            <div class="col-sm-3">
			@if (isset($country))
				<input type="text" class="form-control" name="country" value= "{{ $country }}">
			@else
				<input type="text" class="form-control" name="country">
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
            <label class="col-sm-3 control-label">Travel Type</label>
            <div class="col-sm-3">
				<select class="form-control" name="travel_type">
					@if(isset($traveltype))
						<option>Choose a Traveler Type</option>
						@if($traveltype === 'Economy Traveler')
							<option value="Economy Traveler" selected>Economy Traveler</option>
						@else
							<option value="Economy Traveler">Economy Traveler</option>
						@endif
						@if($traveltype === 'Comfort Traveler')
							<option value="Comfort Traveler" selected>Comfort Traveler</option>
						@else
							<option value="Comfort Traveler">Comfort Traveler</option>
						@endif
						@if($traveltype === 'Upscale Traveler')
							<option value="Upscale Traveler" selected>Upscale Traveler</option>
						@else
							<option value="Upscale Traveler">Upscale Traveler</option>
						@endif
					@else
						<option>Choose a Traveler Type</option>
						<option value="Economy Traveler">Economy Traveler</option>
						<option value="Comfort Traveler">Comfort Traveler</option>
						<option value="Upscale Traveler">Upscale Traveler</option>
					@endif
				</select>
            </div>
        </div>
		
		<div class="form-group">
            <label class="col-sm-3 control-label">Category</label>
            <div class="col-sm-3">
			@if (isset($category))
				<input type="text" class="form-control" name="category" value= "{{ $category }}">
			@else
				<input type="text" class="form-control" name="category">
			@endif
            </div>
        </div>
		
		<div class="form-group">
            <label class="col-sm-3 control-label">Start Time</label>
            <div class="col-sm-3">
			@if (isset($starttime))
				<input type="date" class="form-control" name="starttime" value= "{{ $starttime }}">
			@else
				<input type="date" class="form-control" name="starttime">
			@endif
            </div>
        </div>
		
		<div class="form-group">
            <label class="col-sm-3 control-label">End Time</label>
            <div class="col-sm-3">
			@if (isset($endtime))
				<input type="date" class="form-control" name="endtime" value= "{{ $endtime }}">
			@else
				<input type="date" class="form-control" name="endtime">
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

	
	<div class="panel panel-default">
		<div class="panel-heading">
			Budgets Found
		</div>
	</div>
    <!-- Current Budgets -->
    @if (isset($budgets) && count($budgets) > 0)
        

            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Table Headings -->
                    <thead>
                    <th>Budgeted Expense</th>
                    <th>&nbsp;</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
						@foreach ($budgets as $budget)
                            <tr>
                                <!-- Location Name -->
                                <td class="table-text">
                                    <div>{{ $budget->category }}</div>
                                </td>
								@if (Auth::check() && (($budget->user_id === Auth::user()->id) || Auth::user()->name === 'admin'))
									<td>
										<form action="/budgetedit/{{ $budget->id }} {{$budget->location_id}} {{$budget->trip_id}}" method="GET">
											<button>Details</button>
										</form>
									</td>
									<td>
										<?php $budgeted_id= $budget->budgeted_id; ?>
										@if ( $budgeted_id > 0)
											<form action="/actualedit/{{$budget->id}} {{$budget->location_id}} {{$budget->trip_id}}" method="GET">
													<button>Actual expenses</button>
											</form>
										@else
											<form action="/actual/{{$budget->id}} {{$budget->location_id}} {{$budget->trip_id}}" method="GET">
												<button>Add actual expenses</button>
											</form>    
										@endif
									</td>
								@else
									<td colspan="2">
										<form action="/budgetplain/{{ $budget->id }} {{$budget->location_id}} {{$budget->trip_id}}" method="GET">
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
				None
			</div>
		</div>
    @endif
@endsection