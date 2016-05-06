<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model {
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'trips';
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'description'];
	
	public function user()
    {
        return $this->belongsTo('App\User');
    }
	
	// public function locations()
    // {
        // return $this->hasMany('App\Location');
    // }
	
	public function budgetedExpenses()
    {
        return $this->hasMany('App\BudgetedExpense');
    }
}
