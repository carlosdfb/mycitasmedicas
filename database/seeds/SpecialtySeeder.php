<?php

use App\specialty;
use App\User;
use Illuminate\Database\Seeder;

class SpecialtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specialties = [
            'Oftamologia',
            'Pediatria',
            'Traumatologia',
            'Neurologia',
            'Medicina General',

        ];

        foreach ($specialties as $specialtyName) {
           $specialty= specialty::create(
                [
                    'name' => $specialtyName
                ]);

            $specialty->users()->saveMany(
                factory(User::class,3)
                    ->states('doctor')
                    ->make()
            );
        }
        // medico test
        User::find(3)->specialties()->save($specialty);
    }
}
