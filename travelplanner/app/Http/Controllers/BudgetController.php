<?php namespace App\Http\Controllers;

use App\ActualExpense;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\BudgetedExpense;
use Auth;
use DB;
use App\Location;
use App\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class BudgetController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @param	$location_id, $trip_id
	 * @return Response
	 */
	public function create($location_id, $trip_id)
	{
		$budgets = BudgetedExpense::where('location_id', '=', $location_id)->orderby('description', 'asc')->paginate(10);
		$actuals = ActualExpense::get();
		return view('budget', ['locationid' => $location_id, 'tripid'=> $trip_id,
				                     'budgets'=>$budgets, 'actuals'=>$actuals,]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param $locationid, $tripid
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
	public function store(Request $request, $locationid, $tripid)
	{
		$this->validate($request,
				['planned_arrive' => 'required',
						'planned_depart' => 'required',
						'amount' => 'required|integer',
						'category' => 'required|max:255',
						'description' => 'required|max:255',
						'supplier' => 'required|max:255',
						'address' => 'required|max:255']);

		$location = Location::find($locationid);
		$trip=Trip::find($tripid);
		$arrive = date_create($request->planned_arrive);
		$arrive = date_format($arrive, "Y/m/d H:i:s");
		$depart = date_create($request->planned_depart);
		$depart = date_format($depart, "Y/m/d H:i:s");

		$budget = new BudgetedExpense;
		$budget=BudgetedExpense::create(['planned_arrive' => $arrive,
				'planned_depart' => $depart,
				'amount' => $request->amount,
				'category' => $request->category,
				'description' => $request->description,
				'supplier' => $request->supplier,
				'address' => $request->address,
			'location_id' => $locationid,
			'trip_id' => $tripid,
		]);
		$budget->location()->associate($location);
		$budget->trip()->associate($trip);
		$budget->save();
		$id = $budget->id;
		//return "in budget returning actusl view";
		return redirect('/actual/'.$id.' '.$locationid.' '.$tripid);//->with(['budgetid'=>$budget->id, 'locationid'=>$locationid, 'tripid'=>$tripid]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $budget_id, $location_id, $trip_id
	 * @return Response
	 */
	public function show($budget_id, $location_id, $trip_id)
	{
		$budget = DB::table('budgeted_expenses AS be')->where('be.id', '=', $budget_id)->first();
		$location= Location::where('id','=', $location_id)->get()->first();
		return view('budgetshow', ['budget'=> $budget, 'location'=>$location,]);
	}
	
	/**
	 * Display a normal view,  the "back" button goes back to different views than the show or plain.
	 *
	 * @param  int  $budget_id, $location_id, $trip_id
	 */
	public function view($budget_id, $location_id, $trip_id){
		$budget = DB::table('budgeted_expenses AS be')->where('be.id', '=', $budget_id)->first();
		$location= Location::where('id','=', $location_id)->get()->first();
		return view('budgetview', ['budget'=> $budget, 'location'=>$location, 'tripid'=>$trip_id]);
	}
	
	public function plain($budget_id, $location_id, $trip_id)
	{
		$budget = DB::table('budgeted_expenses AS be')->where('be.id', '=', $budget_id)->first();
		$location= Location::where('id','=', $location_id)->get()->first();
		return view('budgetplain', ['budget'=> $budget, 'location'=>$location,]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $budget_id, $location_id, $trip_id
	 * @return Response
	 */
	public function edit($budget_id, $location_id, $trip_id)
	{
		$trip=Trip::find($trip_id);
		$budget=BudgetedExpense::find($budget_id);
		$actual=DB::table('actual_expenses AS ae')->where('ae.budgeted_id', '=', $budget_id)->first();
		//return response()->json($actual, 200);
		$location= Location::where('id','=', $budget->location_id)->get()->first();
		if (Auth::user()->id === $trip->user_id){
			return view('budgetedit', ['budget'=> $budget, 'actual'=> $actual, 'location'=>$location,
				'budgetid'=>$budget_id, 'locationid'=>$location_id, 'tripid'=>$trip_id,]);
		}
		else
			return view('unauthorized');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $budget_id, $location_id, $trip_id
	 * @return Response
	 */
	public function update(Request $request, $budget_id, $location_id, $trip_id )
	{
		$trip=Trip::find($trip_id);
		if ($request->user()->id === $trip->user_id){
			$budget=BudgetedExpense::find($budget_id);
			$input = $request->all();
			$budget->fill($input)->save();					
			
			$budgets = BudgetedExpense::where('trip_id', '=', $trip_id)->orderby('description', 'asc')->paginate(10);
			return view('tripedit')->with(['trip'=> $trip,
					'budgets'=>$budgets,]);
		}
		else
			return view('unauthorized');
		
					
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $budget_id, $location_id, $trip_id
	 * @return Response
	 */
	public function destroy(Request $request, $budget_id, $location_id, $trip_id)
	{
		$trip=Trip::find($trip_id);
		if ($request->user()->id === $trip->user_id){
			$actual = DB::table('actual_expenses')->where('budgeted_id', '=', $budget_id)->delete();
			$budget = BudgetedExpense::find($budget_id);
			$budget->delete();
			$budgets = BudgetedExpense::where('location_id', '=', $location_id)->orderby('description', 'asc')->paginate(10);
			$actuals = ActualExpense::get();
			return view('budget', ['budgets' => $budgets,
					'locationid'=>$location_id, 'tripid'=>$trip_id, 'actuals'=>$actuals]);
		}
		else
			return view('unauthorized');
	}

}
