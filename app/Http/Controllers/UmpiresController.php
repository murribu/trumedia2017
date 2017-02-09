<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Auth;
use DB;

use App\Models\Pitch;
use App\Models\Umpire;

class UmpiresController extends Controller {
    public function getPitches(){
        if (Input::has('umpire_id')){
            $u = Umpire::find(Input::get('umpire_id'));
            $pitches = Pitch::join('pitch_results', 'pitches.pitch_result_id', '=', 'pitch_results.id')
                ->select('pitches.id', 'px', 'pz', 'szt', 'szb', 'prob_called_strike')
                ->where('umpire_id', $u->id)
                ->whereIn('pitch_results.id', [2, 7]) // Strike Looking, Ball
                ->limit(10)
                ->get();
            return $pitches;
        }
    }
    
    public function getUmpireReport(){
        return view('umpire_report');
    }
}