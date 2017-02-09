<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Umpire extends Model {
	protected $table = 'umpires';
    
    public function pitches(){
        return $this->hasMany('App\Models\Pitch');
    }
}