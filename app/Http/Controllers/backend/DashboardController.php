<?php

namespace App\Http\Controllers\backend;
use Auth;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class DashboardController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */  

    public function index(){

            if (Auth::check()) {
                    
              // Start - Searching clinic Count Process
                  $clinic_count_raw = DB::select('SELECT count(id) AS clinic_count from clinic where status = 1');
        
                  if (isset($clinic_count_raw) && count($clinic_count_raw)>0) {
                      $clinic_count = $clinic_count_raw[0]->clinic_count;
                  } else {
                      $clinic_count = 0;
                  }
        
                  // to count the total number of users
                  $total_count_raw = DB::select('SELECT count(id) AS total_count from users where status = 1 and deleted_at is null');
        
                  if (isset($total_count_raw) && count($total_count_raw)>0) {
                      $total_count = $total_count_raw[0]->total_count;
                  } else {
                      $total_count = 0;
                  }
                 
                  // to count the number of doctor
                  $user_count_raw = DB::select('SELECT count(id) AS user_count from users where role_id = 2');
            
                  if (isset($user_count_raw) && count($user_count_raw)>0) {
                      $user_count = $user_count_raw[0]->user_count;
                  } else {
                      $user_count = 0;
                  }
        
                  // to count the number of customer
                  $user_count_raws = DB::select('SELECT count(id) AS user_counts from users where role_id = 3');
            
                  if (isset($user_count_raws) && count($user_count_raws)>0) {
                      $user_counts = $user_count_raws[0]->user_counts;
                  } else {
                      $user_counts = 0;
                  }

                  // to count the number of animal
                  $animal_count_raw = DB::select('SELECT count(id) AS animal_count from animal where deleted_at is null');
            
                  if (isset($animal_count_raw) && count($animal_count_raw)>0) {
                      $animal_count = $animal_count_raw[0]->animal_count;
                  } else {
                      $animal_count = 0;
                  }

                  // to count the number of breed
                  $breed_count_raw = DB::select('SELECT count(id) AS breed_count from breed where deleted_at is null');
            
                  if (isset($breed_count_raw) && count($breed_count_raw)>0) {
                      $breed_count = $breed_count_raw[0]->breed_count;
                  } else {
                      $breed_count = 0;
                  }
    
                  
                  // to count the number of Customer' appointment
                  $appointment_count_raw = DB::select('SELECT count(id) AS appointment_count from appointment where deleted_at is null');
            
                  if (isset($appointment_count_raw) && count($appointment_count_raw)>0) {
                      $appointment_count = $appointment_count_raw[0]->appointment_count;
                  } else {
                      $appointment_count = 0;
                  }

                  // to count the number of Customer' appointment
                  $appointment_count_raws = DB::select('SELECT count(id) AS appointment_counts from appointment where status = 1 and deleted_at is null');
            
                  if (isset($appointment_count_raws) && count($appointment_count_raws)>0) {
                      $appointment_counts = $appointment_count_raws[0]->appointment_counts;
                  } else {
                      $appointment_counts = 0;
                  }
        
        
                  $loginUser = Auth::user();
                  $loginUserId = $loginUser->id ;  
                   
                  // to count the number of contributions upon login user id for coordinator role
                //   $submission_count_rawss = DB::select('SELECT count(s.id) AS submission_countss 
                //                        FROM 
                //                        submission AS s 
                //                        JOIN users AS u
                //                        ON s.faculty_id = u.faculty_id
                //                        JOIN faculty AS f
                //                        ON s.faculty_id = f.id
                //                        where u.id='.$loginUserId);
                //     if (isset($submission_count_rawss)&& count($submission_count_rawss)>0) {
                //         $submission_countss = $submission_count_rawss[0]->submission_countss;
                //     } else {
                //         $submission_countss = 0;
                //     } 

                    
                    $users = DB::select('select * from users');
        
                    
                                        
                  return view('backend.dashboard')
                  ->with('users', $users)
                  ->with('clinic_count', $clinic_count)
                  ->with('animal_count', $animal_count)
                  ->with('breed_count', $breed_count)
                  ->with('total_count', $total_count)
                  ->with('user_count', $user_count)
                  ->with('user_counts', $user_counts)
                  ->with('appointment_count', $appointment_count)
                  ->with('appointment_counts', $appointment_counts);
                //   ->with('submission_countss', $submission_countss)
                  
                 
              }
              else{
                  return redirect()->route('login');
              }
        
           }
        }
