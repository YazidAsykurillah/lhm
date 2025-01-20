<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PendaftaranModel extends Model
{
    protected $table = 'ck_jamaah';
    protected $fillable = ['nama_jamaah', 'jenis_kelamin', 'tanggal_lahir', 'no_hp', 'email'];

    /**
     * Create a new jamaah record and insert related data into the ck_tabungan table.
     *
     * @param array $jamaahData
     * @param int $umrahId
     * @return mixed
     */
    public static function createWithTabungan(array $jamaahData, int $umrahId)
    {
        return DB::transaction(function () use ($jamaahData, $umrahId) {
            // Insert data into ck_jamaah
            $jamaah = self::create($jamaahData);

            // Insert data into ck_tabungan
            DB::table('ck_tabungan')->insert([
                'jamaah_id' => $jamaah->id,
                'umrah_id' => $umrahId,
                'tanggal_pendaftaran' => date('Y-m-d H:i:s'),
                'keterangan' => null, // Default null, can be updated as needed
                'activated_status' => 1, // Default activated
            ]);

            return $jamaah;
        });
    }
}