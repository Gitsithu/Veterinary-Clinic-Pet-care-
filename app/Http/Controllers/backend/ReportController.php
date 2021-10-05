<?php

namespace App\Http\Controllers\backend;
use Auth;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
       $users = DB::select('SELECT * from users where deleted_at is null');

        return view('backend.report.user')
        ->with('users', $users);
        }

        public function accept()
        {
           
            $accept = DB::table('appointment')->distinct('date','day','breed_id')->where('status',1)->get();
            $animal=DB::select('SELECT * from animal where deleted_at is null');
            $breed=DB::select('SELECT * from breed where deleted_at is null');
            $user = DB::table('users')->get();
            $clinic = DB::table('clinic')->get();
    
            return view('backend.report.appointmentaccept')
            ->with('accept',$accept)
            ->with('animal',$animal)
            ->with('breed',$breed)
            ->with('user',$user)
            ->with('clinic',$clinic);
                                    
        }

    
    
    public function deny()
    {
        
        $deny = DB::table('appointment')->distinct('date','day','breed_id')->where('status',2)->get();
            $animal=DB::select('SELECT * from animal where deleted_at is null');
            $breed=DB::select('SELECT * from breed where deleted_at is null');
            $user = DB::table('users')->get();
            $clinic = DB::table('clinic')->get();
    
            return view('backend.report.appointmentdeny')
            ->with('deny',$deny)
            ->with('animal',$animal)
            ->with('breed',$breed)
            ->with('user',$user)
            ->with('clinic',$clinic);
    }

    
  
    public function pending()
    {
        
        $pending = DB::table('appointment')->distinct('date','day','breed_id')->where('status',0)->get();
            $animal=DB::select('SELECT * from animal where deleted_at is null');
            $breed=DB::select('SELECT * from breed where deleted_at is null');
            $user = DB::table('users')->get();
            $clinic = DB::table('clinic')->get();
    
            return view('backend.report.appointmentpending')
            ->with('pending',$pending)
            ->with('animal',$animal)
            ->with('breed',$breed)
            ->with('user',$user)
            ->with('clinic',$clinic);
       
    }

    public function expire()
    {
        
        $expire = DB::table('appointment')->distinct('date','day','breed_id')->where('status',3)->get();
            $animal=DB::select('SELECT * from animal where deleted_at is null');
            $breed=DB::select('SELECT * from breed where deleted_at is null');
            $user = DB::table('users')->get();
            $clinic = DB::table('clinic')->get();
    
            return view('backend.report.appointmentexpire')
            ->with('expire',$expire)
            ->with('animal',$animal)
            ->with('breed',$breed)
            ->with('user',$user)
            ->with('clinic',$clinic);
       
    }

    public function appointment()
    {
        
        $appointment = DB::table('appointment')->distinct('date','day','breed_id')->get();
        $animal=DB::select('SELECT * from animal where deleted_at is null');
        $breed=DB::select('SELECT * from breed where deleted_at is null');
        $user = DB::table('users')->get();
        $clinic = DB::table('clinic')->get();

        return view('backend.report.appointment')
        ->with('appointment',$appointment)
        ->with('animal',$animal)
        ->with('breed',$breed)
        ->with('user',$user)
        ->with('clinic',$clinic);
       
    }

    public function clinic()
    {
        
        $clinic = DB::select('SELECT c.*,u.name as user_name 
                                from clinic as c
                                Join users as u
                                On c.user_id=u.id where c.deleted_at is null
                                ');

        return view('backend.report.clinic')
            ->with('clinic', $clinic);
       
    }

    
}
