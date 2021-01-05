<?php

namespace App\Http\Controllers;

use App\File;
use App\Member;
use App\Photo;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use League\ISO3166\ISO3166;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:client,admin');
    }

    public function index()
    {
        $countries = collect((new ISO3166())->all())->map(function ($e) {
            return (object)$e;
        });

        $user = auth()->user();
        return view('auth.profile', compact('user', 'countries'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
//die(print_r($request));
        DB::beginTransaction();

        if (!$request->hasFile('image')) {
            $table = strtolower(Str::plural(class_basename($user)));
            $rules = [
                'name' => 'required',
                'email' => sprintf('required|email|unique:%s,id,%s', $table, $user->id)
            ];

            $this->validate($request, $rules);
            $user->fill($request->only('name', 'email','wallet'));
            $user->save();

        } else {
            $file = File::from($request->file('image'), 'images');
           // die(print_r($file));
            $photo = new Photo();
            $photo->file()->associate($file);
            $photo->profile_type = class_basename($user);
            $photo->profile_id = $user->id;

            $user->photos()->get()->map(function ($e) {
                $e->delete();
            });

            $user->photos()->save($photo);
        }
        DB::commit();
        return $this->index()->with('message', 'Photo Updated!');
    }

    public function changePassword(Request $request)
    {
        $user = auth()->user();

        $rules = [
            'current_password' => 'required',
            'password' => 'required|confirmed|min:6',
        ];

        $this->validate($request, $rules);

        if (Hash::check($request->current_password, $user->password)) {
            $user->password = bcrypt($request->password);
            $user->save();
        } else {
            $countries = collect((new ISO3166())->all())->map(function ($e) {
                return (object)$e;
            });
            return view('auth.profile', compact('user', 'countries'))
                ->withErrors(['current_password' => ['Current password doesn\'t is wrong']]);
        }

        return $this->index()->with('message', 'Password Changed!');
    }
}
