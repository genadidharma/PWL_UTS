<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 20; $i++) {
            $kategori = ['Makanan', 'Minuman', 'Snack', 'Rempah-rempah'];
            $kategori_rand = array_rand($kategori, 1);

            $id = DB::table('barang')->insertGetId(
                [
                    'nama_barang' => $faker->word(),
                    'kategori_barang' => $kategori[$kategori_rand],
                    'harga' => round($faker->numberBetween(5000, 30000), -3),
                    'qty' => $faker->numberBetween(1, 100),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ]
            );

            DB::table('barang')->where('id_barang', $id)
                ->update([
                    'kode_barang' => 'PRD' . str_pad($id, 3, '0', STR_PAD_LEFT)
                ]);
        }
    }
}
