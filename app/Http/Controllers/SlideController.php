<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use App\Models\User;
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











    public function gallery($id)
    {


        if ($id) {
            $slides = Slide::where('type', $id)->get();
        } else {
            $slides = Slide::all();
        }



        return view('gallery.index')->with(['slides' => $slides, 'id' => $id, 'type_page' => 'untrashed']);
    }


    public function all_slides($id)
    {
        if ($id) {
            $slides = Slide::where('type', $id)->get();
        } else {
            $slides = Slide::all();
        }

        // Loop through slides and modify the img path for the first one
        $slides->transform(function ($slide) {
            // Add "storage/" to each image path
            $slide->img = 'storage/' . $slide->img;
            return $slide;
        });


        switch ($id) {
            case 1:
                $arrayName = 'slide';
                break;
            case 2:
                $arrayName = 'Gallery';
                break;
            case 3:
                $arrayName = 'Our Group';
                break;
            case 4:
                $arrayName = 'Why Bahaa?';
                break;
            case 5:
                $arrayName = 'video';
                break;
            case 6:
                $arrayName = 'Customer opinions';
                break;
            case 7:
                $arrayName = 'blog';
                break;
            case 8:
                $arrayName = 'services';
                break;
            default:
                $arrayName = 'slides'; // Default value if no matching type
                break;
        }

        return response()->json([
            $arrayName => $slides, // Return slides with the updated img path
            'id' => $id,
            'type_page' => 'untrashed',
        ]);
    }


    public function get_blog($title)
    {
        $slides = Slide::where('blogUrl', $title)->get();

        return response()->json([
            'blog' => $slides

        ]);
    }








    public function store(Request $request)
    {
        $type = $request->type;

        $rules = [];
        if (in_array($type, [1, 6, 7, 8, 9])) {
            $rules = [
                'type' => 'required|numeric',
                'title' => 'required|string|max:255',
                'text' => 'required|string|max:255',
                'tag' => 'nullable|string|max:255',
                'blogUrl' => 'nullable|string|max:255',
                'img' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:width=1440,height=827',
            ];
        } elseif (in_array($type, [2, 3, 5])) {
            $rules = [
                'type' => 'required|numeric',
                'img' => 'required|mimes:jpeg,png,jpg,gif,svg,mp4,avi,mov|max:5000',
            ];
        } elseif ($type == 4) {
            $rules = [
                'type' => 'required|numeric',
                'title' => 'required|string|max:255',
                'text' => 'required|string|max:255',
            ];
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Invalid type provided.',
            ], 400);
        }

        // التحقق من البيانات
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        // تحميل الصورة إذا كانت موجودة
        $imagePath = null;
        if ($request->hasFile('img')) {
            $imagePath = $request->file('img')->store('slides', 'public');
        }

        try {
            // إنشاء السلايد
            $slide = Slide::create([
                'title' => $request->title,
                'type' => $request->type,
                'text' => $request->text,
                'tag' => $request->tag,
                'blogUrl' => $request->blogUrl,
                'rate' => $request->rating ?? null,
                'img' => $imagePath,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Slide created successfully.',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while creating the slide.',
                'error' => $e->getMessage(),
            ], 500);
        }
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
        $after = strstr($request->blogUrl, '/get_blog_data/');
        $after = substr($after, strlen('/get_blog_data/'));

        $request['blogUrl'] = $after;

        $type = $request->type ?? $slide->type;

        $rules = [];
        if (in_array($type, [1, 6, 7, 8, 9])) {
            $rules = [
                'type' => 'required|numeric',
                'title' => 'required|string|max:255',
                'text' => 'required|string|max:255',
                'tag' => 'nullable|string|max:255',
                'blogUrl' => 'nullable|string|max:255',
                'img' => 'nullable|mimes:jpeg,png,jpg,gif,svg,mp4,avi,mov|max:2048',
            ];
        } elseif (in_array($type, [2, 3, 5])) {
            $rules = [
                'type' => 'required|numeric',
                'img' => 'nullable|mimes:jpeg,png,jpg,gif,svg,mp4,avi,mov|max:2048',
            ];
        } elseif ($type == 4) {
            $rules = [
                'type' => 'required|numeric',
                'title' => 'required|string|max:255',
                'text' => 'required|string|max:255',
            ];
        } else {
            return redirect()->back()->with('message_flash', 'Invalid type provided.');
        }

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $imagePath = $slide->img;
        if ($request->hasFile('img')) {
            if ($imagePath && Storage::exists('public/' . $imagePath)) {
                Storage::delete('public/' . $imagePath);
            }

            $imagePath = $request->file('img')->store('slides', 'public');
        }

        try {
            $slide->update([
                'title' => $request->title ?? $slide->title,
                'type' => $type,
                'text' => $request->text ?? $slide->text,
                'tag' => $request->tag,
                'blogUrl' => $request->blogUrl,
                'rate' => $request->rating ?? $slide->rate,
                'img' => $imagePath,
            ]);

            return redirect()->back()->with('message_flash', 'Slide updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('message_flash', 'An error occurred while updating the slide.');
        }
    }







    public function delete2($id)
    {
        $slide = Slide::findOrFail($id);
        $slide->delete();

        return  redirect()->back()->with('success', 'Slide deleted successfully.');
    }


    public function destroy($id)
    {

        $slide = Slide::onlyTrashed()->find($id); // Find by ID in the trashed slides

        if ($slide) {
            $slide->forceDelete();
        }

        return  redirect()->back()->with('success', 'Slide deleted successfully.');
    }




    public function delete($id)
    {
        $slide = Slide::find($id);
        $slide->delete();
        return  redirect()->back()->with('success', 'Slide moved to trash');
    }





    public function restore($id)
    {



        $slide = Slide::withTrashed()->find($id);
        if ($slide) {
            $slide->restore();
            return redirect()->route('dashboard.index')->with('success', 'Slide restored successfully');
        }
        return  redirect()->back()->with('error', 'Slide not found');
    }




    public function trash($id)
    {
        $slides = Slide::onlyTrashed()->where('type', $id)->get();

        if ($id == 1 || $id  == 6 || $id  == 4 || $id == 7 || $id == 8 || $id == 9) {

            return view('slides.trash', ['slides' => $slides, 'id' => $id, 'type_page' => 'trashed']);
        } else {

            return view('gallery.trash', ['slides' => $slides, 'id' => $id, 'type_page' => 'trashed']);
        }
    }
}
