<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\SearchProfile;
use App\Services\MatchService;
use Illuminate\Http\Request;

class MatchController extends Controller
{
    public function __construct(MatchService $matchService)
    {
        $this->matchService = $matchService;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Property $property
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Property $property)
    {
        return $this->matchService->matchProperty($property);
    }
}
