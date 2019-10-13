@extends("layouts.app")


@section("styles")
  
  <link href="/assets02/css/datepicker.css" rel="stylesheet" type="text/css">
    <script src="/assets02/js/datepicker.js"></script>
    <script src="/assets02/js/datepicker.en.js"></script>
@endsection



@section("content")
	
	   <div class="container-fluid">
        <div class="row">
           <div class="col-lg-12">
                 <!-- <div class="card-body"> -->
                    <google-map></google-map>
                 <!-- </div> -->
              <!-- </div> -->
           </div>

        </div>
     </div>

@endsection

@section("scripts")
    <script src="https://www.gstatic.com/firebasejs/5.8.2/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/5.8.2/firebase-database.js"></script>
    <script src="//cdn.rawgit.com/lil-js/uuid/0.1.0/uuid.js"></script>    

    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB7kMDqCrPcVv4uCROO1GOev9XCDqUEAAo&libraries=visualization"></script> -->


      <script src="/js/app.js"></script>
    
@endsection