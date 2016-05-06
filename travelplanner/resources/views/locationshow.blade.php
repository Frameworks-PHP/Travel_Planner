@extends('layouts.app')

@section('content')

    @if(Auth::check())
        <div class="panel panel-default">
            <div class="panel-heading">
                Location Details
            </div>
        </div>
        <form class="form-horizontal" role="form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group">
                <label class="col-sm-3 control-label">Name</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" name="name" value="{{$location->name}}">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Description</label>
                <div class="col-sm-3">
                    <textarea rows="3" class="form-control" name="description">{{$location->description}}</textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">City</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" name="city" value="{{$location->city}}">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Province</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" name="province" value="{{$location->province}}">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Country Code</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" name="country_code" value="{{$location->country_code}}">
                </div>
            </div>
        </form>
		<form class="form-horizontal" role="form" method="GET" action="/location/{{ $tripid }}">
			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-6">
					<button type="submit" class="btn btn-default" >
						<i class="fa fa-plus"></i> Back
					</button>
				</div>
			</div>
		</form>
    @endif
@endsection
