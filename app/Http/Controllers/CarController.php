<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    //
    public function Index(Request $request)
    {
//        $cars = Car::query()->get();
//        dd($cars);
        //$cars = Car::query()->with("CarImages")->get();
        $cars = Car::query()->get();
        foreach ($cars as $car)
        {
            dd($car->CarImages);
        }
        //dd($cars);
        //dd($cars[0]->CarImages);
    }
}
