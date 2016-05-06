<?php namespace App\Http\Controllers;
use App\ActualExpense;
use App\Trip;
use App\BudgetedExpense;
use App\Location;
use DB;
use App\Http\Controllers\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class LocationController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$locations = Location::orderBy('name', 'asc') ->paginate(10);
		return view('location', ['locations' => $locations,]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @param	$tripid
	 * @return Response
	 */
	public function create($tripid)
	{
		$locations = Location::orderBy('name', 'asc') ->paginate(10);
		
		return view('location')->with(['locations' => $locations, 'tripid'=>$tripid,]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param	$tripid
	 * @return Response
	 */
	public function store(Request $request, $tripid)
	{
		$this->validate($request,
				['name' => 'required|max:50',
						'description' => 'required|max:255',
						'city' => 'required|max:255',
						'country_code' => 'required|max:2',
					    'province' => 'required|max:255'
				]);
		$location=Location::create(['name' => $request->name,
			'description' => $request->description,
				'city' => $request->city,
				'province' => $request->province,
				'country_code' => $request->country_code,]);
        $locationid =$location->id;
		$budgets = $budgets = BudgetedExpense::where('location_id', '=', $locationid)->orderBy('category', 'asc')->paginate(10);
		$actuals = ActualExpense::get();

		return view('budget')->with(['budgets'=>$budgets,
				'locationid' => $locationid, 'tripid'=> $tripid, 'actuals'=>$actuals,]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $location_id, $trip_id
	 * @return Response
	 */
	public function show($location_id, $trip_id)
	{
		$location=Location::find($location_id);

		return view('locationshow')->with(['location'=>$location, 'tripid'=> $trip_id]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $location_id, $trip_id
	 * @return Response
	 */
	public function edit($location_id, $trip_id)
	{
		$location=Location::find($location_id);

		return view('locationedit')->with(['location'=>$location, 'tripid'=> $trip_id,]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $location_id, $tripid
	 * @return Response
	 */
	public function update(Request $request, $location_id, $tripid)
	{

		$location=Location::find($location_id);
		$input = $request->all();
		$location->fill($input)->save();

		$locations = Location::orderBy('name', 'asc')->paginate(10);
		return view('location')->with(['locations' => $locations, 'id'=>$tripid,]);
	}

	/**
	 * Remove the specified resource from trips.
	 *
	 * @param  int  $location_id, $tripid
	 * @return Response
	 */
	public function destroy($locationid, $tripid)
	{
		$user_id = Auth::user()->id;
		$budgets = DB::table('budgeted_expenses AS be')->where('be.location_id', '=', $locationid)
			->leftjoin('trips AS tr', 'tr.user_id', '=', $user_id)
			->where('be.trip_id', '=', 'tr_id')->where('tr.id', '=', $tripid)
			->get();
		$budgets->delete();
		$locations = DB::table('locations AS lo')->leftjoin('budgeted_expenses AS be', 'be.location_id', '=', $locationid )
			->where('be.trip_id', '=', $tripid)->select('lo.name', 'be.id')->get();
		return view('location')->with(['locations' => $locations, 'id'=>$tripid,]);
	}
	
	/**
	 * Searches for different locations based on query
	 *
	 * @param  int  $location_id, $tripid
	 * @return Response
	 */
	public function searchLocations(Request $request, $tripid){
		$type = $request->type;
		if($type === 'search'){
			$name = $request->name;
			$city = $request->city;
			$countrycode = $request->countrycode;
			$locations = DB::table('locations')->where('name', 'like', '%'.$name.'%')
				->where('city', 'like', '%'.$city.'%')
				->where('country_code', 'like', '%'.$countrycode.'%')
				->orderBy('name', 'asc')->paginate(10);
		}else{
			return "error in search";
		}
		return view('location', ['locations' => $locations, 'tripid'=>$tripid, 'name'=>$name, 
			'city'=>$city, 'countrycode'=>$countrycode]);
	}
}
