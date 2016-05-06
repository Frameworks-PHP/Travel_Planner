<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'locations';
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'description', 'city', 'province', 'country_code'];
	
	// no hidden fiels in json
	
	public $timestamps = false;
	
	public function budgetedExpenses()
    {
        return $this->hasMany('App\BudgetedExpense');
    }

}
