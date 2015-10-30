<?php namespace App\Http\Controllers\Admin;

use App\Sub;
use App\Lunch;
use App\Meal1;
use App\Meal2;
use App\Garnish;
use App\Salad;
use App\Drink;
use App\Addition;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class SubsController extends Controller {

	/**
	 * Show the form for edit subscription
	 *
	 * @return Response
	 */
	public function showSubs($id)
	{
		$lunchs    = Lunch::with('meal1', 'meal2', 'garnish', 'salad', 'drink', 'additions')->where('user_id', 0)->get();
		$meal1     = Meal1::all();
		$meal2     = Meal2::all();
		$garnishs  = Garnish::all();
		$salads    = Salad::all();
		$drinks    = Drink::all();
		$additions = Addition::all();

		$user      = User::findOrFail($id);
		$subs      = Sub::with('lunch.meal1', 'lunch.meal2', 'lunch.garnish', 'lunch.salad', 'lunch.drink')->byUser($id)->get();

		$daysOfWeek = trans('vars.day_of_week');

		return view('admin.subs.save', compact('user', 'subs', 'lunchs', 'meal1', 'meal2', 'garnishs', 'salads', 'drinks', 'additions', 'daysOfWeek'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function saveSubs($id, Request $request)
	{
		Sub::subscribe($id, $request);

		Flash::success("Подписка пользователя # {$id} сохранена");
		return redirect(route('admin.users.index'));
	}

}
