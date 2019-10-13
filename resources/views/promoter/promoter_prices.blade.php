@extends("layouts.app")

@section("action_btn")

   

@endsection

@section('styles')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
@endsection   


@section("content")

   <div class="col-12">
      <button data-toggle="modal" data-target=".bs-example-modal-lg" class="btn btn-primary btn-rounded pull-right" type="button"  aria-haspopup="true" aria-expanded="false"><i class="ti-plus mr-1"></i> Assign Price</button>
   </div>


   <br>
   <br>

   <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                @include('partials.alert')
              </div>
               <div class="col-12">
                  <div class="card">
                     <div class="card-body">
                        <h4 class="mt-0 header-title">Prices</h4>
                        <p class="text-muted m-b-30 font-14">List of all the prices for {{$user->name}}</p>
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
                                      {{-- <th data-proority="1">Is Push Product</th> 
                                       <th data-priority="1">Action</th>--}}
                                    </tr>
                                 </thead>
                                 <tbody>

                                  @foreach($userPrices as $index => $userPrice)
                                    <tr>
                                       <td>{{ $index + 1 }}</td>
                                       <td>{{ $userPrice->price->item_code }}</td>
                                       <td>{{ $userPrice->price->supplier }}</td>
                                       <td>{{ $userPrice->price->item_description }}</td>
                                       <td>GHS {{ $userPrice->price->price }}</td>
                                       {{-- <td>
                                          
                                          @if(!$userPrice->price->is_push_product)
                                            <a href='{{ url("/admin/price/$price->id/add_to_push_product") }}' class="btn btn-success">add to Push Product</a>
                                          @else
                                            <a href='{{ url("/admin/price/$price->id/remove_from_push_product") }}' class="btn btn-warning">Remove from Push Product</a>
                                          @endif
                                       </td>
                                       <td>
                                          <button class="btn btn-danger" onclick="onDeleteTapped({{ $price->id }})" data-toggle="modal" data-target=".bs-example-modal-center"><i class="fa fa-trash"></i></button>
                                       </td> --}}
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

             <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title mt-0">Choose Price</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                          </div>
                          <form method="post" action="{{ route('price.assign') }}">
                            @csrf

                            <div class="modal-body">
                                <input type="hidden" name="user_id" value="{{$user->id}}">
                              <div class="row">
                                <div class="col-md-12">
                                  <select class="form-control select" name="price_id" style="width: 100%;" required>
                                    <option value="">Choose Item</option>
                                    @foreach($prices as $price)
                                      <option value="{{$price->id}}">{{$price->item_code}}, {{$price->item_description}} - GHS{{ $price->price}}</option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>

                          </div>

                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Assign Price</button>
                          </div>


                          </form>
                      </div>
                      <!-- /.modal-content -->
                  </div>
               <!-- /.modal-dialog -->
               </div>


         </div>


        



@endsection

@section("scripts")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
    <script type="text/javascript">

      $(document).ready(function(){
        $("#tech-companies-1").DataTable();
        $('.select').select2({
          dropdownParent: $('.bs-example-modal-lg')
        });
      })


      
     


    </script>
@endsection