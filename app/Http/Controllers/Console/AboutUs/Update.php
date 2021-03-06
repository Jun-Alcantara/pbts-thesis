<?php

namespace App\Http\Controllers\Console\AboutUs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\AboutUs;

class Update extends Controller
{
    public function __invoke(Request $request)
    {
        $about_us = AboutUs::first();
        if (empty($about_us)) {
            AboutUs::create([
                'about_us' => $request->aboutus
            ]);
        } else {
            $about_us->about_us = $request->aboutus;
            $about_us->save();
        }

        session()->flash('aboutus-updated');

        return back();
    }
}
