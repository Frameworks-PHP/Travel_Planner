@extends('layouts.app')

@section('content')


    
	<div class="panel panel-default">
		<div class="panel-heading">
			Trip Details
		</div>
	</div>
	<div class="form-horizontal">
        <div class="form-group">
            <label class="col-sm-3 control-label">Trip name</label></br>
            <div class="col-sm-3">
				<input type="text" class="form-control" name="name" value="{{$trip->name}}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Description</label></br>
            <div class="col-sm-3">
				<input type="text" class="form-control" name="name" value="{{$trip->description}}">
            </div>
        </div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			Budgets
		</div>
	</div>
	
	 @if (isset($budgets) && count($budgets) > 0)

                <table class="table table-striped task-table">
                    <!-- Table Body -->
                    <tbody>
						@foreach ($budgets as $budget)
                            <tr>
                                <!-- Location Name -->
                                <td class="table-text">
                                    <div>{{ $budget->category }}</div>
                                </td>
								<td>
									<form action="/budgetplain/{{ $budget->id }} {{$budget->location_id}} {{$budget->trip_id}}" method="GET">
										<button>Details</button>
									</form>
								</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
	@else
		<div class="panel panel-default">
			<div class="panel-heading">
				No Budgets found.
			</div>
		</div>
    @endif
	
</br>
	<form class="form-horizontal" role="form" method="GET" action="{{ url('/') }}">
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-default">
                    <i class="fa fa-plus"></i> Home
                </button>
            </div>
        </div>
    </form> 

@endsection

