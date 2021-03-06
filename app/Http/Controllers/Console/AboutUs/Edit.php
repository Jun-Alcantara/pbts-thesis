<?php

namespace App\Http\Controllers\Console\AboutUs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\AboutUs;

class Edit extends Controller
{
    public function __invoke(Request $request)
    {
        $aboutus = AboutUs::first();

        $data['aboutus'] = null;
        if( $aboutus ){
            $data['aboutus'] = $aboutus->about_us;
        }
        
        $data['active_tab'] = "aboutus";
        return view('console.aboutus.edit', $data);
        return $request->all();
    }
}
