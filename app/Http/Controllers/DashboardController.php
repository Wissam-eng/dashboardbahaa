<?php

namespace App\Http\Controllers;


use Carbon\Carbon;

use App\Models\dashboard;
use App\Models\Booke;
use App\Models\contacts;
use Illuminate\Http\Request;

class DashboardController extends Controller
{



    public function __construct()
    {
        $this->middleware('auth');
    }






    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $today = Carbon::today();
        $bookes = Booke::whereDate('created_at', $today)->get()->reverse();
        $contacts = contacts::whereDate('created_at', $today)->get()->reverse();

        return view('dashboard.index')->with(['bookes' => $bookes , 'contacts' => $contacts]);
    }



    public function note()
    {
        $today = Carbon::today();
        $bookes = Booke::whereDate('created_at', $today)->get()->reverse();
        $contacts = contacts::whereDate('created_at', $today)->get()->reverse();

        return view('layout.app')->with(['bookes' => $bookes , 'contacts' => $contacts]);
    }







    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($dashboard)
    {
        return view('dashboard.tables', compact('dashboard'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(dashboard $dashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, dashboard $dashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(dashboard $dashboard)
    {
        //
    }
}
