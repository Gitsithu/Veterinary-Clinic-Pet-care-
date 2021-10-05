<?php

namespace App\Http\Controllers;
use DB;
use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $loginUser = Auth::user();
            if ($loginUser->role_id == 1) {
                $objs=DB::select('SELECT * from users');
    
            }
            elseif($loginUser->role_id == 2){
                $loginUserId = $loginUser->id;
                $objs=DB::select('Select * from users where id='.$loginUserId);
            }
            else{
                $loginUserId = $loginUser->id;
                $objs=DB::select('SELECT * from users 
                where id='.$loginUserId);
    
    
            }
            return view('home')
            ->with('objs', $objs);
     }
     public function edit($id)
        {
            
            $user = DB::select('select * from users where id = ?',[$id]);
            $user2 = DB::table('users')->where('id', $id)->first();
            
            // to return the variables to the view
            return view('backend.user.edit')
            ->with('user',$user)
            ->with('user2',$user2);
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
            // to validate form
            $this->validate($request,[
                
                'name' => 'required',
                'email' => 'required|email|unique:users,email,'. $id .'',
                'password' => 'required|min:8|confirmed',
                'phone' => 'required|min:8|regex:/^([0-9\s\-\+\(\)]*)$/|min:8',
               
                ]);
    
            $name = $request->input('name');
            $email = $request->input('email');
            $password = bcrypt($request->input('password'));
            $phone = $request->input('phone');
            $address = $request->input('address');
            $description = $request->input('description');
            $status = $request->input('status');
            $updated_at = date("Y-m-d H:i:s");
                    
            
            try{
                
                // to create the folder path when it save images
                if($image = $request->file('image')){
                   
                    $new_name = rand() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('profile'), $new_name);
                    $image_file = "/profile/" . $new_name;
                    DB::update('update users set  name = ?, email = ?,  password = ?, phone = ?, address = ?, description = ?, image = ?, status = ?, updated_at = ? where id = ?', [$name,$email,$password,$phone,$address,$description,$image_file,$status,$updated_at,$id]);
                }
                else{
                    DB::update('update users set  name = ?, email = ?,  password = ?, phone = ?, address = ?, description = ?, status = ?, updated_at = ? where id = ?', [$name,$email,$password,$phone,$address,$description,$status,$updated_at,$id]);
                }
               
                $smessage = 'Success, user updated successfully ...!';
                $request->session()->flash('success', $smessage);
    
                // return redirect()->route('backend/car');
                // return redirect()->action(
                //     'UserController@profile', ['id' => 1]
                // );
                
                // to return view
                return redirect()->action(
                    'HomeController@index'
                );
            }
                catch(Exception $e){
                
                // to show the alert box 
                $smessage = 'Fail, Error in user updating ...!';
                $request->session()->flash('fail', $smessage);
    
                return redirect()->action(
                    'HomeController@index'
                );
            }
    
     }
    
       
    
    }
    
