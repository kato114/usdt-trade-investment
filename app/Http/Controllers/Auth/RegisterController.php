<?php

namespace App\Http\Controllers\Auth;

use App\File;
use App\Notifications\RegistrationRequest;
use App\Registration;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'number' => ['required', 'string', 'max:255'],
            'id_type' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'referee' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        \DB::beginTransaction();
        $registration = Registration::create([
            'name' => $data['name'],
            'referee' => $data['referee'],
            'email' => $data['email'],
            'phone' => ' ',
            'residential_address' => ' ',
            'id_type' => $data['id_type'],
            'id_number' => $data['number'],
            'password' => Hash::make($data['password']),
        ]);
        $registration->selfieProof()->associate(File::from($data['selfie'], 'files'));
        $registration->idNumberProof()->associate(File::from($data['photo_id'], 'files'));
        $registration->save();
        \DB::commit();
        foreach (User::query()->where('user_mail','=','1')->get() as $user) {
            
            
            
            $user->notify(new RegistrationRequest($registration));
        }
        return $registration;
    }

    /**
     * Handle a registration request for the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        return $this->registered($request, $user)
            ?: redirect('https://localhost/25-percent/');
    }

    /**
     * The user has been registered.
     *
     * @param \Illuminate\Http\Request $request
     * @param mixed $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        return view('auth.registered');
    }
}
