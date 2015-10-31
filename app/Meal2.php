<?php namespace App;

use App\Traits\ImagableTrait;
use Illuminate\Database\Eloquent\Model;

class Meal2 extends Model {

    use ImagableTrait;

    protected $table = "meal2";

    protected $fillable = ['name', 'description', 'consist', 'weight', 'price', 'image'];

    /**
     * Get Lunchs
     */
    public function lunchs()
    {
        $this->belongsToMany('App\Lunch');
    }

}
