<?php namespace App;

use App\Traits\ImagableTrait;
use Illuminate\Database\Eloquent\Model;

class Drink extends Model {

    use ImagableTrait;

    protected $table = "drinks";

    protected $fillable = ['name', 'description', 'weight', 'price', 'image'];

    /**
     * Get Lunchs
     */
    public function lunchs()
    {
        $this->belongsToMany('App\Lunch');
    }

}
