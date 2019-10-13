@extends("layouts.base")


@section("content")
    
    <div class="container-fluid">
            <div class="row">
               <div class="col-12">
                  <div class="card">

                    @include('multiauth::message')

                     <div class="card-body">
                        <h4 class="mt-0 header-title">Add an Outlet</h4>

                        <p class="text-muted m-b-30 font-14">Field with  <code class="highlighter-rouge">red asterisks(*)</code> are compulsory or requried </p>


                        <form method="POST" action = "{{ url('/admin/outlet/add') }}" >

                        <div class="form-group row">
                           <label for="example-text-input" class="col-sm-2 col-form-label">Outlet Name</label>
                           <div class="col-sm-10"><input class="form-control" name="outlet_name" type="text" placeholder="Langa glorceries" ></div>
                        </div>

                        {{ csrf_field() }}

                        <div class="form-group row">
                           <label for="example-search-input" class="col-sm-2 col-form-label">Contact Person Name</label>
                           <div class="col-sm-10"><input class="form-control" name="contact_person_name" type="text" placeholder="Smith Sese" id="example-search-input"></div>
                        </div>

                        <div class="form-group row">
                           <label for="example-email-input" class="col-sm-2 col-form-label">Position</label>
                           <div class="col-sm-10"><input class="form-control" name="position" type="text" placeholder="Teller" id="example-email-input"></div>
                        </div>

                        <div class="form-group row">
                           <label for="example-email-input" class="col-sm-2 col-form-label">Mobile Number</label>
                           <div class="col-sm-10"><input class="form-control" name="mobile_number" type="text" placeholder="Teller" id="example-email-input"></div>
                        </div>

                        <div class="form-group row">
                           <label for="example-email-input" class="col-sm-2 col-form-label">Locality</label>
                           <div class="col-sm-10"><input class="form-control" name="locality" type="text" placeholder="Kasoa" id="example-email-input"></div>
                        </div>

                        <div class="form-group row">
                           <label for="example-email-input" class="col-sm-2 col-form-label">Sub Locality</label>
                           <div class="col-sm-10"><input class="form-control" name="sub_locality" type="text" placeholder="Kasoa barrier" id="example-email-input"></div>
                        </div>

                        <div class="form-group row">
                           <label for="example-email-input" class="col-sm-2 col-form-label">Landmark</label>
                           <div class="col-sm-10"><input class="form-control" name="landmark" type="text" placeholder="near kasoa christ Emsy" id="example-email-input"></div>
                        </div>

                        <div class="form-group row">
                           <label for="example-email-input" class="col-sm-2 col-form-label">Street Name</label>
                           <div class="col-sm-10"><input class="form-control" name="streetname" type="text" placeholder="LANE 100" id="example-email-input"></div>
                        </div>

                        <div class="form-group row">
                           <label for="example-email-input" class="col-sm-2 col-form-label">Latitude</label>
                           <div class="col-sm-10"><input class="form-control" name="latitude" type="text" placeholder="5.232332" id="example-email-input"></div>
                        </div>


                        <div class="form-group row">
                           <label for="example-email-input" class="col-sm-2 col-form-label">Longitude</label>
                           <div class="col-sm-10"><input class="form-control" name="logitude" type="text" placeholder="5.232332" id="example-email-input"></div>
                        </div>

                        <div class="form-group row">
                           <div class="col-md-6">
                              <label for="example-email-input" class="col-sm-2 col-form-label">Business Document 1</label>
                              <img src="https://img.icons8.com/?id=7211&size=500&color=000000" style="height: 100px">
                              <div class="col-sm-10"><input class="form-control" name="document_1" type="file"></div>
                           </div>

                           <div class="col-md-6">

                              <label for="example-email-input" class="col-sm-2 col-form-label">Business Document 2</label>
                              <img src="https://img.icons8.com/?id=7211&size=500&color=000000" 
                                 height="100px;" 
                              >
                              <div class="col-sm-10"><input class="form-control" name="document_2" type="file"></div>
                           </div>


                           
                        </div>



                            <div style="margin-top: 40px; ">
                                <center>
                                    <input type="submit" value="Add Promoter" class="btn btn-danger" />
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