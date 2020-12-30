<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\specialty;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    public function doctors(specialty $specialty) {

        return $specialty->users()->get(['users.id','users.name']);


    }
}
