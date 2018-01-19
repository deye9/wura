<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Http\Validations\AuthValidation;
use Illuminate\Support\Facades\Validator;

class VehicleController extends Controller
{
    // ['year', 'type', 'color', 'model', 'drive', 'doors', 'body', 'fuel_type', 'owner_name', 'transmission', 'purchase_date', 'license_plate_number', 'left_view', 'rear_view', 'right_view', 'frontal_view'];
    protected $tag = 'Vehicles :: ';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function index()
    {
        // $drivers = User::find(Auth::id());
        // return view('mydrivers', ['drivers' => $drivers->Drivers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function registerform()
    {
        return view('vehicle.register')->with('defaultImg', Storage::url('upload.png'));
    }

        /**
     * Get a validator for an incoming driver registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $data['userrole'] = 'driver';
        $data['belongsTo'] = Auth::id();
        $validator = Validator::make($data, AuthValidation::registerDriver());
        if ($validator->fails())
        {
            $failedRules = $validator->failed();
            Log::info($this->tag . json_encode($failedRules));   
        }
        return $validator;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
    public function registervehicle(Request $request)
    {
        // Validate the request...
        $this->validator($request->all())->validate();

        $driver = new Drivers();

        $password = bin2hex(openssl_random_pseudo_bytes(4));
        $StaffID = Storage::putFile('public/staffid', $request->file('StaffID'));
        $passportpath = Storage::putFile('public/passports', $request->file('passpic'));

        $driver->status = "Inactive";
        $driver->belongsTo = Auth::id();
        $driver->email = $request->email;
        $driver->dateofbirth = $request->DOB;
        $driver->passportpath = $passportpath;
        $driver->lastname = $request->lastname;
        $driver->idnumber = $request->idnumber;
        $driver->identificationpath = $StaffID;
        $driver->firstname = $request->firstname;
        $driver->mobilenumber = $request->mobile;
        $driver->middlename = $request->middlename;
                
        // Use a transaction to save this record sir.
        $result = DB::transaction(function () use ($driver, $request, $password) {
            // Save the driver to the DB.
            $driver->save();

            // Create the driver as a site user.
            User::create(
                [
                    'firstname' => $request['firstname'],
                    'lastname' => $request['lastname'],
                    'email' => $request['email'],
                    'password' => bcrypt($password),
                    'userrole' => 'driver',
                ]
            );

            // Create a calendar event for the driver based on their birthday
            $calendarEntry = new \App\Models\Calendars();
            $calendarEntry->url = '';
            $calendarEntry->allDay = false;
            $calendarEntry->owner = Auth::id();
            $calendarEntry->classname = 'bg-primary';
            $calendarEntry->start = $driver->dateofbirth;
            $calendarEntry->end = Carbon::createFromFormat('Y-m-d', $driver->dateofbirth)->addYears(100);
            $calendarEntry->title = $driver->firstname . " " . $driver->firstname . " " . $driver->firstname . "'s Birthday";
            $calendarEntry->save();
        }, 3);

        if (is_null($result)) {
            $user = Auth::user();
            $sms = new SMSHelper();
            $user->userrole = 'driver';
            $request['password'] = $password;
            Mail::to($request->email)
                    ->bcc(Auth::id() . '@outlook.com')
                    ->send(new Driver($user, $request));
            $greeting = $request->firstname . ' ' . $request->middlename . ' ' . $request->lastname;
            $sms->SendSMS($request->mobile, 'Hello ' . $greeting . '. Congratulations "Name Of Company" has fully registered you as one of her drivers. You will receive other notifications as we proceed with your next level of registration. WURAfleet Team.', 'Driver Creation');
            return redirect()->action('DriversController@index');
        } 
        else {
            Log::error($this->tag . json_encode($result));
            return redirect()->action('DriversController@create');
        }
    }
}