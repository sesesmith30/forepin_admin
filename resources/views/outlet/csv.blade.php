@extends("layouts.base")

@section("styles")

    <link href="https://themesbrand.com/foxia/plugins/dropzone/dist/dropzone.css" rel="stylesheet" type="text/css">
	
@endsection



@section("content")

	<div class="container-fluid">
        <div class="row">
           <div class="col-12">
              <div class="card">
                 <div class="card-body">
                    @include('multiauth::message')


                    <h4 class="mt-0 header-title">Upload CSV</h4>
                    <p class="text-muted m-b-30 font-14">Upload CSV file </p>
                    
                    <div class="text-center m-t-15">

                    	<form method="POST" id="mForm" enctype="multipart/form-data" method="POST" action="{{ url('/admin/outlet/csv') }}">

                    		{{ csrf_field() }}

                    		<input type="file" name="file" class="form-control" accept=".xlsx, .xls, .csv">
                    		<br>
                    		<br>

                    		<button  type="submit" class="btn btn-primary waves-effect waves-light">Send Files</button>
                    		

                   	 	</form>
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
      <script src="https://themesbrand.com/foxia/plugins/dropzone/dist/dropzone.js"></script>

      <script type="text/javascript">
      	Dropzone.options.myAwesomeDropzone = false;
		var myDropzone = $(".dropzone").dropzone();
		function doThis () {

		}
		console.log(myDropzone);

		window.a = myDropzone;


      </script>
@endsection