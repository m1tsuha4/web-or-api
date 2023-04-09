<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class ProfileController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get posts
        // $profiles = Profile::latest()->paginate(5);
        // return new ProfileResource(true, 'List Data Profile', $profiles);
    }

    public function store_profile(Request $request)
    {

        $request->validate([
            'nama_lengkap' => 'required',
            'nim' => 'required',
            'divisi' => 'required',
            'sub_divisi' => 'required',
            'fakultas' => 'required',
            'jurusan' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'asal' => 'required',
            'no_hp' => 'required',
            'agama' => 'required',
            'hobi' => 'required',
            'cita_cita' => 'required',
            'riwayat_penyakit' => 'required',
            'laptop' => 'required',
            'processor' => 'required',
            'RAM' => 'required',
            'VGA' => 'required',
        ]);
        // if ($validated->fails()) {
        //     return response()->json($validated->errors(), 422);
        // }
        $profile = Profile::insert([
            'user_id' => $request->user()->id,
            'nama_lengkap' => $request->nama_lengkap,
            'nim' => $request->nim,
            'divisi' => $request->divisi,
            'sub_divisi' => $request->sub_divisi,
            'fakultas' => $request->fakultas,
            'jurusan' => $request->jurusan,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'asal' => $request->asal,
            'no_hp' => $request->no_hp,
            'agama' => $request->agama,
            'hobi' => $request->hobi,
            'cita_cita' => $request->cita_cita,
            'riwayat_penyakit' => $request->riwayat_penyakit,
            'laptop' => $request->laptop,
            'processor' => $request->processor,
            'RAM' => $request->RAM,
            'VGA' => $request->VGA,
        ]);
        // return new ProfileResource(true, 'Data Profile Berhasil Ditambahkan!', $profile);
        if ($profile) {
            return response()->json([
                'succes' => true,
                'message' => 'Data Profile Berhasil Di Tambahkan!',
                'data' => $profile
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Profile Gagal Disimpan!',
                'data' => ''
            ], 401);
        }
    }
    public function update_profile(Request $request)
    {

        $request->validate([
            'nama_lengkap' => 'required',
            'nim' => 'required',
            'divisi' => 'required',
            'sub_divisi' => 'required',
            'fakultas' => 'required',
            'jurusan' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'asal' => 'required',
            'no_hp' => 'required',
            'agama' => 'required',
            'hobi' => 'required',
            'cita_cita' => 'required',
            'riwayat_penyakit' => 'required',
            'laptop' => 'required',
            'processor' => 'required',
            'RAM' => 'required',
            'VGA' => 'required',
        ]);
        // if ($validated->fails()) {
        //     return response()->json($validated->errors(), 422);
        // }
        $profile = Profile::where('user_id', $request->user()->id)->first();
        $profile->update([
            'user_id' => $request->user()->id,
            'nama_lengkap' => $request->nama_lengkap,
            'nim' => $request->nim,
            'divisi' => $request->divisi,
            'sub_divisi' => $request->sub_divisi,
            'fakultas' => $request->fakultas,
            'jurusan' => $request->jurusan,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'asal' => $request->asal,
            'no_hp' => $request->no_hp,
            'agama' => $request->agama,
            'hobi' => $request->hobi,
            'cita_cita' => $request->cita_cita,
            'riwayat_penyakit' => $request->riwayat_penyakit,
            'laptop' => $request->laptop,
            'processor' => $request->processor,
            'RAM' => $request->RAM,
            'VGA' => $request->VGA,
        ]);
        // return new ProfileResource(true, 'Data Profile Berhasil Ditambahkan!', $profile);
        if ($profile) {
            return response()->json([
                'succes' => true,
                'message' => 'Data Profile Berhasil Di Update!',
                'data' => $profile
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Profile Gagal Disimpan!',
                'data' => ''
            ], 401);
        }
    }

    public function store_file(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'krs' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload image
        $krs = $request->file('krs');
        $bukti_pembayaran = $request->file('bukti_pembayaran');
        $krs->storeAS('public/profiles', $krs->hashName());
        $bukti_pembayaran->storeAS('public/profiles', $bukti_pembayaran->hashName());

        //create profile
        $profile = Profile::where('user_id', $request->user()->id)->first();
        $profile->update([
            // 'user_id' => $request->user()->id,
            'krs' => $krs->hashName(),
            'bukti_pembayaran' => $bukti_pembayaran->hashName(),
        ]);
        return new ProfileResource(true, 'Data Profile Berhasil Ditambahkan!', $profile);
    }

    public function show(Request $request)
    {
        // $profile = $request->user()->id;
        $profile = Profile::where('user_id', $request->user()->id)->first();
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

    // public function update(Request $request)
    // {
    //     // define Validator
    //     $validator = Validator::make($request->all(), [
    //         'nama_lengkap' => 'required',
    //         'krs' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //         'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

    //     ]);
    //     if ($validator->fails()) {
    //         return response()->json($validator->errors(), 422);
    //     }
    //     //check if field empty
    //     $profile = Profile::where('user_id', $request->user()->id)->first();
    //     if ($request->hasFile('krs', 'bukti_pembayaran')) {
    //         //upload image
    //         $krs = $request->file('krs');
    //         $bukti_pembayaran = $request->file('bukti_pembayaran');
    //         $krs->storeAS('public/profiles', $krs->hashName());
    //         $bukti_pembayaran->storeAS('public/profiles', $bukti_pembayaran->hashName());
    //         //delete old image

    //         Storage::delete('public/profiles/' . $profile->krs);
    //         Storage::delete('public/profiles/' . $profile->bukti_pembayaran);
    //         //update
    //         $profile->update([
    //             'nama_lengkap' => $request->nama_lengkap,
    //             'divisi' => $request->divisi,
    //             'krs' => $krs->hashName(),
    //             'bukti_pembayaran' => $bukti_pembayaran->hashName(),
    //         ]);
    //     } else {
    //         //update without img
    //         $profile->update([
    //             'nama_lengkap' => $request->nama_lengkap,
    //             'divisi' => $request->divisi
    //         ]);
    //     }
    //     return new ProfileResource(true, 'Data Berhasil Diupdate!', $profile);
    // }

    // public function destroy(Profile $profile)
    // {
    //     //delete img
    //     Storage::delete('public/profiles/' . $profile->krs);
    //     Storage::delete('public/profiles/' . $profile->bukti_pembayaran);
    //     //delete profile
    //     $profile->delete();
    //     return new ProfileResource(true, 'Data Berhasil Dihapus!', null);
    // }
    public function store(Request $request)
    {
        $path = $request->file('file')->store('public/files');

        return response()->json([
            'message' => 'File saved successfully.',
            'path' => $path
        ]);
    }

    public function show_file($filename)
    {
        $path = storage_path('app/public/files/' . $filename);

        if (!file_exists($path)) {
            return response()->json(['message' => 'File not found.'], 404);
        }

        $file = file_get_contents($path);

        return response($file, 200)->header('Content-Type', mime_content_type($path));
        $file = Storage::get($path);
        // $type = Storage::mimeType($path);

        // $response = Response::make($file, 200);
        // $response->header("Content-Type", $type);
    
        // return $response;
    }
}
