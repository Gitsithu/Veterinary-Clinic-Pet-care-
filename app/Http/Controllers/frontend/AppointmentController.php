<?php

namespace App\Http\Controllers\frontend;
use Auth;
use DB;
use Webpatser\Uuid\Uuid;
use App\breed;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppointmentController extends Controller
{
    //
    public function index()
    {
        $loginUser=Auth::user();
        $loginUserId=$loginUser->id;
        $appoint = DB::table('appointment')->distinct('date','day')->where('appointment.user_id', $loginUserId)->get();
        $animal=DB::select('SELECT * from animal where deleted_at is null');
        $breed=DB::select('SELECT * from breed where deleted_at is null');
        $user = DB::table('users')->get();
        $clinic = DB::table('clinic')->get();
              
        return view('frontend.appointment.index')
        ->with('appoint',$appoint)
        ->with('animal',$animal)
        ->with('breed',$breed)
        ->with('user',$user)
        ->with('clinic',$clinic);
    }
    public function create(Request $request,$id)
    {
        $doctor_id = $id;
        $clinic_id=$request->input('cid');
        $appoint = DB::table('clinic')->where('user_id', $doctor_id)->where('id', $clinic_id)->get();
        $animal=DB::select('SELECT * from animal where deleted_at is null');
        
        
        return view('frontend.appointment.create')
        ->with('appoint',$appoint)
        ->with('animal',$animal)
        ->with('c_id',$clinic_id)
        ->with('doctor_id',$doctor_id);
    }
    public function getbreed(Request $request)
    {
        
        $animal_id = $request->animal_id;
        $breed =Breed::where('animal_id',$animal_id)->where('deleted_at',null)->get();
        $st =" ";
        foreach($breed as $bread){

            $blow=$bread->normal_id; 
            $stns = '<option value='."$blow".'>' .$bread->name.' </option>';
            $st = $st.$stns;
        }

            $msg = $st;
     
            
        return response()->json(array('msg' => $msg), 200);
    }
   public function store(Request $request)
   {
       

    $this->validate($request, [
            
        
        'date' => 'required|after:today',
        
        
    ]);
    

    try{
        $loginUser = Auth::user();
        $uuid = Uuid::generate(4);
        $animal_id= $request->input('animal_id'); 
        $breed_id = $request->input('breed_id');
        $date = $request->input('date');
        $day = date('l', strtotime($date));  
        $user_id = $loginUser->id;
        $doctor_id = $request->input('doctor_id');
        $clinic_id = $request->input('clinic_id');
        $vali = $appoint = DB::table('clinic')->where('user_id', $doctor_id)->where('id', $clinic_id)->where('date',$day)->get();
        $val_count=$vali->count();
        if($val_count>0){
        $created_at = date("Y-m-d H:i:s");


        DB::insert('insert into appointment (id,user_id,user_doctor_id,animal_id,breed_id,clinic_id,date,day,created_at) values(?,?,?,?,?,?,?,?,?)', 
                    [$uuid,$user_id,$doctor_id,$animal_id,$breed_id,$clinic_id,$date,$day,$created_at]);

                    // to alert message when it sucessfully created
        $smessage = 'Success, appointment submitted successfully ...!';
        $request->session()->flash('success', $smessage);


        return redirect()->action(
            'frontend\AppointmentController@index'
        );
          }
        else{
        
            $smessage = 'Fail, Error in submitting appointment...!';
            $request->session()->flash('fail', $smessage);
            $status=1;
           $objs=DB::select('SELECT distinct id , name,address from clinic
           WHERE status = ' .$status.' AND deleted_at Is Null Group by id,name,address');  
       
            // return redirect()->back()->with('error', 'Something went wrong.')
            return view('welcome')
            ->with('objs',$objs);
            
            
            }
    }
    catch(Exception $e){
        
        // to alert message when it fail creating
        $smessage = 'Fail, Error in submitting appointment...!';
        $request->session()->flash('fail', $smessage);

        return redirect()->action(
            'frontend\AppointmentController@index'
        );
    }

}
    public function retone($clinic_id,$doctor_id)
    {
        $doctor_id=$doctor_id;
        $clinic_id=$clinic_id;
        $appoint = DB::table('clinic')->where('user_id', $doctor_id)->where('id', $clinic_id)->get();
        $animal=DB::select('SELECT * from animal');
        
        
        return view('frontend.appointment.create')
        ->with('appoint',$appoint)
        ->with('animal',$animal)
        ->with('doctor_id',$doctor_id)
        ->with('clinic_id',$clinic_id);

    }
    public function token(){
        $loginUser=Auth::user();
        $loginUserId=$loginUser->id;
        $token = DB::table('token')->distinct('user_doctor_id','clinic_id')->where('token.user_id', $loginUserId)->get();
        $user = DB::table('users')->get();
        $clinic = DB::table('clinic')->get();
        $animal=DB::select('SELECT * from animal where deleted_at is null');
        $breed=DB::select('SELECT * from breed where deleted_at is null');
       return view('frontend.appointment.token')
       ->with('token',$token)
       ->with('user',$user)
       ->with('clinic',$clinic)
       ->with('animal',$animal)
       ->with('breed',$breed);
    }

}
