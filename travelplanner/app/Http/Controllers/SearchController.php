<?php namespace App\Http\Controllers;

use App\BudgetedExpense;
use App\Location;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class SearchController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('search');
	}

	/**
	 * Display the specified resource for searching through all the budgets.
	 *
	 * @return Response
	 */
	public function search(Request $request)
	{
		$this->validate($request,
				['country' => 'max:100',
				'city' => 'max:255',
				'travel_type' => 'max:255',
				'category' => 'max:255'
//				'starttime' => '',
//				'endtime' => ''
				]);
		$category = $request->category;
		$country = $request->country;
		$city = $request->city;
		$start = $request->starttime;
		$end = $request->endtime;
		if(!empty($start)){
			$starttime = date_create($request->starttime);
			$starttime = date_format($starttime, "Y/m/d H:i:s");
		}
		if(!empty($end)){
			$endtime = date_create($request->endtime);
			$endtime = date_format($endtime, "Y/m/d H:i:s");
		}
		$traveltype = $request->travel_type;
		if($traveltype === 'Choose a Traveler Type'){
			if(empty($start) && empty($end)){
				$budgets = DB::table('users AS us')
				->leftjoin('trips AS tr', 'tr.user_id', '=', 'us.id')
				->leftjoin('budgeted_expenses AS be', 'be.trip_id', '=', 'tr.id')
				->leftjoin('locations AS lo', 'lo.id', '=', 'be.location_id')
				->leftjoin('actual_expenses AS ae', 'ae.budgeted_id', '=', 'be.id')
				->where('be.category', 'like', '%'.$category.'%')
				//->where('us.profile_type', 'like', '%'.$traveltype.'%')
				->where('lo.country_code', 'like', '%'.$country.'%')
				->where('lo.city', 'like', '%'.$city.'%')
				//->where('be.planned_arrive', '>', $starttime)
				//->where('be.planned_depart', '<', $endtime)
				->select('be.id', 'be.amount', 'be.description', 'be.category', 'ae.budgeted_id', 'lo.id AS location_id', 'tr.id AS trip_id', 'tr.user_id AS user_id')
				->orderby('be.description', 'asc')
				->paginate(10);
			}
			else if(!empty($start) && empty($end)){
				$budgets = DB::table('users AS us')
				->leftjoin('trips AS tr', 'tr.user_id', '=', 'us.id')
				->leftjoin('budgeted_expenses AS be', 'be.trip_id', '=', 'tr.id')
				->leftjoin('locations AS lo', 'lo.id', '=', 'be.location_id')
				->leftjoin('actual_expenses AS ae', 'ae.budgeted_id', '=', 'be.id')
				->where('be.category', 'like', '%'.$category.'%')
				//->where('us.profile_type', 'like', '%'.$traveltype.'%')
				->where('lo.country_code', 'like', '%'.$country.'%')
				->where('lo.city', 'like', '%'.$city.'%')
				->where('be.planned_arrive', '>', $starttime)
				//->where('be.planned_depart', '<', $endtime)
				->select('be.id', 'be.amount', 'be.description', 'be.category', 'ae.budgeted_id', 'lo.id AS location_id', 'tr.id AS trip_id', 'tr.user_id AS user_id')
				->orderby('be.description', 'asc')->paginate(10);
			}
			else if(empty($start) && !empty($end)){
				$budgets = DB::table('users AS us')
				->leftjoin('trips AS tr', 'tr.user_id', '=', 'us.id')
				->leftjoin('budgeted_expenses AS be', 'be.trip_id', '=', 'tr.id')
				->leftjoin('locations AS lo', 'lo.id', '=', 'be.location_id')
				->leftjoin('actual_expenses AS ae', 'ae.budgeted_id', '=', 'be.id')
				->where('be.category', 'like', '%'.$category.'%')
				//->where('us.profile_type', 'like', '%'.$traveltype.'%')
				->where('lo.country_code', 'like', '%'.$country.'%')
				->where('lo.city', 'like', '%'.$city.'%')
				//->where('be.planned_arrive', '>', $starttime)
				->where('be.planned_depart', '<', $endtime)
				->select('be.id', 'be.amount', 'be.description', 'be.category', 'ae.budgeted_id', 'lo.id AS location_id', 'tr.id AS trip_id', 'tr.user_id AS user_id')
				->orderby('be.description', 'asc')->paginate(10);
			}else{
				$budgets = DB::table('users AS us')
				->leftjoin('trips AS tr', 'tr.user_id', '=', 'us.id')
				->leftjoin('budgeted_expenses AS be', 'be.trip_id', '=', 'tr.id')
				->leftjoin('locations AS lo', 'lo.id', '=', 'be.location_id')
				->leftjoin('actual_expenses AS ae', 'ae.budgeted_id', '=', 'be.id')
				->where('be.category', 'like', '%'.$category.'%')
				//->where('us.profile_type', 'like', '%'.$traveltype.'%')
				->where('lo.country_code', 'like', '%'.$country.'%')
				->where('lo.city', 'like', '%'.$city.'%')
				->where('be.planned_arrive', '>', $starttime)
				->where('be.planned_depart', '<', $endtime)
				->select('be.id', 'be.amount', 'be.description', 'be.category', 'ae.budgeted_id', 'lo.id AS location_id', 'tr.id AS trip_id', 'tr.user_id AS user_id')
				->orderby('be.description', 'asc')->paginate(10);
			}
		}
		else{
			if(empty($start) && empty($end)){
				$budgets = DB::table('users AS us')
				->leftjoin('trips AS tr', 'tr.user_id', '=', 'us.id')
				->leftjoin('budgeted_expenses AS be', 'be.trip_id', '=', 'tr.id')
				->leftjoin('locations AS lo', 'lo.id', '=', 'be.location_id')
				->leftjoin('actual_expenses AS ae', 'ae.budgeted_id', '=', 'be.id')
				->where('be.category', 'like', '%'.$category.'%')
				->where('us.profile_type', 'like', '%'.$traveltype.'%')
				->where('lo.country_code', 'like', '%'.$country.'%')
				->where('lo.city', 'like', '%'.$city.'%')
				//->where('be.planned_arrive', '>', $starttime)
				//->where('be.planned_depart', '<', $endtime)
				->select('be.id', 'be.amount', 'be.description', 'be.category', 'ae.budgeted_id', 'lo.id AS location_id', 'tr.id AS trip_id', 'tr.user_id AS user_id')
				->orderby('be.description', 'asc')
				->paginate(10);
			}
			else if(!empty($start) && empty($end)){
				$budgets = DB::table('users AS us')
				->leftjoin('trips AS tr', 'tr.user_id', '=', 'us.id')
				->leftjoin('budgeted_expenses AS be', 'be.trip_id', '=', 'tr.id')
				->leftjoin('locations AS lo', 'lo.id', '=', 'be.location_id')
				->leftjoin('actual_expenses AS ae', 'ae.budgeted_id', '=', 'be.id')
				->where('be.category', 'like', '%'.$category.'%')
				->where('us.profile_type', 'like', '%'.$traveltype.'%')
				->where('lo.country_code', 'like', '%'.$country.'%')
				->where('lo.city', 'like', '%'.$city.'%')
				->where('be.planned_arrive', '>', $starttime)
				//->where('be.planned_depart', '<', $endtime)
				->select('be.id', 'be.amount', 'be.description', 'be.category', 'ae.budgeted_id', 'lo.id AS location_id', 'tr.id AS trip_id', 'tr.user_id AS user_id')
				->orderby('be.description', 'asc')->paginate(10);
			}
			else if(empty($start) && !empty($end)){
				$budgets = DB::table('users AS us')
				->leftjoin('trips AS tr', 'tr.user_id', '=', 'us.id')
				->leftjoin('budgeted_expenses AS be', 'be.trip_id', '=', 'tr.id')
				->leftjoin('locations AS lo', 'lo.id', '=', 'be.location_id')
				->leftjoin('actual_expenses AS ae', 'ae.budgeted_id', '=', 'be.id')
				->where('be.category', 'like', '%'.$category.'%')
				->where('us.profile_type', 'like', '%'.$traveltype.'%')
				->where('lo.country_code', 'like', '%'.$country.'%')
				->where('lo.city', 'like', '%'.$city.'%')
				//->where('be.planned_arrive', '>', $starttime)
				->where('be.planned_depart', '<', $endtime)
				->select('be.id', 'be.amount', 'be.description', 'be.category', 'ae.budgeted_id', 'lo.id AS location_id', 'tr.id AS trip_id', 'tr.user_id AS user_id')
				->orderby('be.description', 'asc')->paginate(10);
			}else{
				$budgets = DB::table('users AS us')
				->leftjoin('trips AS tr', 'tr.user_id', '=', 'us.id')
				->leftjoin('budgeted_expenses AS be', 'be.trip_id', '=', 'tr.id')
				->leftjoin('locations AS lo', 'lo.id', '=', 'be.location_id')
				->leftjoin('actual_expenses AS ae', 'ae.budgeted_id', '=', 'be.id')
				->where('be.category', 'like', '%'.$category.'%')
				->where('us.profile_type', 'like', '%'.$traveltype.'%')
				->where('lo.country_code', 'like', '%'.$country.'%')
				->where('lo.city', 'like', '%'.$city.'%')
				->where('be.planned_arrive', '>', $starttime)
				->where('be.planned_depart', '<', $endtime)
				->select('be.id', 'be.amount', 'be.description', 'be.category', 'ae.budgeted_id', 'lo.id AS location_id', 'tr.id AS trip_id', 'tr.user_id AS user_id')
				->orderby('be.description', 'asc')->paginate(10);
			}
		}
		return view('search', ['budgets' => $budgets, 'category' => $category, 'city' => $city, 'starttime' => $request->starttime,
			'endtime' => $request->endtime, 'traveltype' => $traveltype]);
	}
}
