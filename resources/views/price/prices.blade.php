@extends("layouts.app")

@section("action_btn")

   
@endsection

@section("content")

   <div class="col-12">

      <button data-toggle="modal" data-target=".add-modal" class="btn btn-primary btn-rounded pull-right" type="button"  aria-haspopup="true" aria-expanded="false"><i class="ti-plus mr-1"></i> Add Price</button>

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
                                       <th data-priority="3">Item Code</th>
                                       <th data-priority="1">Supplier</th>
                                       <th data-priority="1">Description</th>
                                       <th data-priority="1">Price</th>
                                       <th data-proority="1">Is Push Product</th>
                                       <th data-priority="1">Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @foreach($data['prices'] as $key => $price)
                                    <tr>
                                       <td>{{ $key + 1 }}</td>
                                       <td>{{ $price->item_code }}</td>
                                       <td>{{ $price->supplier }}</td>
                                       <td>{{ $price->item_description }}</td>
                                       <td>GHS {{ $price->price }}</td>
                                       <td>
                                          
                                          @if(!$price->is_push_product)
                                            <a href='{{ url("/admin/price/$price->id/add_to_push_product") }}' class="btn btn-success">add to Push Product</a>
                                          @else
                                            <a href='{{ url("/admin/price/$price->id/remove_from_push_product") }}' class="btn btn-warning">Remove from Push Product</a>
                                          @endif
                                       </td>
                                       <td>
                                          <button class="btn btn-danger" onclick="onDeleteTapped({{ $price->id }})" data-toggle="modal" data-target=".bs-example-modal-center"><i class="fa fa-trash"></i></button>
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


               <div class="modal fade add-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered">
                   <div class="modal-content">
                       <div class="modal-header">
                           <h5 class="modal-title mt-0">Add Price</h5>
                           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                       </div>
                       <div class="modal-body">
                           <form method="POST" action="{{ url('/admin/price/add') }}">
                                {{ csrf_field() }}
                                <label>Zone Name</label>

                                <input type="text" class="form-control" placeholder="Item Code" name="item_code" required>
                                <br>
                                <input type="text" class="form-control" placeholder="Supplier" name="supplier" required>
                                <br>

                                <input type="text" class="form-control" placeholder="Description" name="item_description" required>
                                <br>

                                <input type="number" step="0.01" class="form-control" placeholder="Price" name="price" required>

                                <input type="hidden" name="price_group_id" value="{{ $data['priceGroup']->id }}">

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

     $(document).ready(function(){
      $("#tech-companies-1").DataTable();
    })
      
      
      function onDeleteTapped(id) {
         $("#deleteId").val(id);
      }


      function onDelete() {
         var id = $("#deleteId").val();
         location.href = `/admin/price/${id}/delete`;
      }

   </script>
@endsection

