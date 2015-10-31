<?php namespace App;

use App\Traits\ImagableTrait;
use Illuminate\Database\Eloquent\Model;

class Garnish extends Model {

    use ImagableTrait;

    protected $table = "garnishs";

    protected $fillable = ['name', 'description', 'weight', 'price', 'image'];

    /**
     * Get Lunchs
     */
    public function lunchs()
    {
        $this->belongsToMany('App\Lunch');
    }

}
