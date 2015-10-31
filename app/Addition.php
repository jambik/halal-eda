<?php namespace App;

use App\Traits\ImagableTrait;
use Illuminate\Database\Eloquent\Model;

class Addition extends Model {

    use ImagableTrait;

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

}
