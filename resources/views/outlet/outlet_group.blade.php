@extends("layouts.app")

@section("action_btn")

   


@endsection

@section("content")
   

   <div class="col-12">

     <button data-target=".add-modal" data-toggle="modal" class="btn btn-primary btn-rounded pull-right" style="margin-left: 10px" type="button"  aria-haspopup="true" aria-expanded="false"><i class="ti-plus mr-1"></i> Add New Zone</button>

      <br>

      <br>

   </div>

   <div class="container-fluid">
            <div class="row">
               <div class="col-12">
                  <div class="card">
                     <div class="card-body">
                        <h4 class="mt-0 header-title">Outlets</h4>
                        <p class="text-muted m-b-30 font-14">List of all the Outlets in the system</p>
                        <div class="table-rep-plugin">
                           <div class="table-responsive mb-0 b-0" data-pattern="priority-columns">
                              <table id="tech-companies-1" class="table table-striped">
                                 <thead>
                                    <tr>
                                       <th data-priority="1">#</th>
                                       <th data-priority="3">Outlet zone</th>
                                       <th data-priority="1">Outlet Number</th>
                                       <th data-priority="1">Assigned Promoter</th>
                                       <th data-priority="1">Actions</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
                                       $counter = 0;
                                    ?>
                                    @foreach($data['outlets'] as $key => $outlet)
                                        <?php 
                                          $counter = $counter + 1;
                                          $url = "/admin/outlet/".$outlet['name']."/show";
                                          $id = $outlet['id'];
                                         ?>
                                       <tr style="cursor: pointer;">
                                       
                                       <th onclick='location.href = "{{$url}}" '>#  <span class="co-name"> {{ $counter }} </span></th>
                                       
                                       <td onclick='location.href = "{{$url}}" '> {{ $outlet['name'] }}  </td>
                                       
                                       <td onclick='location.href = "{{$url}}" '>{{ sizeof($outlet['outlets']) }}</td>


                                       <td>{{ 
                                          isset($outlet['promoter']) ? $outlet['promoter']['name'] : "No Promoter"  }}

                                          @if( !isset($outlet['assigned_promoter']) && $outlet['name'] != "null"  )
                                             <button onclick="onModalClicked({{ $outlet['id'] }})" data-toggle="modal" data-target=".bs-example-modal-center" class="btn btn-primary"><i class="dripicons-user"></i></button>
                                          @endif

                                       </td>

                                       <td>
                                          <button onclick="onDeleteTapped({{$id}})" data-target=".delete-modal" data-toggle="modal" class="btn btn-danger "><i class="fa fa-trash"></i></button>
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
               <!-- end col -->
            </div>
            <!-- end row -->

            <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered">
                   <div class="modal-content">
                       <div class="modal-header">
                           <h5 class="modal-title mt-0">Assign Promoter</h5>
                           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                       </div>
                       <div class="modal-body">
                           <form method="POST" action="{{ url('/admin/outlet/assign_promoter') }}">
                                {{ csrf_field() }}
                                <label>Select Promoter</label>

                                <select name="promoter_id" class="form-control">
                                  @foreach($data["promoters"] as $key => $promoter)
                                     <option value="{{ $promoter->id }}">{{ $promoter->name }}</option>
                                  @endforeach
                                </select>

                                <input type="hidden" id="outlet_zone_id" name="outlet_zone_id">

                                <br><br>

                                <center><button class="btn btn-primary"> Assign </button></center>

                           </form>
                       </div>
                   </div>
                   <!-- /.modal-content -->
               </div>
               <!-- /.modal-dialog -->
            </div>

            <div class="modal fade delete-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title mt-0">Assign Promoter</h5>
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


            <div class="modal fade add-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered">
                   <div class="modal-content">
                       <div class="modal-header">
                           <h5 class="modal-title mt-0">Add Outlet Zone</h5>
                           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                       </div>
                       <div class="modal-body">
                           <form method="POST" action="{{ url('/admin/outlet/zone/add') }}">
                                {{ csrf_field() }}
                                <label>Zone Name</label>

                                <input type="text" class="form-control" placeholder="Zone name" name="name">

                                <br><br>

                                <center><button class="btn btn-primary"> Add </button></center>

                           </form>
                       </div>
                   </div>
                   <!-- /.modal-content -->
               </div>
               <!-- /.modal-dialog -->
            </div>



         </div>



@endsection

@section("scripts")
    <script type="text/javascript">

      $(document).ready(function(){
        $("#tech-companies-1").DataTable();
      })
      
      function onModalClicked(id){
          $("#outlet_zone_id").val(id);
      }


       function onDeleteTapped(id) {
         $("#deleteId").val(id);
      }


      function onDelete() {
         var id = $("#deleteId").val();
         location.href = `/admin/outlet/zone/${id}/delete`;
      }



    </script>
@endsection