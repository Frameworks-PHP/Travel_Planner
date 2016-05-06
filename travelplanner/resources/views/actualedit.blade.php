@extends('layouts.app')

@section('content')
    @if(Auth::check())
    <div class="panel panel-default">
        <!-- Display Validation Errors -->
        @include('common.errors')
        <div class="panel-heading">
            Actual expenses details
        </div>
    </div>
    <form class="form-horizontal" role="form" method="POST" action="/actualupdate/{{$actual->id}} {{$locationid}} {{$tripid}}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label class="col-sm-3 control-label">Actual arrive</label>
            <div class="col-sm-3">
                <input type="date" class="form-control" name="actual_arrive" value="<?php echo substr($actual->actual_arrive, 0, 10) ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Actual depart</label>
            <div class="col-sm-3">
                <input type="date" class="form-control" name="actual_depart" value="<?php echo substr($actual->actual_depart, 0, 10) ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Amount</label>
            <div class="col-sm-3">
                <input type="number" class="form-control" name="amount" value="{{ $actual->amount }}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Description</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="description" value="{{ $actual->description }}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Category</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="category" value="{{ $actual->category }}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Supplier</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="supplier" value="{{ $actual->supplier }}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Address</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="address" value="{{ $actual->address }}">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-default">
                    <i class="fa fa-plus"></i> Update
                </button>
            </div>
        </div>
    </form>

    <form class="form-horizontal" role="form" method="POST" action="/actualdestroy/{{$actual->id}} {{$locationid}} {{$tripid}}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-default">
                    <i class="fa fa-plus"></i> Delete
                </button>
            </div>
        </div>
    </form>
	<form class="form-horizontal" role="form" method="GET" action="/budgetedit/{{$actual->budgeted_id}} {{$locationid}} {{$tripid}}">
		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-6">
				<button type="submit" class="btn btn-default" >
					<i class="fa fa-plus"></i> Back
				</button>
			</div>
			</div>
		</div>
	</form>
    @endif

@endsection