<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'img' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:5000'],
        ]);
    }

    protected function create(array $data)
    {



        $imagePath = null;
        if (isset($data['profile_image'])) {
            $imagePath = $data['profile_image']->store('profile_images', 'public');
        }

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'profile_image' => $imagePath,
        ]);
    }

    public function register(Request $request)
    {


        $this->validator($request->all())->validate();

        $data = $request->all();
        if ($request->hasFile('profile_image')) {
            $data['profile_image'] = $request->file('profile_image');
        }

        $user = $this->create($data);

        return redirect($this->redirectPath());
    }
}
