@extends("layouts.app")

@section("action_btn")

   


@endsection


@section("content")

   <div class="col-12">
      <button onclick="location.href = '/admin/promoter/add'" class="btn btn-primary btn-rounded pull-right" type="button"  aria-haspopup="true" aria-expanded="false"><i class="ti-plus mr-1"></i> Add Promoter</button>
   </div>


   <br>
   <br>

   <div class="container-fluid">
            <div class="row">
               <div class="col-12">
                  <div class="card">
                     <div class="card-body">
                        <h4 class="mt-0 header-title">Promoters</h4>
                        <p class="text-muted m-b-30 font-14">List of all the promoters in the system</p>
                        <div class="table-rep-plugin">
                           <div class="table-responsive mb-0 b-0" data-pattern="priority-columns">
                              <table id="tech-companies-1" class="table table-striped">
                                 <thead>
                                    <tr>
                                       <th>Company</th>
                                       <th data-priority="1">Full name</th>
                                       <th data-priority="3">Email</th>
                                       <th data-priority="1">Username</th>
                                       <th data-priority="1">Phone Number</th>
                                       <th data-priority="1">No. of Prices</th>
                                       <th data-priority="1">Actions</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @foreach($data['promoters'] as $key => $promoter)
                                    <?php 
                                       $id = $promoter["id"];
                                    ?>
                                    <tr>
                                       <th><a href='{{ url("/admin/promoter/$promoter->id/show") }}'>#  <span class="co-name"> {{ $key + 1 }} </span></a></th>
                                       <td><a href='{{ url("/admin/promoter/$promoter->id/show") }}'>{{ $promoter["name"] }}</a></td>
                                       <td>{{ $promoter["email"] }}</td>
                                       <td>{{ $promoter["username"] }}</td>
                                       <td>{{ $promoter["phone_number"] }}</td>
                                       <td><a href='{{ url("admin/promoter/$promoter->id/prices")}}'>{{ $promoter->userPrices->count() }} {{$promoter->userPrices->count() == 1 ? "item": "items"}}</a></td>
                                       <td>
                                          <button onclick="onDeleteTapped({{$id}})" data-target=".delete-modal" data-toggle="modal" class="btn btn-danger "><i class="fa fa-trash"></i></button>
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
            <!-- end row -->

            <div class="modal fade delete-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title mt-0">Delete Promoter</h5>
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
         location.href = `/admin/promoter/${id}/delete`;
      }



    </script>
@endsection