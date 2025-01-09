<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class SlideController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth')->except('all_slides');
    }







    public function index(Request $request)
    {
        $id = $request->query('id');

        if ($id) {
            $slides = Slide::where('type', $id)->get();
        } else {
            $slides = Slide::all();
        }



        return view('slides.index')->with(['slides' => $slides, 'id' => $id, 'type_page' => 'untrashed']);
    }


    public function all_slides($id)
    {


        if ($id) {
            $slides = Slide::where('type', $id)->get();
        } else {
            $slides = Slide::all();
        }

        return response()->json([
            'slides' => $slides,
            'id' => $id,
            'type_page' => 'untrashed',
        ]);
    }





    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|numeric|max:255',
            'text' => 'nullable|string|max:255',
            'img' => 'nullable|mimes:jpeg,png,jpg,gif,svg,mp4,avi,mov|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('dashboard.index')->with('error', 'There is a lack of data .. img or text ');
        }

        if ($request->hasFile('img')) {
            $imagePath = $request->file('img')->store('slides', 'public');
        } else {
            return redirect()->back()->withErrors(['img' => 'The image is required.']);
        }

        $slide = Slide::create([
            'type' => $request->type,
            'text' => $request->text,
            'img' => $imagePath,
        ]);

        if (!$slide) {
            return redirect()->route('dashboard.index')->with('error', 'An error occurred while saving the slide.');
        }

        return redirect()->route('dashboard.index')->with('success', 'Slide created successfully.');
    }



    public function show($type)
    {

        $id = $type;

        if ($id) {
            $slides = Slide::where('type', $id)->get();
        } else {
            $slides = Slide::all();
        }



        return view('slides.index')->with(['slides' => $slides, 'id' => $id, 'type_page' => 'untrashed']);
    }





    public function edit(Slide $slide)
    {
        return view('dashboard.edit', compact('slide'));
    }

    public function update(Request $request, Slide $slide)
    {

        $validator = Validator::make($request->all(), [
            'text' => 'nullable|string|max:255',
            'img' => 'nullable|mimes:jpeg,png,jpg,gif,svg,mp4,avi,mov|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('dashboard.index')->with('error', 'There is a lack of data .. img or text ');
        }

        if ($request->hasFile('img')) {
            if ($slide->image_path && Storage::exists('public/' . $slide->image_path)) {
                Storage::delete('public/' . $slide->image_path);
            }

            $imagePath = $request->file('img')->store('slides', 'public');

            $slide->update([
                'text' => $request->text,
                'img' => $imagePath,
            ]);
        } else {
            $slide->update([
                'text' => $request->text,
            ]);
        }

        return redirect()->route('dashboard.index')->with('success', 'Slide updated successfully.');
    }



    public function delete2($id)
    {
        $slide = Slide::findOrFail($id);
        $slide->delete();

        return redirect()->route('dashboard.slides.index')->with('success', 'Slide deleted successfully.');
    }


    public function destroy($id)
    {

        $slide = Slide::onlyTrashed()->find($id); // Find by ID in the trashed slides

        if ($slide) {
            $slide->forceDelete();
        }

        return redirect()->route('dashboard.index')->with('success', 'Slide deleted successfully.');
    }




    public function delete($id)
    {
        $slide = Slide::find($id);
        $slide->delete();
        return redirect()->route('dashboard.index')->with('success', 'Slide moved to trash');
    }





    public function restore($id)
    {



        $slide = Slide::withTrashed()->find($id);
        if ($slide) {
            $slide->restore();
            return redirect()->route('dashboard.index')->with('success', 'Slide restored successfully');
        }
        return redirect()->route('dashboard.index')->with('error', 'Slide not found');
    }




    public function trash($id)
    {
        $slides = Slide::onlyTrashed()->where('type', $id)->get();

        // Check if the trashed slides are empty and return a redirect to the same route
        if ($slides->isEmpty()) {

            return view('slides.index', ['slides' => $slides, 'id' => $id, 'type_page' => 'trashed'])
                ->with('error', 'No trashed slides found for this type');
        }

        return view('slides.index', ['slides' => $slides, 'id' => $id, 'type_page' => 'trashed']);
    }
}
