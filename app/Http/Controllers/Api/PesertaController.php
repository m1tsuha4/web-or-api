<?php

namespace App\Http\Controllers\Api;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;

class PesertaController extends Controller
{
    public function show($id)
    {
        $profile = Profile::whereId($id)->first();
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
