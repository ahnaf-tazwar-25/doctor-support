<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\dsUser;
use App\Models\report;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class adminController extends Controller
{
    public function doctorList()
    {
        $doctorList = dsUser::select()
            ->where('title', '!=', 'Patient')
            ->where('fullName', '!=', 'Admin')
            ->get();
        $data = ['doctorList' => $doctorList];
        // dd($data);
        return view('admin.admindoctorslist', $data);
    }

    public function loadAppointments()
    {
        $appointments = DB::table('appointments')->where('status', 'Applied')->orWhere('status', 'Miss')->get();
        
        $data = ['appointments' => $appointments, 'createPatient' => false];

        return view('admin.adminAppointments', $data );
    }
    
    public function loadCreatePatient()
    {
        $patients = DB::table('ds_users')->where('title', 'Patient')->get();
        $emails = array();
        
        foreach($patients as $patient){
            array_push($emails, $patient->email);
        }
        // dd($emails);
        $appointments = DB::table('appointments')->whereNotIn('emailOfAppointer', $emails)->where('status', 'Confirm')->get();
        // dd($appointments);
        
        $data = ['appointments' => $appointments, 'createPatient' => true];
        return view('admin.adminAppointments', $data);
    }

    public function handleAppointment(Request $request)
    {
        $appointment = DB::table('appointments')->where('id', $request->id)->update(['status' => $request->type]);

        // $data = ['appointments' => $appointments];

        return redirect()->back();
    }

    public function createPatientAppointment(Request $request)
    {
        $appointment = DB::table('appointments')->where('id', $request->id)->get()->first();
        
        $new_user = new dsUser();
        $new_user->fullName = $appointment->nameOfAppointer;
        $new_user->email = $appointment->emailOfAppointer;
        $new_user->contact = $appointment->contactOfAppointer;
        $new_user->password = '@' . $appointment->contactOfAppointer;
        $new_user->gender = $appointment->gender;
        $new_user->dob = $appointment->dob;
        $new_user->title = "Patient";
        $new_user->bmdcRegNum = $appointment->emailOfAppointer;
        $new_user->nidPassport = $appointment->emailOfAppointer;
        $new_user->address = $appointment->address;
        $new_user->department = "None";
        $new_user->fees = "0";
        
        $save = $new_user;
        
        try {
            $save = $new_user->save();
        } catch (\Throwable $th) {
            echo $th;
        }
        return redirect()->route('adminPatList');
    }

    public function patientList()
    {
        $patientList = dsUser::select()
            ->where('title', '=', 'Patient')
            ->where('fullName', '!=', 'Admin')
            ->get();
        $data = ['patientList' => $patientList];
        return view('admin.adminpatientslist', $data);
    }

    public function createUserUI()
    {
        $patientList = dsUser::select()
            ->where('title', '=', 'Patient')
            ->where('fullName', '!=', 'Admin')
            ->get();
        $data = ['patientList' => $patientList];
        return view('admin.adminCreateUsers', $data);
    }

    public function loadReports()
    {
        $reports = DB::table('reports')->get();
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
        $data = ['reports' => $reports, 'appointments' => null, 'upload_1' => false, 'upload_2' => false, 'id' => null, 'email' => null, 'report' => null];
        return view('admin.adminReports', $data);
    }


    public function uploadReport_1()
    {
        $appointmentList = DB::table('appointments')->where('status', 'Confirm')->get();
        $data = ['appointments' => $appointmentList, 'upload_1' => true, 'upload_2' => false, 'id' => null, 'email' => null, 'report' => null];
        // dd($reports);
        // return redirect()->route('reports', $data);
        return view('admin.adminReports', $data);
    }

    public function uploadReport_2(Request $request)
    {
        // dd($request->id, $request->email);
        $report = new report;


        // dd($request);
        $report->patEmail = $request->email;
        $report->department = $request->department;
        $report->docNID = $request->docNID;

        $appointmentList = DB::table('appointments')->where('status', 'Confirm')->get();
        $data = ['appointments' => $appointmentList, 'upload_1' => true, 'upload_2' => true, 'id' =>$request->id, 'email' => $request->email, 'report' => $report];
        return view('admin.adminReports', $data);
    }

    public function uploadReport_3(Request $request)
    {
        $tempReport = json_decode($request->report);

        $name = $request->reportFile->getClientOriginalName();

        // dd($tempReport);
        $report = new report;
        $report->date = $request->date;
        $report->name = $request->name;
        $report->department = $tempReport->department;
        // $report->department = 'asdasd';
        $report->patEmail = $request->email;
        $report->docNID =  $tempReport->docNID;
        // $report->docNID =  'asdasdas';
        $report->appointmentID =  $request->id;
        $report->extension = $request->reportFile->extension();
        $report->status = 'active';

        $isSaved = $report->save();

        if($isSaved){
            $reportID = $report->id;
            
            $name = $request->id . '---' . $request->email . '---' . $reportID . '.' . $request->reportFile->extension();
            $file = file_get_contents($request->reportFile);
            
            $directory = 'medicalReports';
            Storage::disk($directory)->put($name, $file);
        }

        $reports = DB::table('reports')->get();
        $data = ['reports' => $reports, 'appointments' => null, 'upload_1' => false, 'upload_2' => false, 'id' => null, 'email' => null, 'report' => null];
        // return view('admin.adminReports', $data);
        return redirect()->route('reports', $data);
    }

    public function downLoadReport(Request $request){
        $report = DB::table('reports')->where('id', $request->fileName)->get()->first();
        $fileName = $report->appointmentID . '---' . $report->patEmail . '---' . $report->id . '.' . $report->extension;
        try {
            return Storage::disk('medicalReports')->response($fileName);
        } catch (\Throwable $th) {
            echo 'Error 404, File not found!';
        }
    }

    
    public function deletePatient($email, $contact)
    {
        $deletePatient = DB::table('ds_users')
            ->where('email', $email)
            ->where('contact', $contact)
            ->where('title', 'Patient')
            ->delete();

        return redirect()->back();
    }


    public function deleteDoctor($email, $contact, $bmdcRegNum, $nidPassport, $department)
    {
        $deleteDoctor = DB::table('ds_users')
            ->where('email', $email)
            ->where('contact', $contact)
            ->where('bmdcRegNum', $bmdcRegNum)
            ->where('nidPassport', $nidPassport)
            ->where('department', $department)
            ->where('title', '<>', 'Patient')
            ->delete();

        
        return redirect()->back();
    }

    // Flight::where('active', 1)
    //   ->where('destination', 'San Diego')
    //   ->update(['delayed' => 1]);
}
