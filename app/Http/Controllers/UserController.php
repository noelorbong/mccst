<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

        public function __construct()
    {
        $this->middleware('auth');
    }

     public function list()
    {
        $records = DB::table('user_information')
        ->select('*')
        ->orderByRaw('name asc')
        ->get();

        return  compact('records');
    }

    public function destroy($id)
    {
        DB::table('user_information')->where('id', '=', $id)->delete();

        return 'success';
    }

     public function profile($email)
    {
        $user = DB::table('user_information')
        ->select('*')
        ->orderByRaw('name asc')
        ->where('email','=',$email)
        ->first();

        $records = null;
        
         $records = DB::table('emergency_log')
            ->leftJoin('emergency', 'emergency_log.emergency_type', '=', 'emergency.emergency_type')
            ->select('emergency_log.*',
            'emergency.title',
            'emergency.description'
            )
            ->where(('emergency_log.email'),'=', $email)
            ->orderByRaw('emergency_log.created_at desc')
            ->get();
        
        return  compact('user','records');
    }

    
    
}
