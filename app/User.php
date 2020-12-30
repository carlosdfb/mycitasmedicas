<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'dni', 'adress', 'phone', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','pivot'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function specialties()
    {
        return $this->belongsToMany(specialty::class)->withTimestamps();

    }

    public function scopePatients($query)
    {
        return $query->where('role', 'patient');
    }

    public function scopeDoctors($query)
    {
        return $query->where('role', 'doctor');
    }

    // $user -> asPatientAppointments ->requestAppointments
    // $user -> asDoctorAppointments ->attendendAppointments
    public function asDoctorAppointments()
    {
        return $this->hasMany(Appointment::class,'doctor_id');
    }
    public function asPatientAppointments()
    {
        return $this->hasMany(Appointment::class,'patient_id');
    }

    public function attendendAppointments()
    {
        return $this->asDoctorAppointments()->where('status','Atendida');
    }
    public function cancelledAppointments()
    {
        return $this->asDoctorAppointments()->where('status','Cancelada');
    }
}
