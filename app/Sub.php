<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Sub extends Model {

	protected $table = 'subs';

	protected $fillable = ['user_id', 'day', 'lunch_id', 'quantity'];

	public function scopeByUser($query, $id)
	{
		return $query->where('user_id', (string)$id);
	}

	public function scopeDay($query, $day)
	{
		return $query->where('day', (string)$day);
	}

	public function lunch()
	{
		return $this->hasOne('App\Lunch', 'id', 'lunch_id');
	}

	public function user()
	{
		return $this->belongsTo('App\User', 'user_id', 'id');
	}








	public static function subscribe($id, Request $request)
	{
		$idsToInsert = [];
		$idsToUpdate = [];
		$idsToDelete = [];

		if ($request->has('id'))
		{
			$input = $request->all();

			$idsToInsert = [];
			$idsToUpdate = [];

			foreach ($input['id'] as $key => $value)
			{
				if ( ! $value)
				{
					$lunch = Lunch::create([
						'user_id' => $id,
						'name' => $input['name'][$key],
						'meal1_id' => $input['meal1'][$key],
						'meal2_id' => $input['meal2'][$key],
						'garnish_id' => $input['garnish'][$key],
						'salad_id' => $input['salad'][$key],
						'drink_id' => $input['drink'][$key],
						'price' => $input['price'][$key],
					]);

					$lunch->additions()->sync($input['additions'][$key] ? explode(',', $input['additions'][$key]) : []);

					Sub::create([
						'user_id' => $id,
						'lunch_id' => $lunch->id,
						'day' => $input['day'][$key],
						'quantity' => $input['quantity'][$key],
					]);

					$idsToInsert[] = (string)$lunch->id;
				}
				else
				{
					$lunch = Lunch::findOrFail($value);
					$lunch->price = $input['price'][$key];
					$lunch->save();

					$sub = Sub::where('lunch_id', $value)->firstOrFail();
					$sub->quantity = $input['quantity'][$key];
					$sub->save();

					$idsToUpdate[] = $value;
				}
			}

			$idsToDelete = Sub::where('user_id', $id)->whereNotIn('lunch_id', array_merge($idsToUpdate, $idsToInsert))->get()->lists('lunch_id');

			Lunch::whereIn('id', $idsToDelete)->delete();
			Sub::whereIn('lunch_id', $idsToDelete)->delete();
		}
		else
		{
			$lunchToDelete = Sub::where('user_id', $id)->get()->lists('lunch_id');

			Lunch::whereIn('id', $lunchToDelete)->delete();
			Sub::whereIn('lunch_id', $lunchToDelete)->delete();
		}

		return ['insert' => $idsToInsert, 'update' => $idsToUpdate, 'delete' => $idsToDelete];
	}

	public static function unsubscribe($id)
	{
		$idsToDelete = Lunch::byUser($id)->get()->lists('id');

		Lunch::whereIn('id', $idsToDelete)->delete();
		Sub::whereIn('lunch_id', $idsToDelete)->delete();

		return ['delete' => $idsToDelete];
	}

}