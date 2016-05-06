<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(Auth::check()){
			if(Auth::user()->name === 'admin')
				$users = User::orderBy('created_at', 'asc')->paginate(10);
			else
				$users = User::where('id', '=', Auth::user()->id)->paginate(10);
			return view('userlist', ['users' => $users]);
		}
		else
			return redirect('auth/login');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created user in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$user = new User;
		$user->name=$request->name;
		$user->email=$request->email;
		$user->password=$request->password;
		$user->profile_type = $request->profile_type;
		$user->experience_level = $request->experience_level;
		$user->save();

		if($request->isXmlHttpRequest()){
			return response()->json($user);
		}else{
			$users = User::orderBy('created_at', 'asc')->get();
			return view('userlist', ['users' => $users]);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if(Auth::user()->id === $id){
			User::findOrFail($id)->delete();
			return redirect('/user');
		}
		else
			return view('unauthorized');
	}

}
