<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Addition extends Model {

	protected $table = "additions";

	protected $fillable = ['name', 'description', 'weight', 'price', 'image'];

	public function lunchs()
	{
		return $this->belongsToMany('App\Lunch', 'lunch_addition', 'addition_id', 'lunch_id');
	}

	/**
	 * @param array	$ids	Array of App\Addition Id
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public static function allWithSelection($ids = [])
	{
		$items = static::all();

		foreach($items as $key => $val)
		{
			$items[$key]->selected = in_array($val->id , $ids) ? true : false;
		}

		return $items;
	}

	/**
	 * Get Image url path attribute
	 *
	 * @return string
	 */
	public function getImgUrlAttribute()
	{
		return static::imageUrl();
	}

	/**
	 * Get Image sizes attribute (as array of glide url paths)
	 *
	 * @return array
	 */
	public function getImgSizeAttribute()
	{
		$imgThumb['xs']    = '?w=50&h=40&fit=crop&'.$this->updated_at->timestamp;
		$imgThumb['icon']  = '?w=100&h=80&fit=crop&'.$this->updated_at->timestamp;
		$imgThumb['thumb'] = '?w=300&h=200&fit=crop&'.$this->updated_at->timestamp;
		return $imgThumb;
	}

	/**
	 * Save Item Image
	 *
	 * @param         $item
	 * @param Request $request
	 *
	 * @return bool
	 */
	public function saveImage($item, Request $request)
	{
		if ($request->hasFile('image'))
		{
			$file = $request->file('image')->move(static::imagePath(), 'addition-'.$item->id.".".Str::lower($request->file('image')->getClientOriginalExtension()));
			$item->image = $file->getFilename();
			$item->save();
		}

		return true;
	}

	/**
	 * Get Image directory path
	 *
	 * @return string
	 */
	public static function imagePath()
	{
		return config('laravel-glide.source.path').'/additions';
	}

	/**
	 * Get Image url path
	 *
	 * @return string
	 */
	public static function imageUrl()
	{
		return '/img/additions/';
	}
}
