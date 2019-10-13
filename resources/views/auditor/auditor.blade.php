@extends("layouts.base")

@section("action_btn")

   <button onclick="location.href = '/admin/auditor/add'" class="btn btn-light btn-rounded" type="button"  aria-haspopup="true" aria-expanded="false"><i class="ti-plus mr-1"></i> Add Auditor</button>


@endsection

@section("content")

   <div class="container-fluid">
            <div class="row">
               <div class="col-12">
                  <div class="card">
                     <div class="card-body">
                        <h4 class="mt-0 header-title">Auditor</h4>
                        <p class="text-muted m-b-30 font-14">List of all the Auditor in the system</p>
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
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @foreach($data['auditor'] as $key => $auditor)
                                    <tr>
                                       <th>#  <span class="co-name"> {{ $key + 1 }} </span></th>
                                       <td>{{ $auditor["name"] }}</td>
                                       <td>{{ $auditor["email"] }}</td>
                                       <td>{{ $auditor["username"] }}</td>
                                       <td>{{ $auditor["phone_number"] }}</td>
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
         </div>



@endsection