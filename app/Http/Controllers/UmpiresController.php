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
                
            /*
                px is the "distance in feet from the horizontal center of the plate"
                For the c9 return...
                +(25.5/12)                  - this moves the "zero mark" to one plate-width to the left of the plate. 17 inches (width of the plate) times 1.5. Divide by 12 to convert inches to feet
                *12/17                      - this normalizes the data. < 1 = to the left of the plate, > 1 && < 2 = over the plate, > 2 = to the right of the plate
                greatest(least(...,2.9), 0) - anything less than 0 gets bumped up to 0. Anything greater than 3 gets bumped down to 2.9. Perhaps this shouldn't happen. Hmmm...
                For the c81 and c243 returns...
                *3 divides each column into 3 more columns, 9 should do the same again. It kinda feels like I'm about to invent calculus
                
                pz-szb                      - this moves the "zero mark" from the ground to the bottom of the strike zone
                /(szt-szb)                  - this normalizes the data. < 0 is below szb, > 0 && < 1 is between szt and szb, > 1 is above szt
                2 -                         - this just flips the numbers so that < 0 above szt, > 0 && < 1 is between szt and szb, > 1 is below szb
                greatest(least())           - same as above
                *3, *9                      - same as above
                
                
                ceil(greatest(least((px+(25.5/12))*12/17,2.9),0)) c3,
                ceil(greatest(least(2 - ((pz-szb)/(szt-szb)),2.9),0)) r3,
                ceil(greatest(least(3*(px+(25.5/12))*12/17,8.9),0)) c9,
                ceil(greatest(least(6 - 3*((pz-szb)/(szt-szb)),8.9),0)) r9,
                ceil(greatest(least(9*(px+(25.5/12))*12/17,26.9),0)) c27,
                ceil(greatest(least(18 - 9*((pz-szb)/(szt-szb)),26.9),0)) r27,
            */
            $pitches = DB::select('select p.id, p.px, p.pz, p.szt, p.szb, p.prob_called_strike,
                ceil(greatest(least(27*(px+(25.5/12))*12/17,80.9),0)) c81,
                ceil(greatest(least(54 - 27*((pz-szb)/(szt-szb)),80.9),0)) r81
                from pitches p
                inner join pitch_results pr on p.pitch_result_id = pr.id
                where umpire_id = ?
                limit 7
            ', [$u->id]);
            $i = 1;
            foreach($pitches as $p){
                $p->ord = $i++;
            }
            return $pitches;
        }
    }
    
    public function getUmpireReport(){
        return view('umpire_report');
    }
}