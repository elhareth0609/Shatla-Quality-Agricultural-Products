<?php

namespace App\Http\Controllers;
use Nnjeim\World\World;

use Illuminate\Http\Request;

class CountryController extends Controller
{
    
    public function getStates($id) {
        $states =  World::states([
            'filters' => [
                'country_id' => $id,
            ],
        ]);
        
        return response()->json($states);
    }

    public function getCities($id,$uid) {
        $cities =  World::cities([
            'fields' => 'cities',
            'filters' => [
                'country_id' => $id,
                'state_id' => $uid
            ],
        ]);
        $cities->id = $id;
        $cities->uid = $uid;
        return response()->json($cities);
    }

}
