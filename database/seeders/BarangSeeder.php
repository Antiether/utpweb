<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barang;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        $barangs = [
            [
                'nama_barang' => 'Laptop Lenovo ThinkPad',
                'deskripsi' => 'Laptop dengan prosesor i5 dan RAM 8GB',
                'stok' => 5,
            ],
            [
                'nama_barang' => 'Proyektor Epson X300',
                'deskripsi' => 'Proyektor untuk presentasi ruang kelas',
                'stok' => 3,
            ],
            [
                'nama_barang' => 'Kamera Canon EOS 80D',
                'deskripsi' => 'Kamera DSLR untuk dokumentasi kegiatan',
                'stok' => 2,
            ],
            [
                'nama_barang' => 'Speaker Portable JBL',
                'deskripsi' => 'Speaker Bluetooth untuk acara luar ruangan',
                'stok' => 4,
            ],
        ];

        foreach ($barangs as $barang) {
            Barang::create($barang);
        }
    }
}