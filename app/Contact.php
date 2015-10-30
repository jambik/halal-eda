<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model {

	protected $table = "contacts";

	protected $fillable = ['name', 'phone', 'city', 'metro', 'street', 'house', 'corpus', 'building', 'apartment', 'entrance', 'floor', 'intercom', 'comment'];

}