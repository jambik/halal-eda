<?php namespace App\Http\Controllers\Admin;

use App\Addition;
use App\Drink;
use App\Garnish;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Lunch;

use App\Meal1;
use App\Meal2;
use App\Salad;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class LunchsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$items = Lunch::byUser(0)->get();

		return view('admin.lunchs.index', compact('items'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$meal1     = Meal1::lists('name', 'id')->all();
		$meal2     = Meal2::lists('name', 'id')->all();
		$garnishs  = Garnish::lists('name', 'id')->all();
		$salads    = Salad::lists('name', 'id')->all();
		$drinks    = Drink::lists('name', 'id')->all();
		$additions = Addition::allWithSelection();

		return view('admin.lunchs.create', compact('meal1', 'meal2', 'garnishs', 'salads', 'drinks', 'additions'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, ['name' => 'required']);

		$item = Lunch::create($request->all());

		$this->saveInfo($item, $request);

		Flash::success("Запись - {$item->id} сохранена");

		return redirect(route('admin.lunchs.index'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return Lunch::with('meal1', 'meal2', 'garnish', 'salad', 'drink', 'additions')->find($id);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$item      = Lunch::findOrFail($id);

		$meal1     = Meal1::lists('name', 'id')->all();
		$meal2     = Meal2::lists('name', 'id')->all();
		$garnishs  = Garnish::lists('name', 'id')->all();
		$salads    = Salad::lists('name', 'id')->all();
		$drinks    = Drink::lists('name', 'id')->all();
		$additions = Addition::allWithSelection($item->addition_list);

		return view('admin.lunchs.edit', compact('item','meal1', 'meal2', 'garnishs', 'salads', 'drinks', 'additions'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int    $id
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$this->validate($request, ['name' => 'required']);

		$item = Lunch::findOrFail($id);

		$item->update($request->all());

		$this->saveInfo($item, $request);

		Flash::success("Запись - {$id} обновлена");

		return redirect(route('admin.lunchs.index'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Lunch::destroy($id);

		Flash::success("Запись - {$id} удалена");

		return redirect(route('admin.lunchs.index'));
	}

	public function saveInfo(Lunch $item, Request $request)
	{
		$item->saveImage($item, $request);

		$additionList = $request->input('addition_list') ?: [];
		$item->additions()->sync($additionList);
	}

}
