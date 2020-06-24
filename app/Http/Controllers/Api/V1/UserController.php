<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
      public function login(Request $request)
    {
        $records = DB::table('user_information')
        ->select('*')
        ->where('email','=', $request->email)
        ->where('password','=',$request->password)
        ->orderByRaw('created_at desc')
        ->limit(1)
        ->get();

        return  compact('records');
    }

      public function register(Request $request)
    {
        
        $response = 1;
         if(!$request->email && !$request->password){
             $response = 1;
            return compact('response');
        }

        $user_exist = DB::table('user_information')
        ->where('email','=', $request->email)
        ->count();

        if($user_exist >0){
            $response = 1;
            return compact('response');
        }
        
        $email = "no";
        if($request->email){
            $email =$request->email;
        }
        $cover = $request->file('userprofile');
        $extension = $cover->getClientOriginalExtension();
        Storage::disk('public')->put( $request->email.'.'.$extension,  File::get($cover));

         DB::table('user_information')->insert(
            ['name' => $request->name,
            'address' => $request->address,
            'dob' => $request->dob,
            'photo' => $request->email.'.'.$extension,
            'email' => $request->email,
            'number' => $request->number,
            'password' => $request->password,
            'created_at' => DB::raw('DATE_ADD(NOW(), INTERVAL 8 HOUR)')
            ]
        );

        $response = 0;
        return compact('response');
        
    }

    public function storeprofile(Request $request){
        $email = "no";
        if($request->email){
            $email =$request->email;
        }
        $cover = $request->file('userprofile');
        $extension = $cover->getClientOriginalExtension();
        Storage::disk('public')->put( $email.'.'.$extension,  File::get($cover));
        
         $response = 0;
        return compact('response');
    }

      public function update(Request $request)
    {
       
        $cover = $request->file('userprofile');
        $extension = $cover->getClientOriginalExtension();
        Storage::disk('public')->put( $request->email.'.'.$extension,  File::get($cover));


        DB::table('user_information')
        ->where('email', $request->email)
        ->update(
            ['name' => $request->name,
            'address' => $request->address,
            'number' => $request->number,
            'dob' => $request->dob,
            'photo' => $request->email.'.'.$extension,
            'password' => $request->password,
            'updated_at' => DB::raw('DATE_ADD(NOW(), INTERVAL 8 HOUR)')
            ]
        );

        $response = 0;
        return compact('response');
    }
}
