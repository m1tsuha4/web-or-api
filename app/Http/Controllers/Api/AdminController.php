<?php

namespace App\Http\Controllers\Api;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;

class AdminController extends Controller
{
    public function show_all()
    {
        $profile = Profile::latest()->get();
        return new ProfileResource(true, 'List Data Profile', $profile);
    }
    public function show_auser(Request $request)
    {
        $profile = Profile::find($request->id);
        if ($profile) {
            return response()->json([
                'success' => true,
                'message' => 'Detail Profile!',
                'data'    => $profile
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Profile Tidak Ditemukan!',
                'data'    => ''
            ], 401);
        }
    }
    public function status_aktif(Request $request)
    {
        $profile = Profile::find($request->id);
        $profile->status_aktif = $request->status_aktif;
        $profile->save();
        return new ProfileResource(true, 'Status Aktif Telah Diubah!', $profile);
    }
    public function validation_status(Request $request)
    {
        $profile = Profile::find($request->id);
        $profile->validation_status = $request->validation_status;
        $profile->save();
        return new ProfileResource(true, 'Validation Status Berhasil Diubah!', $profile);
    }
}
