<?php

namespace App\Http\Controllers\frontend;
use Auth;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClinicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // check the user's login
        $loginUser = Auth::user();

        // condition the status of clinic and selected that is equal to null      
           $status=1;
           $objs=DB::select('SELECT distinct id , name,address from clinic
           WHERE status = ' .$status.' AND deleted_at Is Null Group by id,name,address');  
       
       return view('welcome')
       ->with('objs',$objs);
      

     
    }
    public function clinic()
    {
        // check the user's login
        $loginUser = Auth::user();

        // condition the status of clinic and selected that is equal to null      
           $status=1;
           $objs=DB::select('SELECT distinct id , name,address from clinic
           WHERE status = ' .$status.' AND deleted_at Is Null Group by id,name,address');  
       
       return view('frontend.clinic')
       ->with('objs',$objs);
      

     
    }
     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
      
      $objs = DB::table('clinic')->join('users', 'clinic.user_id', '=', 'users.id')->distinct('clinic.user_id')->select('users.name', 'clinic.user_id', 'users.description', 'users.image')->where('clinic.id', $id)->groupBy('clinic.user_id','users.name', 'clinic.user_id', 'users.description', 'users.image')->get();
      $clinic=$id;               
    return view('frontend.clinic_detail')
       ->with('objs',$objs)
       ->with('clinic',$clinic);
      
   }
}