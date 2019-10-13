@extends("layouts.app")

@section("styles")
	
	<link href="/assets02/css/datepicker.css" rel="stylesheet" type="text/css">
    <script src="/assets02/js/datepicker.js"></script>
   	<script src="/assets02/js/datepicker.en.js"></script>
@endsection

@section("content")
	
	 <div class="container-fluid">
          
   			<form method="GET" action="">
   				<div class="row">
       				<div class="col-md-5">
	           			<select name="year" class="form-control">
		           			<option>2019</option>
		           		</select>
	           		</div>

	           		<?php
       					$selectedMonth = request('month', (int)now()->format("m"));
       					$selectYear = request('year', (int)now()->format("Y"));
       				?>

	           		<div class="col-md-6">
	           			<select name="month" class="form-control">
	           				
	           				@foreach($data["months"] as $key => $month)
		           				<option {{ $key + 1 == $selectedMonth ? 'selected' : '' }} value="{{ $key + 1 }}">{{ $month->format("F") }}</option>
	           				@endforeach

		           		</select>
	           		</div>

	           		<div class="col-md-1">
	           			<button type="submit" class="btn btn-primary"><i style="color: white" class="fa fa-refresh"></i></button>
	           		</div>
           		</div>

   			</form>
       			
           	<?php 

           		/**
           		 * get background color
           		 * @param  int $percentage
           		 * @return String
           		 */
           		function getBg($percentage) {

           			if ($percentage < 25) {
           				return "bg-danger";
           			}else if ($percentage < 50) {
           				return "bg-primary";
           			}else if ($percentage <= 100) {
           				return "bg-success";
           			}
           		}

           	?>
           	<br>
           	<div>
           		<h3>{{ $data["outlet"]->outlet_name }}</h3>
           		<span>{{ $data["outlet"]->locality }}</span>
           		<?php
           			$size = sizeof($data["outlet"]->toArray());
           			$sum = 0;
           			foreach ($data["outlet"]->toArray() as $key => $value) {
					    if(empty($value) || $value == null || $value == "") {
					    	$sum = $sum + 1;
					    }
					}
					$registrationPercentage = ($sum / $size) * 100;
					$registrationPercentage = number_format( $registrationPercentage,2,'.','' )
           		?>
           		<div class="pull-right" style="margin-top: -30px">
           			<a href="">registration progress<a>
           			<div class="progress" style="width: 100px" >
	                    <div class="progress-bar {{$registrationPercentage}}" role="progressbar" style="width: {{ $registrationPercentage }}%"  aria-valuemin="0" aria-valuemax="100">  {{$registrationPercentage}}% </div>
	                </div>
           		</div>
           		
           	</div>
           	
           	<br>
           	<br>

           	<div class="row">

           		<div class="col-md-3">
           			<div class="card">
           				<?php
           					$percentage = number_format( ( $data['stats']['visits']/100 ) * 100,2,'.','' );
           				?>
           				<div class="progress" style="margin: 5px">
                            <div class="progress-bar {{ getBg($percentage) }}" role="progressbar" style="width: {{ $percentage}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"> {{ $percentage }} % </div>
                        </div>



	           			<div class="card-body">
	           				<center><h3>{{ $data["stats"]["visits"] }}</h3></center>
	           			</div>

	           			<div class="card-footer">
	           				<center>Visited Outlets</center>
	           			</div>
	           		</div>
           		</div>

           		<div class="col-md-3">
           			<div class="card">
           				<?php
           					$percentage = number_format( ( ($data['stats']['orders']/ 40000 ) * 100) ,2,'.','' );
           				?>
           				<div class="progress" style="margin: 5px">
                            <div class="progress-bar {{ getBg($percentage) }}" role="progressbar" style="width: {{ $percentage}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"> {{ $percentage }} % </div>
                        </div>



	           			<div class="card-body">
	           				<center><h3>¢ {{ number_format($data["stats"]["orders"], '2','.', ',') }}</h3></center>
	           			</div>

	           			<div class="card-footer">
	           				<center>Orders Made</center>
	           			</div>
	           		</div>
           		</div>

           		<div class="col-md-3">
           			<div class="card">
           				<?php
           					$percentage = number_format( ( ($data['stats']['collections']/ 40000 ) * 100) ,2,'.','' );
           				?>
           				<div class="progress" style="margin: 5px">
                            <div class="progress-bar {{ getBg($percentage) }}" role="progressbar" style="width: {{ $percentage}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"> {{ $percentage }} % </div>
                        </div>



	           			<div class="card-body">
	           				<center><h3>¢ {{ number_format($data["stats"]["collections"], '2','.', ',') }}</h3></center>
	           			</div>

	           			<div class="card-footer">
	           				<center>Collections Made</center>
	           			</div>
	           		</div>
           		</div>

           		<div class="col-md-3">
           			<div class="card">
           				<?php
           					$percentage = number_format( ( $data['stats']['returns']/100 ) * 100,2,'.','' );
           				?>
           				<div class="progress" style="margin: 5px">
                            <div class="progress-bar {{ getBg($percentage) }}" role="progressbar" style="width: {{ $percentage}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"> {{ $percentage }} % </div>
                        </div>



	           			<div class="card-body">
	           				<center><h3>{{ $data["stats"]["returns"] }}</h3></center>
	           			</div>

	           			<div class="card-footer">
	           				<center>Visited Outlets</center>
	           			</div>
	           		</div>
           		</div>
           		

           	</div>

           	<div class="row">
           		<div class="col-md-12" style="margin-top: 20px">
			        <div class="card">
			            <div class="card-body">
			                <h4 class="mt-0 header-title">Activities in {{ now()->format("F") }}</h4>
			                <div class="table-responsive mt-4">
			                    <table class="table table-hover mb-0">
			                        <thead>
			                            <tr>
			                                <th scope="col">Day</th>
			                                <th scope="col">Orders</th>
			                                <th scope="col">Collections</th>
			                                <th scope="col">Returns</th>
			                            </tr>
			                        </thead>
			                        <tbody>
			                            
			                            @foreach($data["activities"] as $key => $activity)
			                            <tr>
			                            	<?php
			                            		$oultetId = $data["outlet"]->id;
			                            		$date = $activity["date"]->format("d/m/Y");
			                            	?>
			                                <th scope="row">{{ $activity['date']->toDateString() }}</th>

			                                <th><a href='{{ url("admin/orders?outlet=$oultetId&date=$date") }}'>{{ $activity['orders'] }}</a></th>
			                                <th scope="row">{{ $activity['collections'] }}</th>
			                                <th scope="row">{{ $activity['returns'] }}</th>
			                                
			                            </tr>
			                            @endforeach

			                        </tbody>
			                    </table>
			                </div>
			            </div>
			        </div>
			    </div>

           	</div>
		    

     </div>

@endsection

@section("scripts")
    <script src="https://www.gstatic.com/firebasejs/5.8.2/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/5.8.2/firebase-database.js"></script>
    <script src="//cdn.rawgit.com/lil-js/uuid/0.1.0/uuid.js"></script>    
    <script src="/js/app.js"></script>
    
@endsection