@include('layouts.frontend.header')
<section class="ftco-section ftco-no-pt ftco-no-pb ftco-services-2">
    <div class="container">
        <div class="row">
            <div class="col-md-12 py-5 text-center">
                <h3 class="appointment-heading">Make An Appointment</h3>
                <div class="appointment-wrap d-flex align-items-center" style="margin-top:15%;">
                    <form action="/frontend/appointment/store" method="POST" enctype="multipart/form-data" class="appointment-form ftco-animate">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <input type="hidden" name="doctor_id" value="{{$doctor_id}}">
                        <input type="hidden"  name="clinic_id" value="{{$c_id}}">
                        @foreach($appoint as $appo)
                        <div class="row">
                            <div class="col-md-4">
                                <p style="color:black"><span class="fa fa-calendar"></span>{{$appo->date}}</p>
                            </div>
                            <div class="col-md-4">
                                <p style="color:black"><span class="fa fa-clock-o"></span>{{$appo->from_time}}</p>
                            </div>
                            <div class="col-md-4">
                                <p style="color:black"><span class="fa fa-clock-o"></span>{{$appo->to_time}}</p>
                            </div>
                        </div>
                        @endforeach
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-wrap">
                                    <select class="form-control" onchange="getbread()" name="animal_id" id="animal_id">
                                    <option value="" selected disabled>Select Animal</option>
                                    @foreach($animal as $ani)
                                    <option value="{{$ani->id}}">{{$ani->name}}</option>   
                                    @endforeach    
                                    </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control" name="breed_id" id="breed_id">
                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-wrap">
                                       
                                        <input type="date" class="form-control" name="date" placeholder="Date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-secondary py-3 px-4">Appointment</button>
                                </div>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">

    function getbread() {
        
        var animal_id = $("#animal_id").val();
        $.ajax({
            type: 'POST',
            url: '/frontend/appointment/getbreed',
            data: {
                _token: "{{csrf_token()}}",
                animal_id: animal_id
            },
            dataType: 'json',
            success: function(data) {
                $("#breed_id").html(data.msg);
                console.log(data.msg);
            }
        });
    }
</script>

@include('layouts.frontend.footer')
