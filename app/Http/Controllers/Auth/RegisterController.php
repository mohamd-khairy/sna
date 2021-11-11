<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Http\Request;

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
    protected $redirectTo = RouteServiceProvider::HOME;
    // protected $redirectTo = '/events-registeration';

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
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        if(!empty($data['is_event_registeration'])){
            return Validator::make($data, [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'last_name' => ['string', 'min:3', 'max:50', 'required',],
            'national' => ['string', 'min:5', 'max:20', 'required',],
            'id_photo' => ['required'],
            'birth_date' => ['required', 'date_format:' . config('panel.date_format'),],
            'phone'=> ['string', 'required',],
            'country'=> ['string', 'required',],
            'nationality'=> ['string', 'required',],

        ]);
        }else{
            return Validator::make($data, [
                'name'     => ['required', 'string', 'max:255'],
                'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'program_id' => ['required',],
                'last_name' => ['string', 'min:3', 'max:50', 'required',],
                'full_name_en' => ['string', 'min:3', 'max:100', 'required',],
                'full_name_ar' => ['string', 'nullable',],
                'personal_photo'=> ['required',],
                'national' => ['string', 'min:5', 'max:20', 'required',],
                'id_photo' => ['required'],
                'birth_date' => ['required', 'date_format:' . config('panel.date_format'),],
                'phone'=> ['string', 'required',],
                'birth_country'=> ['string', 'required',],
                'country'=> ['string', 'required',],
                'state' => ['string', 'required',],
                'linkedin' => ['string', 'nullable',],
                'undergraduate'=> ['required',],
                'degree' => ['required',],
                'degree_photo' => ['required',],
                'personal_statement' => ['string', 'required',],
                'know_us'=> ['required',],
            ]);
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $request)
    {
        $role_id = 3;
        if(!empty($request['is_event_registeration'])){
            $role_id = 7;
            $request['auto_country'] = $this->__getCountryCode();
            if($request['nationality']=="EG" || $request['nationality']=="IL"){

            }else{
                $request['approved'] = 1;
                $request['status'] = 'Approve';
            }
        }
        $user = User::create($request);
        $user->roles()->sync( [$role_id]);
        $user->update(['status'=> 'Unverified']);

        // Insert Log
        $role_name = ($role_id==3)?'Student':'Visitor';
        $program_text = (!empty($user->program))?' in program '.$user->program:'';
        $log_message = "New user: ".$user->name." registered as ".$role_name.$program_text;
        $this->save_log($user->id,$log_message);
        // End

        if (isset($request['personal_photo'])) {
            $user->addMedia(storage_path('tmp/uploads/' . $request['personal_photo']))->toMediaCollection('personal_photo');
        }

        if (isset($request['id_photo'])) {
            $user->addMedia(storage_path('tmp/uploads/' . $request['id_photo']))->toMediaCollection('id_photo');
        }

        if (isset($request['degree_photo'])) {
            $user->addMedia(storage_path('tmp/uploads/' . $request['degree_photo']))->toMediaCollection('degree_photo');
        }
        if (isset($request['certificates'])){
            foreach ($request['certificates'] as $file) {
                $user->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('certificates');
            }
        }


        if (isset($request['cv'])) {
            $user->addMedia(storage_path('tmp/uploads/' . $request['cv']))->toMediaCollection('cv');
        }

        if ($media = isset($request['ck-media'])) {
            Media::whereIn('id', $media)->update(['model_id' => $user->id]);
        }
        // return redirect()->route('eventsRegisteration')
        // ->with('success','Please check your registered email for verification');
        return $user;
        //return User::create([
       //     'name'     => $data['name'],
      //      'email'    => $data['email'],
      //      'password' => Hash::make($data['password']),
     //   ]);
    }
    // KG 27/01 Start
    public function eventsRegisteration(){
        // echo $this->__getCountryCode();die;
        $all_countries = User::all_countries;
        return view('auth/eventsRegisteration', compact('all_countries'));
    }
    // public function eventsRegisterationSave(Request $request){
    //     $request_arr = $request->all();
    //     $user = User::create($request_arr);
    //     $user->roles()->sync( [3]);
    //     $user->update(['status'=> 'Unverified']);

    //     if (isset($request_arr['id_photo'])) {
    //         $user->addMedia(storage_path('tmp/uploads/' . $request_arr['id_photo']))->toMediaCollection('id_photo');
    //     }

    //     return $user;
    // }

    public function __getCountryCode()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];}
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));
        $code = !empty($ip_data->geoplugin_countryCode) ? $ip_data->geoplugin_countryCode : 'EG';
        if(!empty($code)){
            return $code;
        }
        return "EG";

    }
    // KG 27/01 End

}
