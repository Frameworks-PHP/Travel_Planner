@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <!-- Display Validation Errors -->
            @include('common.errors')
            No actual expenses yet for this budget
        </div>
    </div>
    <form class="form-horizontal" role="form" method="GET" action="/budgetshow/{{ $budgeted_id }}">

        <div class="form-group">
            <label class="col-sm-3 control-label">Actual arrive</label>
            <div class="col-sm-3">
                <input type="date" class="form-control" name="actual_arrive">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Actual depart</label>
            <div class="col-sm-3">
                <input type="date" class="form-control" name="actual_depart" >
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Amount</label>
            <div class="col-sm-3">
                <input type="number" class="form-control" name="amount" >
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
                <input type="text" class="form-control" name="category" >
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Supplier</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="supplier" >
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
                    <i class="fa fa-plus"></i> Back
                </button>
            </div>
        </div>
    </form>

@endsection