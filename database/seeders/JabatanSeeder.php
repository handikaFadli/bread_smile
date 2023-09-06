<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Jabatan::create(
            [
                'nm_jabatan' => 'Presiden Direktur'
            ]
        );

        Jabatan::create(
            [
                'nm_jabatan' => 'Direktur'
            ]
        );

        Jabatan::create(
            [
                'nm_jabatan' => 'Manager'
            ]
        );

        Jabatan::create(
            [
                'nm_jabatan' => 'Supervisor'
            ]
        );

        Jabatan::create(
            [
                'nm_jabatan' => 'Staff'
            ]
        );

        Jabatan::create(
            [
                'nm_jabatan' => 'Sekretaris'
            ]
        );
    }
}
