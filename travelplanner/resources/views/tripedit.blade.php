@extends('layouts.app')

@section('content')
	<!-- Display Validation Errors -->
	@include('common.errors')
    <form class="form-horizontal" role="form" method="POST" action="/tripupdate/{{$trip->id}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">
            <label class="col-sm-3 control-label">Trip name</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="name" value="{{$trip->name}}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Description</label>
            <div class="col-sm-3">
                {{--<input type="text" class="form-control" name="description" value="{{$trip->description}}">--}}
                <textarea rows="3" class="form-control" name="description">{{$trip->description}}</textarea>
            </div>
        </div>

		@if (Auth::check() && (($trip->user_id === Auth::user()->id) || Auth::user()->name === 'admin'))
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-default" >
                    <i class="fa fa-plus"></i> Edit
                </button>
            </div>
        </div>
		@endif
    </form>
	<form class="form-horizontal" role="form" method="GET" action="/home">
		<div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-default" >
                    <i class="fa fa-plus"></i> Back
                </button>
            </div>
        </div>
	</form>

	<form class="form-horizontal" role="form" action="/location/{{$trip->id}}" method="GET">
		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-6">
				<button type="submit" class="btn btn-default" >
					<i class="fa fa-plus"></i> Add Budget
				</button>
			</div>
		</div>
	</form>

	<form class="form-horizontal" role="form" action="/tripdestroy/{{ $trip->id }}" method="POST">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-6">
				<button type="submit" class="btn btn-default" >
					<i class="fa fa-plus"></i> Delete
				</button>
			</div>
		</div>
	</form>

  <!-- Current locations -->
    @if (count($budgets) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Budgets of the trip
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Table Headings -->
                    <thead>
                    <th>Budget</th>
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

                            <!-- Buttons -->
							@if (Auth::check() && (($trip->user_id === Auth::user()->id) || Auth::user()->name === 'admin'))
								<td>
									<form action="/budgetedit/{{ $budget->id }} {{$budget->location_id}} {{$trip->id}}" method="GET">
										<button>Details</button>
									</form>
								</td>
								<td>
									<form action="/budgetdestroy/{{ $budget->id }} {{$budget->location_id}} {{$trip->id}}" method="POST">
										<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
										<button>Delete</button>
									</form>
								</td>
							@else
								<td colspan="2">
									<form action="/budgetshow/{{ $budget->id }} {{$budget->location_id}} {{$trip->id}}" method="GET">
										<button>Details</button>
									</form>
								</td>
							@endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection