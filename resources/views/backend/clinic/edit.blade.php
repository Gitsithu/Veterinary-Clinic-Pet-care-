@include('layouts.partial.master')
<section class="content">
        <div class="container-fluid">
             <div class="row">
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
             </div>
                                   
                                   <!-- Input Group -->
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Clinic Edit
                            </h2>
                        </div>
                        <div class="body">
                        <form action="/backend/clinic/{{ isset($obj)? $obj->id:0 }}" method="post" enctype="multipart/form-data">
                                           <!-- <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> -->
                                    {{csrf_field()}}
                                    {{ method_field('PATCH') }}
                            <div class="row clearfix">
                                <div class="col-md-3">
                                    <div class="input-group">
                                    <p>
                                        <b>Start Time</b>
                                    </p>
                                        <div class="form-line">
                                            <input type="time" value="{{ isset($obj)? $obj->from_time:Request::old('from_time') }}" name="from_time" class="form-control date">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="input-group">
                                    <p>
                                        <b>End Time</b>
                                    </p>
                                        <div class="form-line">
                                            <input type="time" value="{{ isset($obj)? $obj->to_time:Request::old('to_time') }}" name="to_time" class="form-control date">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <p>
                                        <b>Status</b>
                                    </p>
                                    <select class="form-control" name="status" id="status">
                                                              
                                               <?php
                                                if(isset($obj)){
                                                ?>
                                                    
                                                    <option value="1" <?php if ($obj->status == 1){ echo 'selected'; } ?>>Active</option>
                                                    <option value="0" <?php if ($obj->status == 0){ echo 'selected'; } ?>>In-Active</option>

                                                <?php
                                                }
                                                else{
                                                ?>
                                                    
                                                    <option value="1"style="color:black;">Active</option>
                                                    <option value="0"style="color:black;">Inactive</option>
                                                <?php 
                                                }
                                                ?>
                                                                    
                                           </select>

                                </div>
                                
                            </div>

                            <div class="row clearfix">

                                <div class="col-md-12">
                                    <div class="input-group">
                                        <label for="">Address</label>
                                            <textarea class="form-control" value="{{ isset($obj)? $obj->name:Request::old('name') }}" name="name"></textarea>
                                    </div>
                                </div>

                            </div>

                            <div class="card-footer">
                                               <button type="submit" class="btn btn-fill btn-primary"> <i class="tim-icons icon-send"></i> Save</button>
                                             </div>
                            
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Input Group -->
                               </div>
                               </section>
                            

