<?php

namespace App\Services;


use App\Appointment;
use App\Interfaces\ScheduleServiceInterface;
use App\workday;
use Carbon\Carbon;

class ScheduleService implements ScheduleServiceInterface
{

    public function isAvailableInterval($date, $doctorId,Carbon $start)
    {
        $exists = Appointment::where('doctor_id', $doctorId)
            ->where('schedule_date', $date)
            ->where('schedule_time', $start->format('H:i:s'))
            ->exists();
        return !$exists; // available if already none exists
    }

    public function getAvailableIntervals($date, $doctorId)
    {
        $workDay = workday::where('active', true)
            ->where('day', $this->getDayFromDate($date))
            ->where('user_id', $doctorId)
            ->first(['morning_start',
                'morning_end',
                'afternoon_start',
                'afternoon_end'
            ]);
        if (!$workDay) {
            return [];
        }


        $morningIntervals = $this->getIntervals($workDay->morning_start, $workDay->morning_end, $date, $doctorId);
        $afternoonIntervals = $this->getIntervals($workDay->afternoon_start, $workDay->afternoon_end, $date, $doctorId);

        $data = [];
        $data['morning'] = $morningIntervals;
        $data['afternoon'] = $afternoonIntervals;

        return $data;
    }

    private function getDayFromDate($date)
    {
        /*Day Of week
        carbon 0 -> sunday 6 saturday
        work day 0 monday 6 sunday
        */
        $dateCarbon = new Carbon($date);
        $i = $dateCarbon->dayOfWeek;
//dd($i);
        $day = ($i == 0 ? $i = 6 : $i - 1);

        return $day;
    }


    private function getIntervals($start, $end, $date, $doctorId)
    {
        $start = new Carbon($start);
        $end = new Carbon($end);
        $intervals = [];

        while ($start < $end) {
            $interval = [];
            $interval['start'] = $start->format('g:i A');
            // intervlos dispnibles
            $available = $this->isAvailableInterval($date,$doctorId,$start);

            $start->addMinutes(30);
            $interval['end'] = $start->format('g:i A');

            if ($available) {
                $intervals[] = $interval;
            }
        }
        return $intervals;
    }
}
