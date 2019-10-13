@extends("layouts.app")

@section("action_btn")


@endsection

@section("content")

   <div class="col-12">
      <button onclick="location.href = '/admin/cash_van/add'" class="btn btn-primary btn-rounded pull-right" type="button"  aria-haspopup="true" aria-expanded="false"><i class="ti-plus mr-1"></i> Add Cash Van</button>
   </div>
   <br>

   <br>
   <br>

   <div class="container-fluid">
            <div class="row">
               <div class="col-12">
                  <div class="card">
                     <div class="card-body">
                        <h4 class="mt-0 header-title">Cash Vans</h4>
                        <p class="text-muted m-b-30 font-14">List of all the cash vans in the system</p>
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
                                       <th data-priority="1">Is Consignment</th>
                                       <th data-priority="1">No. of Prices</th>
                                       <th data-priority="1">Actions</th>

                                    </tr>
                                 </thead>
                                 <tbody>
                                    @foreach($data['cashVans'] as $key => $cashVan)
                                    <?php
                                       $id = $cashVan["id"];
                                    ?>
                                    <tr>
                                       <th><a href='{{ url("/admin/promoter/$cashVan->id/show") }}'>#  <span class="co-name"> {{ $key + 1 }} </span></a></th>
                                       <td><a href='{{ url("/admin/promoter/$cashVan->id/show") }}'>{{ $cashVan["name"] }}</a></td>
                                       <td>{{ $cashVan["email"] }}</td>
                                       <td>{{ $cashVan["username"] }}</td>
                                       <td>{{ $cashVan["phone_number"] }}</td>
                                       <td>{{ $cashVan["is_consignment"] ? 'YES' : 'NO' }}</td>
                                       <td><a href='{{ url("admin/cash_van/$cashVan->id/prices")}}'>{{ $cashVan->userPrices->count() }} {{$cashVan->userPrices->count() == 1 ? "item": "items"}}</a></td>

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
                              <h5 class="modal-title mt-0">Delete Cash Van</h5>
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