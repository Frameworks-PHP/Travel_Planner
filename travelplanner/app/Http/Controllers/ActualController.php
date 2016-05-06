<?php namespace App\Http\Controllers;

use App\ActualExpense;
use App\BudgetedExpense;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\Trip;
use Illuminate\Http\Request;

class ActualController extends Controller {

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
	 * @return Response
	 */
	public function create($budgetid, $locationid, $trip_id)
	{
		return view('actual', ['budgetid'=>$budgetid, 'locationid'=>$locationid, 'tripid'=>$trip_id]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request, $budgeted_id)
	{
		$this->validate($request,
				['actual_arrive' => 'required',
						'actual_depart' => 'required',
						'amount' => 'required|integer',
						'category' => 'required|max:255',
						'description' => 'required|max:255',
						'supplier' => 'required|max:255',
						'address' => 'required|max:255']);

		$arrive = date_create($request->actual_arrive);
		$arrive = date_format($arrive, "Y/m/d H:i:s");
		$depart = date_create($request->actual_depart);
		$depart = date_format($depart, "Y/m/d H:i:s");
		$actual = new ActualExpense();
		$actual=ActualExpense::create(['actual_arrive' => $arrive,
				'actual_depart' => $depart,
				'amount' => $request->amount,
				'category' => $request->category,
				'description' => $request->description,
				'supplier' => $request->supplier,
				'address' => $request->address,
				'budgeted_id' => $budgeted_id,
		]);
		return redirect('/');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($budgeted_id)
	{
		$actual=DB::table('actual_expenses AS ae')->where('ae.budgeted_id', '=', $budgeted_id)
			->first();
		$budget=BudgetedExpense::find($budgeted_id);
		if($actual == null)
			return view('actualshow', ['budget'=>$budget]);
		else
			return view('actualshow', ['actual'=> $actual, 'budget'=>$budget]);
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function plain($budgeted_id)
	{
		$actual=DB::table('actual_expenses AS ae')->where('ae.budgeted_id', '=', $budgeted_id)
			->first();
		$budget=BudgetedExpense::find($budgeted_id);
		if($actual == null)
			return view('actualplain', ['budget'=>$budget]);
		else{

			return view('actualplain', ['actual'=> $actual, 'budget'=>$budget]);
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($budgeted_id, $location_id, $trip_id)
	{
		$trip=Trip::find($trip_id);
		if (Auth::user()->id === $trip->user_id){
			$actual=DB::table('actual_expenses AS ae')->where('ae.budgeted_id', '=', $budgeted_id)->first();
			return view('actualedit', ['actual'=>$actual, 'locationid'=>$location_id, 'tripid'=>$trip_id]);
		}
		else
			return view('unauthorized');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $actual_id, $location_id, $trip_id)
	{
		$trip=Trip::find($trip_id);
		if ($request->user()->id === $trip->user_id){
			$actual=ActualExpense::find($actual_id);
			$input = $request->all();
			$actual->fill($input)->save();

			$budgets = BudgetedExpense::where('location_id', '=', $location_id)->orderBy('category', 'desc')->paginate(10);
			$actuals = ActualExpense::get();
			return view('budget', ['budgets' => $budgets,
					'locationid'=>$location_id, 'tripid'=>$trip_id, 'actuals'=>$actuals]);
		}
		else
			return view('unauthorized');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Request $request, $actual_id, $location_id, $trip_id)
	{
		$trip = Trip::find($trip_id);
		if ($request->user()->id === $trip->user_id){
			$actual = ActualExpense::find($actual_id);
			$actual->delete();
			$budgets = BudgetedExpense::where('location_id', '=', $location_id)->orderBy('category', 'desc')->paginate(10);
			$actuals = ActualExpense::get();
			return view('budget', ['budgets' => $budgets,
					'locationid'=>$location_id, 'tripid'=>$trip_id, 'actuals'=>$actuals]);
		}
		else
			return view('unauthorized');
	}

}
