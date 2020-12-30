<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected  $fillable =[
        'description',
        'specialty_id',
        'doctor_id',
        'patient_id',
        'schedule_date',
        'schedule_time',
        'type'
    ];

/*    protected $date = [
      'schedule_time' // createFromFormat este es el metodo ue utiliza
    ];*/
    // N $appointments -> $specialty 1
    public function specialty(){
        return $this->belongsTo(specialty::class);
    }


    // N $appointments -> $doctor 1
    public function doctor(){
        return $this->belongsTo(User::class);
    }
    // N $appointments -> $patients 1
    public function patient(){
        return $this->belongsTo(User::class);
    }
    // 1 $appointments has one -> cancel -> justification 1/0
    public function cancellation(){
        return $this->hasOne(CancelledAppointment::class);
    }
    // accesor
    // $appointments ->schedule_time_12
    public function getScheduleTime12Attribute($key)
    {
        return (new Carbon($this->schedule_time))
        ->format('g:i  A');
    }
}
