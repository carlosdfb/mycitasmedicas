<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Appointment;
use App\Model;
use App\User;
use Faker\Generator as Faker;

$factory->define(Appointment::class, function (Faker $faker) {
    $doctorId = User::doctors()->pluck('id');
    $patientsId = User::doctors()->pluck('id');
    $schedule = $faker->dateTimeBetween('-1 years', 'now');
    $schedule_date = $schedule->format('Y-m-d');
    $schedule_time = $schedule->format('H:i:s');
    $types = ['Consulta', 'Examen', 'Operacion'];
    $statususes = ['Atendida', 'Cancelada']; // 'Reservada','Confirmada',
    return [
        'description' => $faker->sentence(5),
        'specialty_id' => $faker->numberBetween(1, 5),
        'doctor_id' => $faker->randomElement($doctorId),
        'patient_id' => $faker->randomElement($patientsId),
        'schedule_date' => $schedule_date,
        'schedule_time' => $schedule_time,
        'type' => $faker->randomElement($types),
        'status' => $faker->randomElement($statususes)
    ];
});
