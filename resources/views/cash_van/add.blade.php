@extends("layouts.app")


@section("content")
	
	<div class="container-fluid">
            <div class="row">
               <div class="col-12">
                  <div class="card">

                    @include('multiauth::message')

                     <div class="card-body">
                        <h4 class="mt-0 header-title">Register CashVan</h4>

                        <p class="text-muted m-b-30 font-14">Field with  <code class="highlighter-rouge">red asterisks(*)</code> are compulsory or requried </p>

                        <form method="POST" action = "{{ url('/admin/promoter/add') }}" >

                        <div class="form-group row">
                           <label for="example-text-input" class="col-sm-2 col-form-label">Name * </label>
                           <div class="col-sm-10"><input class="form-control" name="name" type="text" placeholder="Sese Smith Amoah" ></div>
                        </div>

                        {{ csrf_field() }}

                        <div class="form-group row">
                           <label for="example-search-input" class="col-sm-2 col-form-label">Email * </label>
                           <div class="col-sm-10"><input class="form-control" name="email" type="email" placeholder="sesesmith30@gmail.com" id="example-search-input"></div>
                        </div>


                        <input type="hidden" name="client_type" value="cash_van">


                        <div class="form-group row">
                           <label for="example-email-input" class="col-sm-2 col-form-label">Phone Number *</label>
                           <div class="col-sm-10"><input class="form-control" name="phone_number" type="text" placeholder="+233577719143" id="example-email-input"></div>
                        </div>

                        <input type="checkbox" name="is_consignment"> Is Consignment


                        	<div style="margin-top: 40px; ">
                        		<center>
                        			<input type="submit" value="Add Cash Van" class="btn btn-danger" />
                        		</center>
                        	</div>

                        </div>
                     </div>
                  </div>
               </div>
               <!-- end col -->
            </div>
            <!-- end row -->
         </div>
@endsection