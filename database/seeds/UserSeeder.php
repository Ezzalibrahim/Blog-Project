<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // get user using Elequent ORM we need App\User
        $user2 = User::where('email', 'brahim@gmail.com')->get();
        // get user using query builder we need Facades\DB
        $user = DB::table('users')->where('email', 'brahim@gmail.com')->first();

        if (!$user) {
            User::create([
                'email' => 'brahim@gmail.com',
                'name' => 'barhim',
                'password' => Hash::make('123456'),
                'role' => 'admin',
                'image' => 'images/admin.png'
            ]);
        }
    }
}
