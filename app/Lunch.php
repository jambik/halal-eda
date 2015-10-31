<?php namespace App;

use App\Traits\ImagableTrait;
use Illuminate\Database\Eloquent\Model;

class Lunch extends Model {

    use ImagableTrait;

    protected $table = 'lunchs';

    protected $fillable = ['name', 'description', 'user_id', 'meal1_id', 'meal2_id', 'garnish_id', 'salad_id', 'drink_id', 'price', 'image'];

    public function meal1()
    {
        return $this->hasOne('App\Meal1', 'id', 'meal1_id');
    }

    public function meal2()
    {
        return $this->hasOne('App\Meal2', 'id', 'meal2_id');
    }

    public function garnish()
    {
        return $this->hasOne('App\Garnish', 'id', 'garnish_id');
    }

    public function salad()
    {
        return $this->hasOne('App\Salad', 'id', 'salad_id');
    }

    public function drink()
    {
        return $this->hasOne('App\Drink', 'id', 'drink_id');
    }

    public function additions()
    {
        return $this->belongsToMany('App\Addition', 'lunch_addition', 'lunch_id', 'addition_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function scopeByUser($query, $id)
    {
        return $query->where('user_id', (string)$id);
    }

    public function getActualPriceAttribute()
    {
        $price = 0;

        $price += $this->meal1 ? $this->meal1->price : 0;
        $price += $this->meal2 ? $this->meal2->price : 0;
        $price += $this->garnish ? $this->garnish->price : 0;
        $price += $this->salad ? $this->salad->price : 0;
        $price += $this->drink ? $this->drink->price : 0;
        $price += array_sum($this->additions()->lists('price')->all());

        return $price;
    }

    public function getAdditionListAttribute()
    {
        return $this->additions()->lists('id')->all();
    }

    public function getAdditionNamesAttribute()
    {
        return $this->additions()->lists('name')->all();
    }

}
