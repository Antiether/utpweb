<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Peminjaman extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'barang_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
        'catatan_terenkripsi',
    ];

    // otomatis enkripsi & dekripsi kolom catatan
    public function setCatatanTerenkripsiAttribute($value)
    {
        $this->attributes['catatan_terenkripsi'] = Crypt::encryptString($value);
    }

    public function getCatatanTerenkripsiAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    // relasi
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}