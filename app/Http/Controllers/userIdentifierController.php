<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\dsUser;
use App\Models\prescription;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class userIdentifierController extends Controller
{
    public function userLoader()
    {
        $doctors = DB::table('ds_users')
            ->where('title', '!=', 'Patient')
            ->where('fullName', '!=', 'Admin')
            ->count();
        
        $patients = DB::table('ds_users')
            ->where('title', '=', 'Patient')
            ->where('fullName', '!=', 'Admin')
            ->count();
        
        $data = ['no_of_doctors' => $doctors, 'no_of_patients' => $patients];
        return view('admin.adminindex', $data);
    }

    public function adminLoader()
    {
        return view('admin.adminProfile');
    }

    public function adminPatList()
    {
        return view('admin.adminpatientsslist');
    }
    public function adminDocList()
    {
        return view('admin.admindoctorslist');
    }

    public function signout()
    {
        // return view('signin');
        // session()->forget('patient');
        session()->pull('LoggedUser');
        // dd(session()->has('LoggedUser'));
        return view('welcome');
    }

    public function patLoader()
    {
        return view('admin.adminpatientslist');
    }

    public function patIndex()
    {
        return view('patient.patientindex');
    }

    public function docIndex()
    {
        return view('doctor.doctorindex');
    }
    public function docPatList()
    {
        return view('doctor.doctorPatList');
    }
    public function docDocList()
    {
        return view('doctor.doctorDocList');
    }

    public function patDocList()
    {
        return view('patient.patientDocList');
    }

    public function patProfile()
    {
        return view('patient.profile');
    }

    public function docProfile()
    {
        return view('doctor.docProfile');
    }

    public function patReport()
    {
        $reports = DB::table('reports')
            ->where('patEmail', session('LoggedUser')->email)
            ->get();

        $tempReports = array();
        foreach($reports as $report){
            $fileName = $report->appointmentID . '---' . $report->patEmail . '---' . $report->id . '.' . $report->extension;
            try {
                Storage::disk('medicalReports')->response($fileName);
            } catch (\Throwable $th) {
                $report->status = 'inactive';
            }
            array_push($tempReports, $report);
        }

        $reports = $tempReports;
            
        $data = ['reports' => $reports];

        return view('patient.report', $data);
    }

    public function storeAppointmentHistory()
    {
        return view('patient.appointHistory');
    }

    public function viewPrescription(Request $request)
    {
        $prescriptionHistory = prescription::select()
            ->where('patEmail', '=', session('LoggedUser')->email)
            ->where('created_at', $request->patientDetails)
            ->get();
        $data = ['prescriptionContents' => $prescriptionHistory];
        // dd($data);
        return view('patient.prescription', $data);
    }

    public function newPrescription(Request $request)
    {
        date_default_timezone_set('Asia/Dhaka');
        $date = date("Y-m-d");

        $patient = dsUser::where('email', '=', $request->patientDetails)->first();
       
        $prescriptions = array();
        $appointment = null;

        if($patient == null){

            $appointment = DB::table('appointments')
            ->where('id', $request->id)
            ->where('emailOfAppointer', $request->patientDetails)
            ->where('appointDoctor', session('LoggedUser')->nidPassport)
            ->get()->first();

            // dd($appointment);
            $age = date_diff(date_create($appointment->dob), date_create($date));
            $age2 = $age->format('%y') . ' Years ' . $age->format('%m') .  ' Months';
            
            $patient = new dsUser;
            $patient->fullName = $appointment->nameOfAppointer;
            $patient->contact = $appointment->contactOfAppointer;
            $patient->email = $appointment->emailOfAppointer;
            $patient->dob = $appointment->dob;
            $patient->gender = $appointment->gender;
            $patient->address = $appointment->address;
        }
        else{
            date_default_timezone_set('Asia/Dhaka');
            $date = date("Y-m-d");
            $age = date_diff(date_create($patient->dob), date_create($date));
            $age2 = $age->format('%y') . ' Years ' . $age->format('%m') .  ' Months';
            
        }
        $prescriptionsList = prescription::where('patEmail', $request->patientDetails)->where('docEmail', session('LoggedUser')->email)->where('aptID', $request->id)->get();
        // dd(count($prescriptionsList));
        foreach($prescriptionsList as $prescription){
            $tempDate = $prescription->created_at->format('Y-m-d');
            if($tempDate == $request->appointDate){
                array_push($prescriptions, $prescription);
            }
        }

        $reports = DB::table('reports')->where('appointmentID', $request->id)->get();
        $tempReports = array();
        foreach($reports as $report){
            $fileName = $report->appointmentID . '---' . $report->patEmail . '---' . $report->id . '.' . $report->extension;
            try {
                Storage::disk('medicalReports')->response($fileName);
            } catch (\Throwable $th) {
                $report->status = 'inactive';
            }
            array_push($tempReports, $report);
        }

        $reports = $tempReports;

        // dd($reports);
        $redirect = ['fullName' => $patient->fullName, 'contact' => $patient->contact, 'email' => $patient->email, 'dob' => $patient->dob, 'age2' => $age2, 'gender' => $patient->gender, 'address' => $patient->address, 'prescriptions' => $prescriptionsList, 'appointmentID' => $appointment, 'reports' => $reports, 'aptID' => $request->id];

        return view('doctor.addPrescription', $redirect);
    }


    public function prescriptionHistory()
    {
        
        $patient= session('LoggedUser')->email;
        $presPatient = prescription::where('patEmail', '=', $patient)->first();
        
        $prescriptions = prescription::select('docName','created_at')
            ->where('patEmail', '=', $patient)
            ->distinct()
            ->get();

        $data = ['prescriptionHistory' => $prescriptions];
        

       return view('patient.prescriptionHistory', $data);
    }


}
