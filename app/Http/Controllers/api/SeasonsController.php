<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Series;
use Illuminate\Http\Request;

class SeasonsController extends Controller
{
    public function index(Series $series)
    {
        return $series->seasons;
    }
}
