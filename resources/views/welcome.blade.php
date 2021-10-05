@include('layouts.frontend.header')
<div class="container">
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

</div>
	<section class="hero-wrap js-fullheight" style="background-image: url('/frontend/images/bg_1.jpg');" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		
		<div class="container">
			<div class="row no-gutters slider-text js-fullheight align-items-center" data-scrollax-parent="true">
				
				<div class="col-lg-6 pt-md-5 ftco-animate">
					<div class="mt-5">
						<h1 class="mb-4">Our Pet Clinic</h1>
						<p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove.</p>
						
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="ftco-section bg-light ftco-no-pt intro">
		<div class="container">
			<div class="row">
				@foreach($objs as $obj)
				<div class="col-md-4 d-flex align-self-stretch">
					<div class="d-block services d-flex justify-content-between"style="background-color:lightgrey;">
						<div class="icon d-flex align-items-center justify-content-center">
							<span class="flaticon-stethoscope"></span>
						</div>
						<div class="media-body">
						<h3 class="heading">{{$obj->name}}</h3>
							<p class="mb-0"><a href="/frontend/clinic/detail/{{ $obj->id }}" class="btn btn-primary py-2 px-3">More Detail</a></p>
							<!-- <a href="#" class="btn-custom d-flex align-items-center justify-content-center"><span class="fa fa-chevron-right"></span><i class="sr-only">Read more</i></a> -->
						</div>
					</div>      
				</div>
				@endforeach
			
			</div>
		</div>
	</section>


	<section class="ftco-counter img ftco-section ftco-no-pt ftco-no-pb bg-light">
		<div class="container">
			<div class="row d-flex">
				<div class="col-md-6 col-lg-5 d-flex">
					<div class="img w-100 d-flex align-self-stretch align-items-center" style="background-image:url(/frontend/images/about.jpg);">
					</div>
				</div>
				<div class="col-md-6 col-lg-7 pl-lg-5">
					<div class="py-md-4">
						<div class="row justify-content-start pb-3">
							<div class="col-md-12 heading-section ftco-animate p-4 p-lg-5">
								<span class="subheading">Welcome to Petvet</span>
								<h2 class="mb-4">We Are Best Agency <br> For Your Pets</h2>
								<p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
								<ul class="list-services">
									<li class="d-flex align-items-center">
										<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-stethoscope"></span></div>
										<p>Qualified Groomer</p>
									</li>
									<li class="d-flex align-items-center">
										<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-stethoscope"></span></div>
										<p>Over 20 Years of Experienced</p>
									</li>
									<li class="d-flex align-items-center">
										<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-stethoscope"></span></div>
										<p>Animal Lover</p>
									</li>
									<li class="d-flex align-items-center">
										<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-stethoscope"></span></div>
										<p>Best Pet Care</p>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

@include('layouts.frontend.footer')
           
