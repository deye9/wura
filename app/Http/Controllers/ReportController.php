<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Cards;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Http\Validations\AuthValidation;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    protected $tag = 'Reports :: ';

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function drivers()
    {
        $recordset = \App\Models\Drivers::where("belongsTo", Auth::id())
                                        ->whereNull('deleted_at')
                                        ->get();
        return view('reports.driversreport', ['drivers' => $recordset]);
    }

    public function driverdetails(Request $request)
    {
        $recordid = $request->input('id');
        $recordset = \App\Models\Drivers::find($recordid);

        $cards = \App\Models\Cards::where("assignedto", $recordid)->get();
        return view('reports.driverdetails', ['driver' => $recordset, 'cards' => $cards]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function cards()
    {
        $recordset = \App\Models\Cards::whereNull('deleted_at')
                                        ->where("holder", Auth::id())
                                        ->where('status', 'Activate')
                                        ->orWhere(function($query)
                                            {
                                                $query->where('status', 'Inactive');
                                            })
                                        ->orderBy('status', 'asc')
                                        ->get();
        return view('reports.cardsreport', ['cards' => $recordset]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function expired()
    {
        $recordset = \App\Models\Cards::where("holder", Auth::id())
                                        ->where('status', 'Expired')
                                        ->whereNull('deleted_at')
                                        ->orWhere(function($query)
                                            {
                                                $query->whereNotNull('deleted_at');
                                            })
                                        ->orderBy('status', 'asc')
                                        ->get();
        return view('reports.expiredreport', ['cards' => $recordset]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function info()
    {
        $recordset = \App\Models\Cards::where("holder", Auth::id())
                                        ->where('status', 'Processing Request')
                                        ->whereNull('deleted_at')
                                        ->orWhere(function($query)
                                            {
                                                $query->where('status', 'Disputed');
                                            })
                                        ->orderBy('status', 'asc')
                                        ->get();
        return view('reports.cardsinfo', ['cards' => $recordset]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function walletsummary()
    {
        return view('reports.walletsummary');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function transactions(Request $request)
    {
        $recordid = $request->input('cardid');

        return view('reports.transactions');
    }

    // 
}