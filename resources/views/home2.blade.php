@extends("layouts.app")


@section("styles")
  
  <link href="/assets02/css/datepicker.css" rel="stylesheet" type="text/css">

@endsection



@section("content")
	
	   <div class="container-fluid">
        <div class="row">
           <div class="col-lg-12">
                 <!-- <div class="card-body"> -->
                    <dashboard-map></dashboard-map>
                 <!-- </div> -->
              <!-- </div> -->
           </div>

        </div>
     </div>

@endsection

@section("scripts")
    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB7kMDqCrPcVv4uCROO1GOev9XCDqUEAAo&libraries=visualization"></script> -->


      <script src="/js/app.js"></script>
    
@endsection