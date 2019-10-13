@extends("layouts.app")

@section("action_btn")

@endsection

@section("content")

   <div class="col-12">

    {{-- {{ print_r($errors) }} --}}

     <button onclick="location.href = '/admin/outlet/add'" class="btn btn-primary btn-rounded pull-right" style="margin-left: 10px" type="button"  aria-haspopup="true" aria-expanded="false"><i class="ti-plus mr-1"></i> Add Outlet</button>

    <button data-toggle="modal" data-target=".add_csv" class="btn btn-primary btn-rounded pull-right" type="button"  aria-haspopup="true" aria-expanded="false"><i class="ti-plus mr-1"></i> Upload CSV</button>

      <br>

      <br>

   </div>

   <div class="container-fluid">
            <div class="row">
               <div class="col-12">
                  <div class="card">
                     <div class="card-body">
                        <h4 class="mt-0 header-title">{{ $name }}</h4>
                        <p class="text-muted m-b-30 font-14">List of {{ $name }}</p>
                        <div class="table-rep-plugin">
                           <div class="table-responsive mb-0 b-0" data-pattern="priority-columns">
                              <table id="tech-companies-1" class="table table-striped">
                                 <thead>
                                    <tr>
                                       <th>number</th>
                                       <th data-priority="1">Outlet Name</th>
                                       <th data-priority="3">Representative Name</th>
                                       <th data-priority="1">Position</th>
                                       <th data-priority="1">Mobile Number</th>
                                       <th data-priority="1">Recruiter</th>
                                       <th data-priority="1">Locality</th>
                                       <th data-priority="1">Sub Locality</th>
                                       <th data-priority="1">Landmark</th>
                                       <th data-priority="1">Streetname</th>
                                       <th data-priority="1">Coodinates</th>
                                       <th data-priority="1">Action</th> 
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @foreach($data['outlets'] as $key => $outlet)
                                    <tr>
                                       <th>#  <span class="co-name"> {{ $key + 1 }} </span></th>
                                       <td><a href='{{ url("/admin/outlet/$outlet->id/details") }}'> {{ $outlet->outlet_name }}</a></td>
                                       <td>{{ $outlet->contact_person_name }}</td>
                                       <td>{{ $outlet->position }}</td>
                                       <td>{{ $outlet->mobile_number }}</td>
                                       <td>
                                          @if(isset($outlet->recruiter))
                                            <?php 
                                              $promoterId = $outlet->recruiter->id;
                                            ?>
                                            <a href='{{ url("/admin/promoter/$promoterId/show") }}'> {{ $outlet->recruiter->name }} </a>
                                          @else
                                            <center><label> - </label></center>
                                          @endif
                                        </td>
                                       <td>{{ $outlet->locality }}</td>
                                       <td>{{ $outlet->sub_locality }}</td>
                                       <td>{{ $outlet->landmark }}</td>
                                       <td>{{ $outlet->streetname }}</td>
                                       <td>{{ $outlet->latitude }}, {{ $outlet->logitude  }}
                                       <td>

                                          @if(isset($isNew))
                                             <a href='{{ url("/admin/outlets/new/$outlet->id/print") }}' class="btn btn-info"><i class="fa fa-print"></i></a>
                                          @endif

                                          @if($outlet->zone_id == 0)
                                             <button data-toggle="modal" onclick="onAssignTapped({{ $outlet->id }})" data-target=".add-modal" class="btn btn-info">assign zone</button>
                                          @endif

                                          <button class="btn btn-danger" onclick="onDeleteTapped({{ $outlet->id }})" data-toggle="modal" data-target=".bs-example-modal-center">
                                             <i class="fa fa-trash"></i>
                                          </button>
                                       </td>
                                       </td>
                                    </tr>
                                    @endforeach

                                 </tbody>

                              </table>

                              <center>
                              {{ $data['outlets']->links() }}
                           </center>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title mt-0">Delete</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                          </div>
                          <div class="modal-body">
                              <center>Are you sure you want to delete ? 
                              <br><br>

                              <button class="btn btn-warning">No</button>

                              <input type="hidden" id="deleteId">

                              <button onclick="onDelete()" class="btn btn-danger">Yes</button>
                              </center>
                          </div>
                      </div>
                      <!-- /.modal-content -->
                  </div>
               <!-- /.modal-dialog -->
               </div>

               <div class="modal fade add_csv" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title mt-0">Add Via CSV</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                          </div>
                          <div class="modal-body">
                              <form method="POST" action="{{  url('/admin/outlet/csv') }}" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <input type="file" class="form-control" name="file" required>

                                @if(isset($data['currentZone'])) 
                                  <input type="hidden" name="zone_id" value='{{ $data["currentZone"]->id }}' >
                                @endif

                                <center>
                                  <button style="margin-top: 40px" type="submit" class="btn btn-info">Add</button>
                                
                                </center>
                            
                              </form>

                              
                          </div>
                      </div>
                      <!-- /.modal-content -->
                  </div>
               <!-- /.modal-dialog -->
               </div>




               <div class="modal fade add-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title mt-0">Assign Zone</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                          </div>
                          <div class="modal-body">
                              <form id="assing_form" method="POST">
                                   {{ csrf_field() }}
                                   <label>Zone Name</label>

                                   <select name="zone_id" class="form-control">
                                       @foreach($data["zones"] as $zone)
                                          <option value="{{ $zone->id }}">{{ $zone->name }}</option>
                                       @endforeach
                                   </select>

                                   <br><br>

                                   <center><button class="btn btn-primary"> Assign </button></center>

                              </form>
                          </div>
                      </div>
                      <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
               </div>


               <!-- end col -->
            </div>
            <!-- end row -->
         </div>



@endsection

@section("scripts")
   
   <script type="text/javascript">

      $(document).ready(function(){
        $("#tech-companies-1").DataTable();
      })
      
      function onDeleteTapped(id) {
         $("#deleteId").val(id);
      }


      function onDelete() {
         var id = $("#deleteId").val();
         location.href = `/admin/outlet/${id}/delete`;
      }

      function onAssignTapped(id) {
         
         var form = $("#assing_form");
         let url = {!! json_encode(url('/')) !!};
         form.attr("action", url+`/admin/outlet/${id}/zone/assign` );

      }

   </script>
@endsection