<?php namespace App;

use App\Traits\ImagableTrait;
use Illuminate\Database\Eloquent\Model;

class Salad extends Model {

    use ImagableTrait;

    protected $table = "salads";

    protected $fillable = ['name', 'description', 'consist', 'weight', 'price', 'image'];

    /**
     * Get Lunchs
     */
    public function lunchs()
    {
        $this->belongsToMany('App\Lunch');
    }

}
