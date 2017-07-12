<?php

namespace Pmis\Http\Controllers;

use Pmis\Eloquent\CensusInformation;
use Pmis\Eloquent\Report;
use Pmis\Eloquent\DepartmentDocument;

class HomeController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Home Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders your application's "dashboard" for users that
    | are authenticated. Of course, you are free to change or remove the
    | controller as you wish. It is just here to get your app started!
    |
    */

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['index']]);
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index(Report $report, DepartmentDocument $departmentdocument)
    {
        $reports = $report->getPaginated();
        $departmentdocuments = $departmentdocument->all();
        return view('home', compact('reports','departmentdocuments'));
    }

    /**
     * @param Report $report
     *
     * @return \Illuminate\View\View
     */
    public function frontIndex(Report $report)
    {
        return view('home', compact('reports'));
    }

    public function populationClock(CensusInformation $censusInformation)
    {
        $census = $censusInformation->active()->first();

        return view('frontend.population-clock', compact('census'));
    }
    public function backendPopulationClock(CensusInformation $censusInformation)
    {
        $census = $censusInformation->active()->first();

        return view('population-clock', compact('census'));
    }
}
