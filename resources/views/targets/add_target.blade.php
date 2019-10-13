@extends("layouts.app")


@section("styles")

	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />

	<link href="/assets02/css/datepicker.css" rel="stylesheet" type="text/css">
    <script src="/assets02/js/datepicker.js"></script>
   	<script src="/assets02/js/datepicker.en.js"></script>
	

@endsection

@section("content")

	
	<div class="container-fluid">
            <div class="row">
               <div class="col-12">
                  <div class="card">

                    @include('multiauth::message')

                     <div class="card-body">
                        <h4 class="mt-0 header-title">Set an Appointment</h4>

                        <p class="text-muted m-b-30 font-14">Field with  <code class="highlighter-rouge">red asterisks(*)</code> are compulsory or requried </p>


                        <form method="POST" action = "{{ url('/admin/appointment/add') }}" >

                        <div class="form-group row">
                           <label for="example-text-input" class="col-sm-2 col-form-label">Outlets </label>
                           <div class="col-sm-10">

                           	<select id="outlets" class="form-control" name="outlets[]" multiple="multiple">
							  @foreach($data["outlets"] as $key => $outlet)
							  	<option value="{{ $outlet->id }}">{{ $outlet->outlet_name }}</option>
							  @endforeach
							</select>

                           </div>
                        </div>

                        {{ csrf_field() }}

                        

                        <div class="form-group row">
                           <label for="example-email-input" class="col-sm-2 col-form-label">Promoter</label>
                           <div class="col-sm-10">

                           	<select class="form-control" id="promoter"  name="promoter_id">
							  @foreach($data["promoters"] as $key => $promoter)
							  	<option value="{{ $promoter->id }}">{{ $promoter->name }}</option>
							  @endforeach
							</select>

                           </div>
                        </div>


                        <div class="form-group row">
                           <label for="example-email-input" class="col-sm-2 col-form-label">Reason for visit</label>
                           <div class="col-sm-10">

                           	<textarea class="form-control" placeholder="Reason" name="reason" ></textarea>

                           </div>
                        </div>


                        <div class="form-group row">
                           <label for="example-email-input" class="col-sm-2 col-form-label">Date</label>
                           <div class="col-sm-10">
	                           	<div>
			                      	<input type="text"
									    data-range="false"
									    data-multiple-dates-separator=" - "
									    data-language="en"
									    placeholder="Select Time range" 
									    name="day" 
									    class="datepicker-here form-control"/>

			                  	</div>

                           </div>
                        </div>


                        <center>
                        	<button class="btn btn-primary"> Add Target</button>
                        </center>



                        </div>
                     </div>
                  </div>
               </div>
               <!-- end col -->
            </div>
            <!-- end row -->
   </div>

@endsection
	


@section("scripts")

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<script type="text/javascript">
	
	$(document).ready(function() {

	    $('#promoter').select2({
	    	placeholder: "Select a promoter",
	    	allowClear: true
	    });

	    $('#outlets').select2({
	    	placeholder: "Select a Outlets",
	    	allowClear: true
	    });



	});
</script>


@endsection