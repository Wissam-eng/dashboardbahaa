<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index')->with(['users' => $users]);
    }






    public function create()
    {
        return view('users.create');
    }




    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:1|confirmed',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->except('img');

        $imagePath = null;
        if ($request->hasFile('img') && $request->file('img')->isValid()) {
            $imagePath = $request->file('img')->store('users', 'public');
        }


        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'img' => isset($imagePath) ? $imagePath : null,
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully!');
    }






    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }




    public function update(Request $request, $id)
    {


        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:1',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::findOrFail($id);

        $imagePath = $user->img;
        if ($request->hasFile('img') && $request->file('img')->isValid()) {
            if ($user->img) {
                Storage::disk('public')->delete($user->img);
            }
            $imagePath = $request->file('img')->store('users', 'public');
        }

        $password = $request->password;

        if($password == ''){

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'img' => $imagePath,
            ]);

        }else{

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password ? Hash::make($request->password) : $user->password,
                'img' => $imagePath,
            ]);
        }


        return redirect()->route('users.index')->with('message_flash', 'user data uodated successfuly');
    }






    public function destroy($id)
    {
        dd($id);
        $user = User::withTrashed()->find($id);

        if ($user) {
            $user->forceDelete();
            return redirect()->route('users.index')->with('success', 'تم حذف المستخدم بنجاح!');
        } else {
            return redirect()->route('users.index')->with('error', 'المستخدم غير موجود!');
        }
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'تم حذف المستخدم بنجاح!');
    }








    public function restore($id)
    {



        $user = User::withTrashed()->find($id);
        if ($user) {
            $user->restore();
            return redirect()->route('users.index')->with('success', 'Slide restored successfully');
        }
        return  redirect()->back()->with('error', 'Slide not found');
    }




    public function trash()
    {
        $users = User::onlyTrashed()->get();


        return view('users.trash', ['users' => $users]);
    }
}
