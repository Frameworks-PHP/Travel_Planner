<?php namespace App\Http\Controllers;

use App\BudgetedExpense;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use App\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class TripController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$trips = Trip::orderBy('name', 'asc')->paginate(10);
		return view('tripForm', ['trips' => $trips]);
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
    public function create(){
        $trips = Trip::orderBy('name', 'asc')->paginate(10);
        return view('tripForm', ['trips' => $trips]);
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request){
		$this->validate($request,
				['name' => 'required|max:50',
						'description' => 'required|max:255',]);
		$request->user()->trips()->create(['name' => $request->name,
				'description' => $request->description]);
		return redirect('/');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $trip_id
	 * @return Response
	 */
	public function show($trip_id)
	{
        $trip = Trip::find($trip_id);
		$budgets = BudgetedExpense::where('trip_id', '=', $trip_id)->paginate(10);
        return view('tripshow', ['trip'=>$trip, 'budgets'=>$budgets]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $trip_id
	 * @return Response
	 */
	public function edit($trip_id)
	{
        $trip=Trip::find($trip_id);
		$budgets = BudgetedExpense::where('trip_id', '=', $trip_id)->paginate(10);
		if (Auth::user()->id === $trip->user_id){
			return view('tripedit')->with(['trip'=> $trip,
				'budgets'=>$budgets,]);
		}
		else
			return view('unauthorized');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $trip_id
	 * @return Response
	 */
	public function update($trip_id, Request $request)
	{
		$trip=Trip::find($trip_id);
		if ($request->user()->id === $trip->user_id){
			$input = $request->all();
			$trip->fill($input)->save();
			$budgets = BudgetedExpense::where('trip_id', '=', $trip_id)->paginate(10);
			return view('tripedit')->with(['trip'=> $trip,
				'budgets'=>$budgets,]);
		}
		else
			return view('unauthorized');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $trip_id
	 * @return Response
	 */
	public function destroy(Request $request, $trip_id){
		$trip = Trip::find($trip_id);
		if ($request->user()->id === $trip->user_id){
			$trip->budgetedExpenses()->delete();
			$trip->delete();
			return redirect('/');
		}
		else
			return view('unauthorized');
	}
	
	/**
	 * Searches for different trips on the home page. Either "all" trips, "user" trips
	 * or the trips according to the query. POST of home page
	 *
	 * @param $request
	 */
	public function searchTrips(Request $request){
		$type = $request->type;
		// get all trips
		if($type === 'all'){
			$trips = DB::table('trips')->orderby('name', 'asc')->paginate(10);
		}
		// get trips according to query
		else if($type === 'search'){
			$name = $request->name;
			$description = $request->description;
			$trips = DB::table('trips')->where('name', 'like', '%'.$name.'%')
				->where('description', 'like', '%'.$description.'%')
				->select('id', 'name', 'user_id')->orderby('name', 'asc')->paginate(10);
		}
		// get trips according to current user
		else{
			$userid = Auth::user()->id;
			$trips = DB::table('trips')->where('user_id', '=', $userid)
				->select('id', 'name', 'user_id')->orderby('name', 'asc')->paginate(10);
		}
		return view('tripForm', ['trips' => $trips, 'name' => $request->name, 
			'description' => $request->description]);
	}
}
