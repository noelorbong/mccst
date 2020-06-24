<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
       public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function print($startdate,$enddate)
    {  
        $records = DB::table('emergency_log')
            ->leftJoin('user_information', 'emergency_log.email', '=', 'user_information.email')
            ->leftJoin('emergency', 'emergency_log.emergency_type', '=', 'emergency.emergency_type')
            ->select('emergency_log.*',
            'user_information.name',
            'user_information.photo',
            'user_information.address',
            'user_information.number',
            'emergency.title',
            'emergency.description'
            )
            ->where(DB::raw('Date(emergency_log.created_at)'),'>=', $startdate)
            ->where(DB::raw('Date(emergency_log.created_at)'),'<=', $enddate)
            ->orderByRaw('emergency_log.created_at desc')
            ->get();
        return  view('print', compact('records'));
    }

     public function list($startdate,$enddate)
    {  
        $records = DB::table('emergency_log')
            ->leftJoin('user_information', 'emergency_log.email', '=', 'user_information.email')
            ->leftJoin('emergency', 'emergency_log.emergency_type', '=', 'emergency.emergency_type')
            ->select('emergency_log.*',
            'user_information.name',
            'user_information.photo',
            'user_information.address',
            'user_information.number',
            'emergency.title',
            'emergency.description'
            )
            ->where(DB::raw('Date(emergency_log.created_at)'),'>=', $startdate)
            ->where(DB::raw('Date(emergency_log.created_at)'),'<=', $enddate)
            ->orderByRaw('emergency_log.created_at desc')
            ->get();
        return  compact('records');
    }

    public function reportToday()
    {  $total_report= DB::table('emergency_log')
            ->where(DB::raw('Date(emergency_log.created_at)'),'=', DB::raw('Date(NOW())'))
            ->count();
    $unresponded_report= DB::table('emergency_log')
            ->where('emergency_log.responded','=', 0)
            ->where(DB::raw('Date(emergency_log.created_at)'),'=', DB::raw('Date(NOW())'))
            ->count();

    $responded_report= DB::table('emergency_log')
            ->where('emergency_log.responded','!=', 0)
            ->where(DB::raw('Date(emergency_log.created_at)'),'=', DB::raw('Date(NOW())'))
            ->count();

        $records = DB::table('emergency_log')
            ->leftJoin('user_information', 'emergency_log.email', '=', 'user_information.email')
            ->leftJoin('emergency', 'emergency_log.emergency_type', '=', 'emergency.emergency_type')
            ->select('emergency_log.*',
            'user_information.name',
            'user_information.photo',
            'user_information.address',
            'user_information.number',
            'emergency.title',
            'emergency.description'
            )
            ->where('emergency_log.responded','=', 0)
            ->where(DB::raw('Date(emergency_log.created_at)'),'=', DB::raw('Date(NOW())'))
            ->orderByRaw('emergency_log.created_at desc')
            ->get();
        return  compact('records','total_report','responded_report','unresponded_report');
    }

    public function responded($id,$status)
    {
       
        DB::table('emergency_log')
        ->where('id', $id)
        ->update(
            ['responded' => $status,
            'updated_at' => DB::raw('NOW()')
            ]
        );
        
        return 'success';
    }

    public function respondedNote($id,$status,$note){
        DB::table('emergency_log')
        ->where('id', $id)
        ->update(
            ['responded' => $status,
            'admin_note' => $note,
            'updated_at' => DB::raw('NOW()')
            ]
        );
        
        return 'success';
    }

     public function destroy($id)
    {
        DB::table('emergency_log')->where('id', '=', $id)->delete();

        return 'success';
    }
}
