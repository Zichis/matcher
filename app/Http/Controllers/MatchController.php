<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class MatchController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Property $property
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Property $property)
    {
        return $property;
    }
}
