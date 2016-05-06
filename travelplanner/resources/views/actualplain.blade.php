@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <!-- Display Validation Errors -->
            @include('common.errors')
            Actual expenses details
        </div>
    </div>
	<div class="form-horizontal">
        <div class="form-group">
            <label class="col-sm-3 control-label">Actual arrive</label>
            <div class="col-sm-3">
				@if (isset($actual))
					<input type="date" class="form-control" name="actual_arrive" value="<?php echo substr($actual->actual_arrive, 0, 10) ?>">
				@else
					<input type="date" class="form-control" name="actual_arrive">
				@endif
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Actual depart</label>
            <div class="col-sm-3">
			@if (isset($actual))
				<input type="date" class="form-control" name="actual_depart" value="<?php echo substr($actual->actual_depart, 0, 10) ?>" >
			@else
				<input type="date" class="form-control" name="actual_depart">
			@endif
                
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Amount</label>
            <div class="col-sm-3">
			@if (isset($actual))
				<input type="number" class="form-control" name="amount" value="{{ $actual->amount }}">
			@else
				<input type="number" class="form-control" name="amount">
			@endif
                
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Description</label>
            <div class="col-sm-3">
			@if (isset($actual))
				<input type="text" class="form-control" name="description" value="{{ $actual->description }}">
			@else
				<input type="text" class="form-control" name="description">
			@endif
                
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Category</label>
            <div class="col-sm-3">
			@if (isset($actual))
				<input type="text" class="form-control" name="category" value="{{ $actual->category }}">
			@else
				<input type="text" class="form-control" name="category">
			@endif
                
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Supplier</label>
            <div class="col-sm-3">
			@if (isset($actual))
				<input type="text" class="form-control" name="supplier" value="{{ $actual->supplier }}">
			@else
				<input type="text" class="form-control" name="supplier">
			@endif
                
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Address</label>
            <div class="col-sm-3">
			@if (isset($actual))
				<input type="text" class="form-control" name="address" value="{{ $actual->address }}">
			@else
				<input type="text" class="form-control" name="address">
			@endif
                
            </div>
        </div>
	</div>
	<form class="form-horizontal" role="form" method="GET" action="/budgetplain/{{ $budget->id }} {{$budget->location_id}} {{$budget->trip_id}}">
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-default">
                    <i class="fa fa-plus"></i> Back
                </button>
            </div>
        </div>
    </form>

@endsection