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
//        foreach ($cars as $car)
//        {
//            dd($car->CarImages);
//        }
        //dd($cars);
        //dd($cars[0]->CarImages);
        return view("cars.index", compact('cars'));
    }

    public function Create(Request $request)
    {
        return view("cars.create");
    }

    public function Store(Request $request)
    {
        $files = $request->file('images');

        if($request->hasFile('images'))
        {
            foreach ($files as $file) {
                $fileName = 'profile-'.uniqid().'.'.$file->getClientOriginalExtension();

                $path = $file->storeAs('public\files', $fileName);

            }
        }
        return view("cars.create");
    }
}
