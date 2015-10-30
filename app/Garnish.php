<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Garnish extends Model {

	protected $table = "garnishs";

	protected $fillable = ['name', 'description', 'weight', 'price', 'image'];

	/**
	 * Get Lunchs
	 */
	public function lunchs()
	{
		$this->belongsToMany('App\Lunch');
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
			$file = $request->file('image')->move(static::imagePath(), 'garnish-'.$item->id.".".Str::lower($request->file('image')->getClientOriginalExtension()));
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
		return config('laravel-glide.source.path').'/garnishs';
	}

	/**
	 * Get Image url path
	 *
	 * @return string
	 */
	public static function imageUrl()
	{
		return '/img/garnishs/';
	}
}
