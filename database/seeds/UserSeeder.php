<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(User::class, 50)->create();
        User::create([
            'name' => 'Carlos Flores',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('1234'), // password
            'dni'=>'12345678' ,
            'adress'=> 'caracas',
            'phone'=> '04125150853',
            'role'=> 'admin'
        ]);
        $users = factory(App\User::class, 40)
            ->create();
    }
}
