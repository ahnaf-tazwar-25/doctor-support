<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userIdentifierController;
use App\Http\Controllers\signup_signinController;
use App\Http\Controllers\patientController;
use App\Http\Controllers\doctorController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\appointmentController;


Route::get('/', function () {
    return view('welcome');
});

// Route::get('/signup', function () {
//     return view('signup');
// });

Route::get('/signin', function () {
    return view('signin');
});

Route::get('/forgotPassword', function () {
    return view('forgotPass');
});

Route::get('/appointment', function () {
    return view('appointment');
})->name('appointment');

Route::get('/bookAppointment', function () {
    return view('bookAppointmentPublic');
})->name('bookAppointment');




Route::get('/admindashboard', [userIdentifierController::class, 'userLoader'])->middleware('GlobalAuth')->name('adminindex');
Route::get('/adminCreateUsers', [adminController::class, 'createUserUI'])->middleware('GlobalAuth')->name('createUserUI');
Route::get('/loadAppointments', [adminController::class, 'loadAppointments'])->middleware('GlobalAuth')->name('loadAppointments');
Route::get('/createPatientFromAppointment', [adminController::class, 'loadCreatePatient'])->middleware('GlobalAuth')->name('loadCreatePatient');
Route::get('/adminProfile', [userIdentifierController::class, 'adminLoader'])->middleware('GlobalAuth')->name('adminProfile');
Route::get('/adminPatients', [adminController::class, 'patientList'])->middleware('GlobalAuth')->name('adminPatList');
Route::get('/adminDoctors', [adminController::class, 'doctorList'])->middleware('GlobalAuth')->name('adminDocList');
Route::get('/reports', [adminController::class, 'loadReports'])->middleware('GlobalAuth')->name('reports');
Route::get('/uploadReport', [adminController::class, 'uploadReport_1'])->middleware('GlobalAuth')->name('uploadReport_1');
Route::get('/deletePatient/{email}/{contact}', [adminController::class, 'deletePatient'])->middleware('GlobalAuth')->name('deletePatient');
Route::get('/deleteDoctor/{email}/{contact}/{bmdcRegNum}/{nidPassport}/{department}', [adminController::class, 'deleteDoctor'])->middleware('GlobalAuth')->name('deleteDoctor');

Route::post('/createPatientFromAppointment', [adminController::class, 'createPatientAppointment'])->middleware('GlobalAuth')->name('createPatientAppointment');
Route::post('/uploadReport', [adminController::class, 'uploadReport_2'])->middleware('GlobalAuth')->name('uploadReport_2');
Route::post('/handleAppointment', [adminController::class, 'handleAppointment'])->middleware('GlobalAuth')->name('handleAppointment');
Route::post('/uploadReportFile', [adminController::class, 'uploadReport_3'])->middleware('GlobalAuth')->name('uploadReport_3');
Route::post('/downloadReport', [adminController::class, 'downLoadReport'])->middleware('GlobalAuth')->name('downLoadReport');

Route::get('/doctordashboard', [userIdentifierController::class, 'docIndex'])->middleware('GlobalAuth')->name('doctorindex');
Route::get('/patientdashboard', [userIdentifierController::class, 'patIndex'])->middleware('GlobalAuth')->name('patientindex');
Route::get('/patProfile', [userIdentifierController::class, 'patProfile'])->middleware('GlobalAuth')->name('profile');
Route::get('/patReport', [userIdentifierController::class, 'patReport'])->middleware('GlobalAuth')->name('report');
Route::get('/presHistory', [userIdentifierController::class, 'prescriptionHistory'])->middleware('GlobalAuth')->name('presHistory');
Route::get('/docProfile', [userIdentifierController::class, 'docProfile'])->middleware('GlobalAuth')->name('docProfile');
Route::get('/', [userIdentifierController::class, 'signout'])->name('signout');

Route::post('/addPrescription', [userIdentifierController::class, 'newPrescription'])->middleware('GlobalAuth')->name('addPrescription');
Route::post('/viewPrescription', [userIdentifierController::class, 'viewPrescription'])->middleware('GlobalAuth')->name('vPrescription');

Route::get('/DocPatientslist', [doctorController::class, 'appointList'])->middleware('GlobalAuth')->name('doctorPatList');
Route::get('/DocDoctorslist', [doctorController::class, 'doctorList'])->middleware('GlobalAuth')->name('doctorDocList');

Route::post('/patDetails', [doctorController::class, 'loadPatientDetails'])->middleware('GlobalAuth')->name('loadPatDetails');
Route::post('/prescriptions', [doctorController::class, 'loadPrescription'])->middleware('GlobalAuth')->name('prescription');
Route::post('/statusUpdate', [doctorController::class, 'acceptReject'])->middleware('GlobalAuth')->name('status');

Route::get('/appointHistory', [patientController::class, 'appointHistory'])->middleware('GlobalAuth')->name('appointHistory');
Route::get('/PatDoctorslist', [patientController::class, 'doctorList'])->middleware('GlobalAuth')->name('patientDocList');

Route::post('/signupPD', [signup_signinController::class, 'store'])->name('signupPatDoc');
Route::post('/dashboard', [signup_signinController::class, 'signin'])->name('dashboard');

Route::post('/LoadDoctorListqwe', [appointmentController::class, 'load_doctorList'])->middleware('GlobalAuth')->name('loadDoctor');
Route::post('/LoadDoctorListPublic', [appointmentController::class, 'load_doctorList_public'])->name('loadDoctorPublic');
Route::post('/appointHistory', [appointmentController::class, 'storeAppointment'])->middleware('GlobalAuth')->name('appointStored');
Route::post('/appointPublic', [appointmentController::class, 'storeAppointmentPublic'])->name('appointStoredPublic');
Route::post('/bookAppointment', [appointmentController::class, 'storeAppointmentPublic'])->middleware('GlobalAuth')->name('bookAptPub');
