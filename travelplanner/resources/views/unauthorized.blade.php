@extends('layouts.app')

@section('content')

        <div class="panel panel-default">
		<!-- Display Validation Errors -->
            @include('common.errors')
            <div class="panel-heading">
                You are not the authorized user, you should not be here. Your IP and user information have been logged.
            </div>
        </div>
@endsection