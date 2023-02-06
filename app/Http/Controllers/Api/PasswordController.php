<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $validate = $request->validate([
            'new_password' => 'required|min:5|max:20',
            'confirm_password' => 'required|min:5|max:20',
        ]);

        if ($validate['new_password'] == $validate['confirm_password']) {
            $user = User::where('id', $request->user()->id)->first()->fill([
                'password' => bcrypt($validate['new_password'])
            ])->save();
        }
        if(isset($user)) {
            return response()->json([
                    'success' => true,
                    'user'    => $user,  
                ], 201);
            }  
            //return JSON process insert failed 
            return response()->json([
                'success' => false,
            ], 409);
        
    }
}
