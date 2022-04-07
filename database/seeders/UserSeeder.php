<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createGuestUser();

        User::factory(100)->create();
    }

    private function createGuestUser()
    {
        User::insert([
            'name' => 'Guest',
            'username' => 'guest',
            'email' => 'guest@bitbook.com',
            'password' => Hash::make('bb_pass_789'),
        ]);
    }
}
