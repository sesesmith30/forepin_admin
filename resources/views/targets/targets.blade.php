@extends("layouts.app")

@section("action_btn")

   
@endsection

@section("content")

    

    <div class="col-12">

      <label style="margin-left: 10px; text-align: center; margin-top: 10px; color: black; text-transform: uppercase; font-size: 17px; font-weight: 20px">Targets</label>

      <button onclick="location.href = '/admin/appointment/add'" class="btn btn-primary btn-rounded pull-right" type="button"  aria-haspopup="true" aria-expanded="false"><i class="ti-plus mr-1"></i> Add Target</button>
   </div>

   <br>
   <br>
   <br>

   <div class="container-fluid">

            <div class="row">
               <div class="col-12">
                  <div class="card">
                     <div class="card-body">
                        <h4 class="mt-0 header-title">Appointments</h4>
                        <p class="text-muted m-b-30 font-14">List of appoitnments Made</p>
                        <div class="table-rep-plugin">
                           <div class="table-responsive mb-0 b-0" data-pattern="priority-columns">
                              <table id="tech-companies-1" class="table table-striped">
                                 <thead>
                                    <tr>
                                       <th data-priority="1">#</th>
                                       <th data-priority="3">Promoter</th>
                                       <th data-priority="1">Outlets</th>
                                       <th data-priority="1">Reason </th>
                                       <th data-priority="1">Date</th>
                                       <th data-priority="1">Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @foreach($data['targets'] as $key => $target)
                                    
                                    <tr>
                                       <td>{{ $key + 1 }}</td>
                                       <td>{{ $target->promoter->name }}</td>
                                       <td>
                                        @foreach(json_decode($target->outlets,true) as $outlet)
                                          {{ $outlet["outlet_name"] }} <br>
                                        @endforeach

                                       </td>
                                       
                                       <td>
                                         {{ $target->reason }}
                                       </td> 

                                       <td>
                                         {{ $target->day }}
                                       </td>
                                        
                                       
                                       <td>
                                         
                                       		<button class="btn btn-danger" onclick="onDeleteTapped({{ $target->id }})" data-toggle="modal" data-target=".bs-example-modal-center"><i class="fa fa-trash"></i></button>
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
         location.href = `/admin/appointment/${id}/delete`;
      }

   </script>
@endsection

