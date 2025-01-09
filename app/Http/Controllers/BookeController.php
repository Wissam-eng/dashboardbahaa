<?php

namespace App\Http\Controllers;

use App\Models\booke;
use Illuminate\Http\Request;
use App\Events\notification;

class BookeController extends Controller
{



    public function __construct()
    {
        $this->middleware('auth')->only('index');
    }






    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookes = booke::all()->reverse();
        return view('bookes.index')->with('bookes', $bookes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bookes.create');
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name'   => 'required|string|max:255',
            'second_name'  => 'required|string|max:255',
            'mobile'       => 'required|string|max:15',
            'address'      => 'nullable|string|max:500',
            'visit_date'   => 'required|date',
            'note'         => 'nullable|string|max:1000',
        ]);

        try {


            $booke = Booke::create($validatedData);


            $data = [
                'first_name'   => $validatedData['first_name'],
                'second_name'  => $validatedData['second_name'],
                'mobile'       => $validatedData['mobile'],
                'address'      => $validatedData['address'],
                'visit_date'   => $validatedData['visit_date'],
            ];

            event(new BookeController($data));

            return redirect()->route('bookes.create')->with('success', 'Your booking has been successfully added!');
        } catch (\Exception $e) {
            return redirect()->route('bookes.create')->with('error', 'An error occurred while adding your booking.');
        }
    }



    public function store_api(Request $request)
    {
        $validatedData = $request->validate([
            'first_name'   => 'required|string|max:255',
            'second_name'  => 'required|string|max:255',
            'mobile'       => 'required|string|max:15',
            'address'      => 'nullable|string|max:500',
            'visit_date'   => 'required|date',
            'note'         => 'nullable|string|max:1000',
        ]);

        try {
            $booke = Booke::create($validatedData);


            $data = [
                'first_name'   => $validatedData['first_name'],
                'second_name'  => $validatedData['second_name'],
                'mobile'       => $validatedData['mobile'],
                'address'      => $validatedData['address'],
                'visit_date'   => $validatedData['visit_date'],
            ];

            event(new BookeController($data));

            // Return a success response in JSON format
            return response()->json([
                'message' => 'Your booking has been successfully added!',
                'data' => $booke,
            ], 201) ;


        } catch (\Exception $e) {
            // Return an error response in JSON format
            return response()->json([
                'message' => 'An error occurred while adding your booking.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }






    /**
     * Display the specified resource.
     */
    public function show(booke $booke)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(booke $booke)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, booke $booke)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(booke $booke)
    {
        //
    }
}
