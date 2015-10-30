<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Salad;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class SaladsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$items = Salad::all();

		return view('admin.salads.index', compact('items'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.salads.create');
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

		$item = Salad::create($request->all());

		$item->saveImage($item, $request);

		Flash::success("Запись - {$item->id} сохранена");

		return redirect(route('admin.salads.index'));
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
		$item = Salad::findOrFail($id);

		return view('admin.salads.edit', compact('item'));
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

		$item = Salad::findOrFail($id);

		$item->update($request->all());

		$item->saveImage($item, $request);

		Flash::success("Запись - {$id} обновлена");

		return redirect(route('admin.salads.index'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Salad::destroy($id);

		Flash::success("Запись - {$id} удалена");

		return redirect(route('admin.salads.index'));
	}

}
