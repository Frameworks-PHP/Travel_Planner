@extends('layouts.app')

@section('content')

    @if(Auth::check())
        <div class="panel panel-default">
            <div class="panel-heading">
			<!-- Display Validation Errors -->
                @include('common.errors')
                Step 2: Add a budget to the location or add/update an Actual Expense to existing budgets
            </div>
        </div>
        <form class="form-horizontal" role="form" method="POST" action="/budgetstore/{{ $locationid }} {{ $tripid }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group">
                <label class="col-sm-3 control-label">Planned arrive</label>
                <div class="col-sm-3">
                    <input type="date" class="form-control" name="planned_arrive">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Planned depart</label>
                <div class="col-sm-3">
                    <input type="date" class="form-control" name="planned_depart">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Amount</label>
                <div class="col-sm-3">
                    <input type="number" class="form-control" name="amount">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Description</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" name="description">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Category</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" name="category">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Supplier</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" name="supplier">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Address</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" name="address">
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
		<form class="form-horizontal" role="form" method="GET" action="/location/{{ $tripid }}">
			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-6">
					<button type="submit" class="btn btn-default" >
						<i class="fa fa-plus"></i> Back
					</button>
				</div>
			</div>
		</form>

        <!-- Current locations -->
        @if (count($budgets) > 0)
            <div class="panel panel-default">
                <div class="panel-heading">
                    You may want to check the existing budgets related to the location for reference.
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
									@if (($budget->user_id === Auth::user()->id) || Auth::user()->name === 'admin'))
										<td>
											<form action="/budgetedit/{{ $budget->id }} {{ $locationid }} {{ $tripid }}" method="GET">
												<button>Details</button>
											</form>
										</td>
										@if (count($actuals) > 0)
											<?php $hasActual= 0; ?>
											@foreach ($actuals as $actual)
													@if($budget->id === $actual->budgeted_id)
														<?php $hasActual = 1; ?>
													@endif
											@endforeach
											@if($hasActual === 0)
												<td>
													<form action="/actual/{{$budget->id}} {{$locationid}} {{$tripid}}" method="GET">
														<button>Add actual expenses</button>
													</form>
												</td>
											@else
												<td>
													<form action="/actualedit/{{$budget->id}} {{$locationid}} {{$tripid}}" method="GET">
														<button>Actual expenses</button>
													</form>
												</td>
											@endif
										@endif
										<td>
											<form action="/budgetdestroy/{{ $budget->id }} {{$locationid}} {{$tripid}}" method="POST">
												<input type="hidden" name="_token" value="{{ csrf_token() }}">
												<button>Delete</button>
											</form>
										</td>
									@else
										<td>
											<form action="/budgetview/{{ $budget->id }} {{ $locationid }} {{ $tripid }}" method="GET">
												<button>Details</button>
											</form>
										</td>
										<td colspan="2">
											<form action="/actualshow/{{$budget->id}} {{$locationid}} {{$tripid}}" method="GET">
												<button>View actual</button>
											</form>
										</td>
									@endif
								</tr>
							@endforeach
						</tbody>
                    </table>
                </div>
            </div>
		@else
			<div class="panel-heading">
				Sorry, there are no existing budgets related to this location.
			</div>
		@endif
    @endif
@endsection