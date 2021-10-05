<?php

namespace App\Http\Controllers\backend;
use Auth;
use DB;
use App\clinic;
use Webpatser\Uuid\Uuid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClinicController extends Controller
{
    //
/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
       $objs=DB::select('SELECT c.*,u.name as user_name 
                        from clinic as c
                        Join users as u
                        On c.user_id=u.id where c.deleted_at is null
                        ');
     
       return view('backend.clinic.index')
       
        ->with('objs',$objs);
    
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $doctor=DB::select('SELECT * from users
                            where role_id = 2 and deleted_at is null');
        return view('backend.clinic.create')
        ->with('doctor',$doctor);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // to validate form
        
        $this->validate($request, [
            
            'name' => 'required',
            'user_id' => 'required',
            'from_time' => 'required',
            'to_time' => 'required',
            
            
        ]);
        

        try{
            
            $uuid = Uuid::generate(4);
            $address = $request->input('address');
            $name = $request->input('name');
            $user = $request->input('user_id');
            $from_time = $request->input('from_time'); 
            $to_time = $request->input('to_time'); 
            $date = $request->input('date'); 
            
            $user_id = count($user);
            
            $status = $request->input('status');
            $created_at = date("Y-m-d H:i:s");

            for($i=0; $i<$user_id; $i++)
            {
                $a = $user[$i];
                $b = $date[$i];
                $c = $from_time[$i];
                $d = $to_time[$i];
                DB::insert('insert into clinic (id,user_id,name,date,from_time,to_time,address,status,created_at) values(?,?,?,?,?,?,?,?,?)', 
                        [$uuid,$a,$name,$b,$c,$d,$address,$status,$created_at]);
            }
                        // to alert message when it sucessfully created
            $smessage = 'Success, clinic created successfully ...!';
            $request->session()->flash('success', $smessage);


            return redirect()->action(
                'backend\ClinicController@index'
            );
                    }
        catch(Exception $e){
            
            // to alert message when it fail creating
            $smessage = 'Fail, Error in Clinic creating ...!';
            $request->session()->flash('fail', $smessage);

            return redirect()->action(
                'backend\ClinicController@index'
            );
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         
         $obj = DB::table('clinic')->where('id', $id)->first();
         return view('backend.clinic.edit', ['obj' => $obj]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //to validate form
        $this->validate($request, [
            
            'name' => 'required',
            'from_time' => 'required|date_format:H:i|before:to_time',
            'to_time' => 'required|date_format:H:i|after:from_time',
           
        ]);
        $type = $request->input('name');
        $from_time = $request->input('from_time'); 
        $to_time = $request->input('to_time'); 
        $status = $request->input('status');
        $updated_at = date("Y-m-d H:i:s");
        
        try{
            
          
         DB::update('update clinic set  name = ?, from_time = ?, to_time = ?, status = ?, updated_at = ? where id = ?', [$type,$from_time,$to_time,$status,$updated_at,$id]);
            
           // to alert message when it update successfully
            $smessage = 'Success, clinic updated successfully ...!';
            $request->session()->flash('success', $smessage);

            return redirect()->action(
                'backend\ClinicController@index'
            );
        }
            catch(Exception $e){
            
                // to alert message when it fail updating
            $smessage = 'Fail, Error in Clinic updating ...!';
            $request->session()->flash('fail', $smessage);

            return redirect()->action(
                'backend\ClinicController@index'
            );
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        // to delect the data from database
        
        $obj = clinic::find($id);dd($obj);
        $obj->delete();
        if ($obj->trashed()) {            
            $message = 'Success, ' . $obj->name .' deleted successfully ...!';
            $request->session()->flash('fail', $message);

            return redirect()->action(
                'backend\ClinicController@index'
            );
        }
        else{
            
            $message = 'Fail, ' . $obj->name .' cannot delete ..... !';
            $request->session()->flash('fail', $message);

            return redirect()->action(
                'backend\ClinicController@index'
            );
        }
    }
  
}
