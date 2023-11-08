<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Jenssegers\Mongodb\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'id'=> "MAH-001",
            'name' => "H. Bambang Subroto",
            'role' => "Ketua",
            'divisi' => "DKM",
            'email' => "test@gmail.com",
            // 'email_verified_at' => date('Y-m-d H:i:s', time()),
            'password' => Hash::make('12345678'),
        ]);

        User::create([
            'id'=> "MAH-002",
            'name' => "Pepen",
            'role' => "Ketua",
            'divisi' => "KKW",
            'email' => "test1@gmail.com",
            // 'email_verified_at' => date('Y-m-d H:i:s', time()),
            'password' => Hash::make('123456789'),
        ]);

        User::create([
            'id'=> "MAH-003",
            'name' => "Ir. Sutarman",
            'role' => "Ketua",
            'divisi' => "Zakat",
            'email' => "test2@gmail.com",
            // 'email_verified_at' => date('Y-m-d H:i:s', time()),
            'password' => Hash::make('1234567890'),
        ]);

        User::create([
            'id'=> "MAH-004",
            'name' => "H. Mukhri Edy",
            'role' => "Ketua",
            'divisi' => "BMM",
            'email' => "test3@gmail.com",
            // 'email_verified_at' => date('Y-m-d H:i:s', time()),
            'password' => Hash::make('12345678901'),
        ]);
    }
}
