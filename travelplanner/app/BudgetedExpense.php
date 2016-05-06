<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class BudgetedExpense extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'budgeted_expenses';
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['amount', 'description', 'category', 'supplier',
        'address','planned_arrive','planned_depart', 'location_id', 'trip_id'];	
	// no hidden fiels in json 
	
	/**
     * Get the trip that owns the budget.
     */
	public function trip()
    {
        return $this->belongsTo('App\Trip');
    }
	
	/**
     * Get the location that owns the budget.
     */
	public function location()
    {
        return $this->belongsTo('App\Location');
    }
	
	public function actualExpense()
    {
        return $this->hasOne('App\ActualExpense');
    }

}
