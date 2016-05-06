<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

use App\Trip;
use App\Location;
use App\BudgetedExpense;
use App\ActualExpense;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class APIController extends Controller {
	
	// returns all the trips in the database
	public function trips()
	{
		$trips = Trip::orderBy('created_at', 'asc')->get();
		return response()->json($trips);
	}

	/**
	 * 
	 *
	 * @return Response
	 */
	public function byuser(Request $request){
		//check credentials
		$credentials = $request->only('email', 'password');
		//logs in for single request
		$valid = Auth::once($credentials);
		
		if(!$valid)
			return response()->json(['error' => 'invalid_credentials'], 401);
		else {
			$trips = Trip::where('user_id', '=', Auth::user()->id)->orderBy('created_at', 'desc')->get();	
			return response()->json($trips, 200);
		}
	}
	
	/**
	 * Gets all relevant information from the database based on the user credentials.
	 * Synchronizes data with our android application
	 *
	 */
	public function synchronize(Request $request){
		//check credentials
		$credentials = $request->only('email', 'password');
		//logs in for single request
		$valid = Auth::once($credentials);
		
		if(!$valid)
			return response()->json(['error' => 'invalid_credentials'], 401);
		else {
			$id = Auth::user()->id;
			$data = DB::table('trips AS tr')->where('tr.user_id', '=', $id)
				->leftjoin('budgeted_expenses AS be', 'be.trip_id', '=', 'tr.id')
				->leftjoin('actual_expenses AS ae', 'ae.budgeted_id', '=', 'be.id')
				->leftjoin('locations AS lo', 'lo.id', '=', 'be.location_id')
				->select('tr.id AS t_id', 'tr.name AS t_name', 'tr.description AS t_description', 'tr.created_at AS t_created_at', 'tr.updated_at AS t_updated_at', 'tr.closed_at AS t_closed_at',
					'be.id AS b_id', 'be.location_id AS b_location_id', 'be.trip_id AS b_trip_id', 'be.amount AS b_amount', 'be.description AS b_description', 'be.category AS b_category',
						'be.supplier AS b_supplier', 'be.address AS b_address', 'be.created_at AS b_created_at', 'be.updated_at AS b_updated_at', 'be.planned_arrive AS b_planned_arrive', 'be.planned_depart AS b_planned_depart',
					'ae.id AS a_id', 'ae.budgeted_id AS a_budgeted_id', 'ae.amount AS a_amount', 'ae.description AS a_description', 'ae.category AS a_category',
						'ae.supplier AS a_supplier', 'ae.address AS a_address', 'ae.created_at AS a_created_at', 'ae.updated_at AS a_updated_at', 'ae.actual_arrive AS a_actual_arrive', 'ae.actual_depart AS a_actual_depart',
					'lo.id AS l_id', 'lo.name AS l_name', 'lo.description AS l_description', 'lo.city AS l_city', 'lo.province AS l_province', 'lo.country_code AS l_country_code')
				->get();

			return response()->json($data, 200);
		}
	}
	
	// returns all the locations in the database
	public function locations(){
		$locations = Location::orderBy('id', 'asc')->get();
		return response()->json($locations);
	}
	
	// returns all burdgeted expenses
	public function budgeted(){
		$budgetedExpenses = BudgetedExpense::orderBy('id', 'asc')->get();
		return response()->json($budgetedExpenses);
	}
	
	// returns all actual expenses
	public function actual(){
		$actualExpenses = ActualExpense::orderBy('id', 'asc')->get();
		return response()->json($actualExpenses);
	}
}