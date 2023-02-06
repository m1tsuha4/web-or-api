<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Models\Profile;

class UserController extends Controller
{
    public function index(){

        ////get posts
        $users = User::latest()->get();
        $profiles = Profile::latest()->get();
        //return collection of posts as a resource
        return new UserResource(true, 'List Data Users', $users);
        return new UserResource(true, 'List Data Profile', $profiles);

    }
    public function show($id)
    {
        $profile = Profile::whereId($id)->profile;
        if ($profile) {
            return response()->json([
                'success' => true,
                'message' => 'Detail Post!',
                'data'    => $profile
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Post Tidak Ditemukan!',
                'data'    => ''
            ], 401);
        }

    }


}
