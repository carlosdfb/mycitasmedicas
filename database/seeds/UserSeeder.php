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
            'role'=> 'admin'
        ]);
        User::create([
            'name' => 'Paciente 1',
            'email' => 'paciente1@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('1234'), // password
            'role'=> 'patient'
        ]);
        User::create([
            'name' => 'Medico 1',
            'email' => 'doctor@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('1234'), // password
            'role'=> 'doctor'
        ]);
        factory(User::class, 50)
            ->state('patient')
            ->create();
    }
}
