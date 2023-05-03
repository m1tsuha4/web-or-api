<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
        /**
     * fillable
     *
     * @var array
     */

    public function user(){
        return $this->belongsTO(User::class);
    }
    protected $fillable = [
        'nama_lengkap',
        'user_id',
        'nim',
        'divisi',
        'sub_divisi',
        'fakultas',
        'jurusan',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'asal',
        'no_hp',
        'agama',
        'hobi',
        'cita_cita',
        'riwayat_penyakit',
        'laptop',
        'processor',
        'RAM',
        'VGA',
        'foto',
        'krs',
        'bukti_pembayaran',
        'status_aktif',
        'zona',
    ];
}
