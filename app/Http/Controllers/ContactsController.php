<?php

namespace App\Http\Controllers;

use App\Models\contacts;
use Illuminate\Http\Request;

class ContactsController extends Controller
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
        $contacts = contacts::all();
        return view('contacts.index')->with('contacts', $contacts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|max:255',
            'message'  => 'nullable|string|max:1000',
        ]);

        try {
            $contacts = contacts::create($validatedData);

            return redirect()->route('contacts.create')->with('success', 'Your booking has been successfully added!');
        } catch (\Exception $e) {
            return redirect()->route('contacts.create')->with('error', 'An error occurred while adding your booking.');
        }
    }

    public function store_api(Request $request)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'name'   => 'required|string|max:255',
                'email'  => 'required|email|max:255',
                'message'  => 'nullable|string|max:1000',
            ]);

            // Store the contact in the database
            $contact = contacts::create($validatedData);

            // Return a success response
            return response()->json([
                'message' => 'Contact stored successfully',
                'data' => $contact,
            ], 201);
        } catch (\Exception $e) {
            // Return an error response if something goes wrong
            return response()->json([
                'message' => 'Error occurred while storing contact',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // public function store2(Request $request)
    // {


    //     // Return a success response
    //     return response()->json([
    //         'message' => 'Contact stored successfully',
    //         'data' => $request->all(),
    //     ], 201);
    // }




    /**
     * Display the specified resource.
     */
    public function show(contacts $contacts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(contacts $contacts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, contacts $contacts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(contacts $contacts)
    {
        //
    }
}
