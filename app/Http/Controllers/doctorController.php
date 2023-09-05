<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\dsUser;
use App\Models\appointment;
use App\Models\prescription;
use Illuminate\Support\Facades\DB;

class doctorController extends Controller
{
    public function doctorList()
    {
        $doctorList = dsUser::select()
            ->where('title', '!=', 'Patient')
            ->where('fullName', '!=', 'Admin')
            ->get();
        // $doctorList = [];
        $data = ['doctorList' => $doctorList];
        return view('doctor.doctorDoclist', $data);
    }

    public function appointList()
    {
        $name = session('LoggedUser')->title . ' ' . session('LoggedUser')->fullName;

        $appointList = appointment::select()
            ->where('appointDoctor', '=', session('LoggedUser')->nidPassport)
            ->where('status', 'Accept')
            ->orwhere('status', 'Miss')
            ->orwhere('status', 'Confirm')
            ->get();
        $data = ['appointList' => $appointList];
        return view('doctor.doctorPatlist', $data);
    }


    public function loadPrescription(Request $request)
    {
        //dd(session('LoggedUser')->email);
        $count = 0;
        foreach ($request->medicine as $item) {
            $medicine = $item;
            $times = $request->times[$count];
            $days = $request->days[$count];
            $suggession = $request->suggession[$count];

            $pres = new prescription;
            $pres->docEmail = session('LoggedUser')->email;
            $pres->docName = session('LoggedUser')->title . " " . session('LoggedUser')->fullName;
            $pres->patEmail = $request->patEmail;
            $pres->medicine = $medicine;
            $pres->times = $times;
            $pres->days = $days;
            $pres->suggession = $suggession;
            $pres->aptID = $request->aptID;

            $save = $pres->save();
            $count++;
        }
        $doc = new doctorController;
        return $doc->appointList();
        // return redirect()->back();
    }

    public function acceptReject(Request $request)
    {
        date_default_timezone_set('Asia/Dhaka');
        $date = date("Y-m-d");
        $docName = session('LoggedUser')->title . " " . session('LoggedUser')->fullName;
        $appointmentID = $request->id;
        $type = $request->type;

        DB::table('appointments')
            ->where('id', '=', $appointmentID)
            // ->where('appointDoctor', '=', $docName)
            // ->where('appointDate', '=', $date)
            ->update(['status' => $type]);

        return redirect()->back();
    }
}
