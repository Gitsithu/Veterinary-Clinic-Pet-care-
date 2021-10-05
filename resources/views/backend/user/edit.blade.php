@if(Auth::user()->role_id == 3)
@include('layouts.frontend.header')
   <section class="ftco-section ftco-no-pt ftco-no-pb ftco-services-2">
    <div class="container">
   <div class="row" style="margin-top:15%;">
                <!-- div class=row one start -->
                @if (session('success'))
                <div class="flash-message col-md-12">
                    <div class="alert alert-success ">
                        {{session('success')}}
                    </div>
                </div>
                @elseif(session('fail'))
                <div class="flash-message col-md-12">
                    <div class="alert alert-danger">
                        {{session('fail')}}
                    </div>
                </div>
                @endif

  
            @if (count($errors) > 0)
            <div class="content mt-3">
                <!-- div class=row content start -->
                <div class="animated fadeIn">
                    <!-- div class=FadeIn start -->
                    <div class="card">
                        <!-- card start -->
                        <div class="card-body">
                            <!-- card-body start -->

        
                            <div class="row">
                                <!-- div class=row One start -->
                                @foreach ($errors->all() as $error)
                                <div class="col-md-12">
                                    <!-- div class=col 12 One start -->
                                    <p class="text-danger">* {{ $error }}</p>
                                </div><!-- div class=col 12 One end -->
                                @endforeach
                            </div><!-- div class=row One end -->

        
                        </div> <!-- card-body end -->
                    </div><!-- card end -->
                </div><!-- div class=FadeIn start -->
            </div><!-- div class=row content end -->
            @endif
            <div class="content mt-3">
                <div class="animated fadeIn">
                    <div class="row">
                        <!-- div class=row one start -->
                        {{-- @if (session('fail'))
                        <div class="flash-message col-md-12">
                            <div class="alert alert-success ">
                                {{session('fail')}}
                            </div>
                        </div>
                        @endif --}}
                    </div>
                </div>
            </div>
        <div class="row" style="margin-top:5%;" id="spa">
            <div class="col-md-12 py-5 text-center">
                <h3 class="appointment-heading">Update Profile</h3>
                <div class="appointment-wrap d-flex align-items-center" >
                    <form method="POST" action="/home/{{ isset($user2)? $user2->id:0 }}"  enctype="multipart/form-data" class="appointment-form ftco-animate">
                    @csrf   
                    {{ method_field('PATCH') }}
                       <div class="row">
                        <div class="col-md-6">
                                <div class="form-group">
                                <div class="input-wrap">
                           <input type="text" name="name" value="{{ isset($user2)? $user2->name:Request::old('name') }}" class="form-control" placeholder="Username" autocomplete="username">
                                </div>
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                             <input type="text" name="email" value="{{ isset($user2)? $user2->email:Request::old('email') }}" class="form-control" placeholder="Recipient's username" autocomplete="email">
                                </div>
                        </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-wrap">
                                        <input type="password" name="password" class="form-control" placeholder="Password">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                     <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm password">
                            </div>
                        </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-wrap">
                                        <input type="text" value="{{ isset($user2)? $user2->phone:Request::old('phone') }}" name="phone" class="form-control" placeholder="phone number">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                      <input type="file" value="{{ isset($user2)? $user2->image:Request::old('image') }}" name="image" class="form-control" placeholder="phone number">
                            </div>
                        </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-wrap">
                                       <select class="form-control" value="{{ isset($user2)? $user2->status:Request::old('status') }}" name="status" id="status">
                                        <option value="1" selected>Active</option>
                                </select> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                     <textarea  class="form-control" name="address" id="tinymice">{{ isset($user2)? $user2->address:Request::old('address') }}</textarea>
                                </div>
                        </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">    
                            <div class="form-group">
                                <div class="input-wrap">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                    </div>
                    </div>
                    <div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@include('layouts.frontend.footer')
@else
@include('layouts.partial.master')  
<section class="content">
        <div class="container-fluid">
    <div class="row">
                <!-- div class=row one start -->
                @if (session('success'))
                <div class="flash-message col-md-12">
                    <div class="alert alert-success ">
                        {{session('success')}}
                    </div>
                </div>
                @elseif(session('fail'))
                <div class="flash-message col-md-12">
                    <div class="alert alert-danger">
                        {{session('fail')}}
                    </div>
                </div>
                @endif

  
            @if (count($errors) > 0)
            <div class="content mt-3">
                <!-- div class=row content start -->
                <div class="animated fadeIn">
                    <!-- div class=FadeIn start -->
                    <div class="card">
                        <!-- card start -->
                        <div class="card-body">
                            <!-- card-body start -->

        
                            <div class="row">
                                <!-- div class=row One start -->
                                @foreach ($errors->all() as $error)
                                <div class="col-md-12">
                                    <!-- div class=col 12 One start -->
                                    <p class="text-danger">* {{ $error }}</p>
                                </div><!-- div class=col 12 One end -->
                                @endforeach
                            </div><!-- div class=row One end -->

        
                        </div> <!-- card-body end -->
                    </div><!-- card end -->
                </div><!-- div class=FadeIn start -->
            </div><!-- div class=row content end -->
            @endif
            <div class="content mt-3">
                <div class="animated fadeIn">
                    <div class="row">
                        <!-- div class=row one start -->
                        {{-- @if (session('fail'))
                        <div class="flash-message col-md-12">
                            <div class="alert alert-success ">
                                {{session('fail')}}
                            </div>
                        </div>
                        @endif --}}
                    </div>
                </div>
            </div>

    
<!-- Input Group -->
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                        <form method="POST" action="/home/{{ isset($user2)? $user2->id:0 }}"  enctype="multipart/form-data">
                    @csrf   
                    {{ method_field('PATCH') }}
                            <div class="row clearfix">
                                <div class="col-md-6">
                                <p>
                                        <b>User  Name</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">person</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" name="name" value="{{ isset($user2)? $user2->name:Request::old('name') }}" class="form-control" placeholder="Username" autocomplete="username">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                <p>
                                        <b>Email</b>
                                    </p>
                                    <div class="input-group">
                                        <div class="form-line">
                                            <input type="text" name="email" value="{{ isset($user2)? $user2->email:Request::old('email') }}" class="form-control" placeholder="Recipient's username" autocomplete="email">
                                        </div>
                                        <span class="input-group-addon">@example.com</span>
                                    </div>
                                </div>

                                
                            </div>
                            <div class="row clearfix">
                            <div class="col-md-6">
                            <p>
                                        <b>Password</b>
                                    </p>
                                    <div class="input-group">
                                        <div class="form-line">
                                            <input type="password" name="password" class="form-control" placeholder="Password">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                <p>
                                        <b>Confirm Password</b>
                                    </p>
                                    <div class="input-group">
                                        <div class="form-line">
                                            <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm password">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-md-4">
                                <p>
                                        <b>Phone Number</b>
                                    </p>
                                    <div class="input-group">
                                        <div class="form-line">
                                            <input type="text" value="{{ isset($user2)? $user2->phone:Request::old('phone') }}" name="phone" class="form-control" placeholder="phone number">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                <p>
                                        <b>Image</b>
                                    </p>
                                    <div class="input-group">
                                        <div class="form-line">
                                            <input type="file" value="{{ isset($user2)? $user2->image:Request::old('image') }}" name="image" class="form-control" placeholder="phone number">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                <p>
                                        <b>Status</b>
                                    </p>
                                    <select class="form-control" value="{{ isset($user2)? $user2->status:Request::old('status') }}" name="status" id="status">
                                        <option value="1" selected>Active</option>
                                </select> 
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <label for="">Address</label>
                                            <textarea  class="form-control" name="address" id="tinymice">{{ isset($user2)? $user2->address:Request::old('address') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <label for="">description</label>
                                            <textarea value="{{ isset($user2)? $user2->description:Request::old('description') }}" class="form-control" name="description" id="tinymice"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Update') }}
                            </button>
                            </div>
                        </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </section>
            <!-- #END# Input Group -->
@endif