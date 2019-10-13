@extends("layouts.app")

@section("action_btn")

   
@endsection

@section("content")


   <div class="col-12">
      <button data-toggle="modal" data-target=".add-modal" class="btn btn-primary btn-rounded pull-right" type="button"  aria-haspopup="true" aria-expanded="false"><i class="ti-plus mr-1"></i> Add Pricing Group</button>

       <button style="margin-right: 10px" data-toggle="modal" data-target=".add_csv" class="btn btn-primary btn-rounded pull-right" type="button"  aria-haspopup="true" aria-expanded="false"><i class="ti-plus mr-1"></i> Add Via CSV</button>

   </div>


   <br>
   <br>

   <div class="container-fluid">
            <div class="row">
               <div class="col-12">
                  <div class="card">
                     <div class="card-body">
                        <h4 class="mt-0 header-title">Prices</h4>
                        <p class="text-muted m-b-30 font-14">List of all the pricing of our products</p>
                        <div class="table-rep-plugin">
                           <div class="table-responsive mb-0 b-0" data-pattern="priority-columns">
                              <table id="tech-companies-1" class="table table-striped">
                                 <thead>
                                    <tr>
                                       <th data-priority="1">#</th>
                                       <th data-priority="3">Group Name</th>
                                       <th data-priority="3">Group Size</th>
                                       <th data-priority="1">Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @foreach($data['groups'] as $key => $group)
                                    <?php $url = url("/admin/price/group/$group->id") ?>
                                    <tr>
                                       <td>{{ $key + 1 }}</td>
                                       <td style="cursor: pointer;" onclick='location.href = " {{ $url }} "''>{{ $group->group_name }}</td>
                                       <td style="cursor: pointer;" onclick='location.href = " {{ $url }} "''>{{ sizeof($group->prices) }}</td>
                                       <td>
                                       		<button class="btn btn-danger" onclick="onDeleteTapped({{ $group->id }})" data-toggle="modal" data-target=".bs-example-modal-center"><i class="fa fa-trash"></i></button>
                                       </td>
                                    </tr>
                                    @endforeach

                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- end col -->
            </div>


             <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title mt-0">Delete Price Group</h5>
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
                              <h5 class="modal-title mt-0">Upload Pricing via CSV</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                          </div>
                          <div class="modal-body">
                         
                              <form method="POST" enctype="multipart/form-data" action="{{ url('/admin/price/upload_csv') }}">
                                {{ csrf_field() }}

                                <input type="file" name="file" class="form-control">

                                <button style="margin-top: 10px" type="submit" class="btn btn-info">Upload</button>

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
                           <h5 class="modal-title mt-0">Add Pricing Group</h5>
                           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                       </div>
                       <div class="modal-body">
                           <form method="POST" action="{{ url('/admin/price/group/add') }}">
                                {{ csrf_field() }}
                                <label>Group Name</label>

                                <input type="text" class="form-control" placeholder="Group name" name="group_name" required>
                                <br>
                                

                                <br><br>

                                <center><button class="btn btn-primary"> Add </button></center>

                           </form>
                       </div>
                   </div>
                   <!-- /.modal-content -->
               </div>
               <!-- /.modal-dialog -->
            </div>




            <!-- end row -->
         </div>



@endsection

@section("scripts")
   
   <script type="text/javascript">

    $(document).ready(function() {
      $("#tech-companies-1").DataTable();
    });
      
      function onDeleteTapped(id) {
         $("#deleteId").val(id);
      }


      function onDelete() {
         var id = $("#deleteId").val();
         location.href = `/admin/price/group/${id}/delete`;
      }

   </script>
@endsection

