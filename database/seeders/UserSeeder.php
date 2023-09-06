<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'backoffice',
            'nip' => '20210120099',
            'password' => bcrypt('password'),
            'role' => 'backoffice',
            'id_karyawan' => '0'
        ]);
    }
}
