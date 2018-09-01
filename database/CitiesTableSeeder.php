<?php

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = RajaOngkir::Kota()->all();

        $insert_city = [];
        foreach($data as $city)
        {
            $insert_city[] = [
                'id'            => $city['city_id'],
                'province_id'   => $city['province_id'],
                'type'          => $city['type'],
                'city'          => $city['type'] == "Kabupaten" ? "Kab. ".$city['city_name'] : $city['city_name'],
                'postal_code'   => $city['postal_code'],
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s')
            ];
        }

        DB::table('cities')->insert($insert_city);
    }
}
