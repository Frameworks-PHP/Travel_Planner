@extends('layouts.app')

@section('content')

        <div class="panel panel-default">
            <div class="panel-heading">
                <!-- Display Validation Errors -->
                @include('common.errors')
                Budget details
            </div>
        </div>
		<div class="form-horizontal">
            <div class="form-group">
                <label class="col-sm-3 control-label">Location</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" name="location" value="{{ $location->name }}">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Planned arrive</label>
                <div class="col-sm-3">
                    <input type="date" class="form-control" name="planned_arrive" value="<?php echo substr($budget->planned_arrive, 0, 10) ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Planned depart</label>
                <div class="col-sm-3">
                    <input type="date" class="form-control" name="planned_depart" value="<?php echo substr($budget->planned_depart, 0, 10) ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Amount</label>
                <div class="col-sm-3">
                    <input type="number" class="form-control" name="amount" value="{{ $budget->amount }}">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Description</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" name="description" value="{{ $budget->description }}">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Category</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" name="category" value="{{ $budget->category }}">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Supplier</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" name="supplier" value="{{ $budget->supplier }}">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Address</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" name="address" value="{{ $budget->address }}">
                </div>
            </div>
		</div>
		<form class="form-horizontal" role="form" method="GET" action="/actualshow/{{ $budget->id }}">
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Actual expense
                    </button>
                </div>
            </div>
        </form>
		<form class="form-horizontal" role="form" method="GET" action="/tripedit/{{ $budget->trip_id }}">
			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-6">
					<button type="submit" class="btn btn-default">
						<i class="fa fa-plus"></i> Back
					</button>
				</div>
			</div>
		</form>

@endsection