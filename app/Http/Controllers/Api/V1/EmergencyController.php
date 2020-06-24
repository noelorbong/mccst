<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class EmergencyController extends Controller
{

      public function store(Request $request)
    {
        $response = 1;
         if(!$request->email){
            return compact('response');
        }

         DB::table('emergency_log')->insert(
            ['email' => $request->email,
            'emergency_type' => (int)$request->emergency_type,
            'quantity' => (int)$request->quantity,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'note' => $request->note,
            'created_at' => DB::raw('DATE_ADD(NOW(), INTERVAL 8 HOUR)')
            ]
        );

        $response = 0;
        return compact('response');
        
    }

}
