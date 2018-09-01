<?php

use Illuminate\Database\Seeder;

class ProvincesTableseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = RajaOngkir::Provinsi()->all();

        $insert_province = [];
        foreach($data as $province)
        {
            $insert_province[] = [
                'id'            => $province['province_id'],
                'province'      => $province['province'],
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s')
            ];
        }

        DB::table('provinces')->insert($insert_province);
    }
}
