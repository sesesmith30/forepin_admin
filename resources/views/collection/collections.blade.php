@extends("layouts.app")

@section("styles")
  
  <link href="/assets02/css/datepicker.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script src="/assets02/js/datepicker.js"></script>
    <script src="/assets02/js/datepicker.en.js"></script>
     
   
@endsection

@section("content")

    <label style="margin-left: 10px; color: black; text-transform: uppercase; font-size: 17px; font-weight: 20px">Collections</label>
   <br>
   <br>

   <div class="container-fluid">

            <div class="row">
               <div class="col-xl-12">
                  <div class="card">
                     <div class="card-body">

                        <div class="row">
                            <div class="col-md-5">
                                <h4 class="mt-0 header-title mb-5">Collections review</h4>
                            </div>

                            <?php 
                              $selectedPromoter = request("promoter",null);
                            ?>
                            <div class="col-md-7">

                                <form method="GET" action="">
                                  <div class="row">

                                      <select name="promoter" class=" col-md-5 form-control">
                                        <option value="0">All</option>
                                        @foreach($data["promoters"] as $key => $promoter)
                                          <option {{ $selectedPromoter == $promoter->id ? 'selected' : '' }} value="{{ $promoter->id }}">{{ $promoter->name }}</option>
                                        @endforeach
                                      </select>

                                      <div class="col-md-5">
                                        <input type="text" name="daterange" class="form-control"
                                      value="{{$range}}" />
                                      </div>

                                      <button class="col-md-1 btn btn-primary"><i class="fa fa-refresh"></i></button>

                                  </div>
                                </form>



                            </div>
                        </div>

                        <div style="height: 300px">

                           {!! $data['chart']->container() !!}
                              
                        </div>
                     </div>
                  </div>
               </div>
              
            </div>


            <div class="row">
               <div class="col-12">
                  <div class="card">
                     <div class="card-body">
                        <div class="row">
                            <div class="col-md-5">
                                <h4 class="mt-0 header-title">Collections</h4>
                                <p class="text-muted m-b-30 font-14">List of Collections Made</p>
                            </div>

                        </div>

                        <div class="row">
                          <div class="col-md-12">
                            <div class="table-rep-plugin">
                             <div class="table-responsive mb-0 b-0" data-pattern="priority-columns">
                                <table id="tech-companies-1" class="table table-striped">
                                   <thead>
                                      <tr>
                                         <th data-priority="1">#</th>
                                         <th data-priority="3">Promoter</th>
                                         <th data-priority="1">Outlet</th>
                                         <th data-priority="1">Amount </th>
                                         <th data-priority="1">Price</th>
                                      </tr>
                                   </thead>
                                   <tbody>
                                      @foreach($data['collections'] as $key => $collection)
                                      
                                      <tr>
                                         <td>{{ $key + 1 }}</td>
                                         <td>{{ $collection->promoter->name }}</td>
                                         <td>{{ $collection->outlet->outlet_name }}</td>

                                         <td>
                                            Ghc {{ $collection->amount }}
                                            
                                         </td> 
                                         <td>
                                           
                                           {{ $collection->created_at }}
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    {!! $data['chart']->script() !!}

  
   <script type="text/javascript">

       $(document).ready(function(){
        $("#tech-companies-1").DataTable();
      })
      
      function onDeleteTapped(id) {
         $("#deleteId").val(id);
      }

      function onDelete() {
         var id = $("#deleteId").val();
         location.href = `/admin/order/${id}/delete`;
      }

      $('input[name="daterange"]').daterangepicker();

   </script>
@endsection

