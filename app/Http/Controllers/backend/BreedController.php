<?php

namespace App\Http\Controllers\backend;
use Auth;
use DB;
use App\breed;
use Webpatser\Uuid\Uuid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BreedController extends Controller
{
   //
/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // to select data of faculty and academic_year table it join with foreign id which is also faculty delected is null
       $objs=DB::select('SELECT b.*,a.name as animal_name 
                        from breed as b
                        Join animal as a
                        On b.animal_id=a.id where b.deleted_at is null
                        ');
     
       return view('backend.breed.index')
       
        ->with('objs',$objs);
    
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $animal=DB::select('SELECT *
                            FROM 
                            animal 
                            where deleted_at is null');
        return view('backend.breed.create')
        ->with('animal',$animal);
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
            'animal_id' => 'required',
            
            
        ]);
        

        try{
            $uuid = Uuid::generate(4);
            $type = $request->input('name'); 
            $animal = $request->input('animal_id');   
            
            $status = $request->input('status');
            $created_at = date("Y-m-d H:i:s");

            DB::insert('insert into breed (id,name,animal_id,status,created_at) values(?,?,?,?,?)', 
                        [$uuid,$type,$animal,$status,$created_at]);

                        // to alert message when it sucessfully created
            $smessage = 'Success, breed created successfully ...!';
            $request->session()->flash('success', $smessage);


            return redirect()->action(
                'backend\BreedController@index'
            );
                    }
        catch(Exception $e){
            
            // to alert message when it fail creating
            $smessage = 'Fail, Error in Breed creating ...!';
            $request->session()->flash('fail', $smessage);

            return redirect()->action(
                'backend\BreedController@index'
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
         
         $obj = DB::table('breed')->where('id', $id)->first();
         return view('backend.breed.edit', ['obj' => $obj]);
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
           
        ]);
        $type = $request->input('name');
        $status = $request->input('status');
        $updated_at = date("Y-m-d H:i:s");
        
        try{
            
          
         DB::update('update breed set  name = ?, status = ?, updated_at = ? where id = ?', [$type,$status,$updated_at,$id]);
            
           // to alert message when it update successfully
            $smessage = 'Success, Breed updated successfully ...!';
            $request->session()->flash('success', $smessage);

            return redirect()->action(
                'backend\BreedController@index'
            );
        }
            catch(Exception $e){
            
                // to alert message when it fail updating
            $smessage = 'Fail, Error in Breed updating ...!';
            $request->session()->flash('fail', $smessage);

            return redirect()->action(
                'backend\BreedController@index'
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
        $obj = breed::find($id);
        $obj->delete();
        if ($obj->trashed()) {            
            $message = 'Success, ' . $obj->type .' deleted successfully ...!';
            $request->session()->flash('fail', $message);

            return redirect()->action(
                'backend\BreedController@index'
            );
        }
        else{
            
            $message = 'Fail, ' . $obj->type .' cannot delete ..... !';
            $request->session()->flash('fail', $message);

            return redirect()->action(
                'backend\BreedController@index'
            );
        }
    }
  
}
