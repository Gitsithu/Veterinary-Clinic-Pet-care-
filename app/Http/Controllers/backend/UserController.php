<?php

namespace App\Http\Controllers\backend;
use DB;
use Mail;
use App\Mail\PasswordMail;
use Webpatser\Uuid\Uuid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        //
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // to select the data from faculty which delected is null
        $user=DB::select('SELECT * from users where deleted_at is null');
        return view('backend.user.create')
        ->with('user',$user);
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
            'name' => 'required|max:225',
            'password' => 'required|min:8|confirmed',
            'email' => 'required|unique:users',
            'phone' => 'required|unique:users|regex:/^([0-9\s\-\+\(\)]*)$/|min:8',
            
          
          
            
        ]);
        $uuid = Uuid::generate(4);
        $name = $request->input('name');
        $email = $request->input('email');
        $password = bcrypt($request->input('password'));

            $phone = $request->input('phone');
            $address = $request->input('address');
            $description = $request->input('description');
            $role_id = $request->input('role_id');
            $status = $request->input('status');
            $created_at = date("Y-m-d H:i:s");
            
            $comment = ' aaaaaaaa ';    
            
            
            Mail::to($email)->send(new PasswordMail($comment,$email));
           
            DB::insert('insert into users (id,name,email,password,phone,address,description,role_id,status,created_at) values(?,?,?,?,?,?,?,?,?,?)', 
            [$uuid,$name,$email,$password,$phone,$address,$description,$role_id,$status,$created_at]);    

                $message = 'Success, user registered and email sent successfully ...!';
                $request->session()->flash('success', $message);
    
                    return redirect()->route('home');
        
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}


