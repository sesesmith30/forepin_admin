<!DOCTYPE html>
<html>
<head>
	<title>Order Print</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>

	<center></center>

	<div class="container">
			
			<div class="row col-md-12" style="padding: 20px">
					
					<div class="col-md-12">
						
						<center>
							<img style="height: 70px" src="http://68.183.151.163/assets02/images/forewin.png">
						</center>

					</div>

			</div>

			<div class="col-md-12" style="background-color: black; text-align: center;">
				<label style="color: white">ORDER PRINT</label>
			</div>

			<div class="col-md-12" style="border: 2px solid black">

			<table>
				<br>
				<tr colspan="2"> <center>This is order made on {{ $data["order"]->created_at }} by <b>{{ $data["order"]->promoter->name }}</b> at <i> {{ $data["order"]->outlet->outlet_name }}</i> </center></tr>
				
				<br>

				<table class="col-md-12" border="1px ">
					<tr>
						<th><center>Item</center></th>						
						<th><center>Quantity</center></th>						
						<th><center>Price </center></th>						
					</tr>
					@foreach( json_decode($data["order"]->orders_gson,true) as $key => $price)
					<tr>
						<td>{{ $price['item_description'] }}</td>
						<td><center>{{ $price['quantity'] }}</center></td>
						<td><center>{{ $price["price"] }}</center></td>
					</tr>
					@endforeach

		
				</table>

				<br>

				<table class="col-md-12" border="1px ">
					<?php
						$priceCollection = collect(json_decode($data["order"]->orders_gson),true)->map(function($item,$key){
				                return $item->price * $item->quantity;
				            });
                      
					?>
					<tr>
						<th><center>Total</center></th>						
						<th><center>Ghc {{ $priceCollection->sum() }}</center></th>							
					</tr>
					
				</table>

				<br>



			</table>


			</div>
	

	</div>


	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

	<script type="text/javascript">
		
		$(document).ready(function(){

			window.print();
		})

	</script>



</body>
</html>