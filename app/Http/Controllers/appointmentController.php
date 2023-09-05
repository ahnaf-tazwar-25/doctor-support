<?php

namespace App\Http\Controllers;

use App\Models\appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class appointmentController extends Controller
{
    public function load_doctorList(Request $request)
    {
        if ($request->ajax()) {

            $data = DB::table('ds_users')->get();
            $output = '<option value="" selected disabled>Select Doctor</option>';

            foreach ($data as $perData) {
                if ($request->id === $perData->department) {
                    $output .= '<option value="' . $perData->nidPassport . '">' . $perData->title . " " . $perData->fullName . '</option>';
                }
            }
            if($output === '<option value="" selected disabled>Select Doctor</option>'){
                $output = '<option value="" selected disabled>No Doctors Available</option>';
            }

            echo $output;
        }
    }

    public function load_doctorList_public(Request $request)
    {
        // dd($request->department);
        if ($request->ajax()) {

            $data = DB::table('ds_users')->where('department', $request->department)->where('title', '<>', 'Admin')->where('title', '<>', 'Patient')->get();
            $output = '<option value="" selected disabled>Select Doctor</option>';

            foreach ($data as $perData) {
                $output .= '<option value="' . $perData->nidPassport . '">' .$perData->title . " " . $perData->fullName . '</option>';
            }

            if(count($data) == 0){
                $output = '<option selected disabled>No Doctors Available</option>';
            }

            echo $output;
            // echo $request->department;
        }
    }

    public function storeAppointment(Request $request)
    {
        $appointment= new appointment;
        $appointment->appointDate=$request->date;
        $appointment->appointDoctor=$request->doctor;
        $appointment->appointDepartment=$request->department;
        $appointment->appointMessage=$request->message;
        $appointment->status="Accept";
        $appointment->nameOfAppointer=session('LoggedUser')->fullName;
        $appointment->emailOfAppointer=session('LoggedUser')->email;
        $appointment->contactOfAppointer=session('LoggedUser')->contact;
        $save=$appointment->save();

        return redirect('/appointHistory');
    }

    public function storeAppointmentPublic(Request $request)
    {
        // dd($request);
        $appointment = new appointment;
        $appointment->appointDate = $request->appointDate;
        $appointment->appointDoctor = $request->doctor;
        $appointment->appointDepartment = $request->department;
        $appointment->appointMessage = $request->message;
        $appointment->status = "Applied";
        $appointment->gender = $request->gender;
        $appointment->dob = $request->dob;
        $appointment->address = $request->address;
        $appointment->nameOfAppointer = $request->name;
        $appointment->emailOfAppointer = $request->email;
        $appointment->contactOfAppointer = $request->contact;
        
        $save=$appointment->save();

        return redirect('/');
    }
}
