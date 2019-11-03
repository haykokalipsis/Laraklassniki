<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use phpDocumentor\Reflection\Types\Integer;

class ProfileController extends Controller
{
    public function index()
    {
        $images = auth()->user()->images;
        return view('profile', compact(['images']));
    }

    public function user(User $user)
    {
        $images = $user->images;
        return view('user', compact(['user', 'images']));
    }

    public function unreadMessages()
    {

        return auth()->user()->unreadNotifications; // Laravels default relation
    }

    public function edit()
    {
//        return view('profile.edit')->with('profile', auth()->user()->profile);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'location' => 'sometimes|max:255',
            'about' => 'sometimes|max:255',
            'name' => 'required|max:255',
            'email' => 'required|unique:users,email,' . auth()->id(),
        ]);

        auth()->user()->fill($request->all())->save();

        return redirect()->back()->with('success', 'Profile updated!');
    }

    public function uploadImages(Request $request)
    {
//        if($request->images) {
//            $this->base64Validation();
//            $rules['images'] = 'image64:jpeg,jpg,bmp,png,gif';
//        }
//
//        $this->validate($request, $rules);


        if ($request->images)
            Image::uploadImages($request->images);

        return response()->json('success', 200);
    }

    public function base64Validation()
    {
        Validator::extend('image64', function ($attribute, $value, $parameters, $validator) {
            $type = explode('/', explode(':', substr($value, 0, strpos($value, ';')))[1])[1];
            if (in_array($type, $parameters)) {
                return true;
            }
            return false;
        });

        Validator::replacer('image64', function($message, $attribute, $rule, $parameters) {
            return str_replace(':values',join(",",$parameters),$message);
        });
    }

    public function setMain(Request $request)
    {
//        $images = auth()->user()->images;
//        dd($images);

        $images = auth()->user()->images()->whereMain(1)->update([
            'main' => 0
        ]);

        $image = Image::find($request->id);

        $image->update([
            'main' => 1
        ]);


        return response()->json($image->thumbnail_path);
    }
}
