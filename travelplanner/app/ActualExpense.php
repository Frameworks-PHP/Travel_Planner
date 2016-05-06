<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ActualExpense extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'actual_expenses';
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['amount', 'description', 'category', 'supplier', 'address', 'actual_arrive', 'actual_depart', 'budgeted_id'];
	
	// no hidden fiels in json
	
	public function budgetedExpense()
    {
        return $this->belongsTo('App\BudgetedExpense');
    }
}
