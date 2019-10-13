@extends("layouts.base")


@section("content")
	  <div class="container-fluid">
            <div class="row">
               <div class="col-xl-3 col-md-6">
                  <div class="card mini-stats">
                     <div class="p-3 mini-stats-content">
                        <div class="mb-4">
                           <div class="float-right text-right">
                              <span class="badge badge-light text-info mt-2 mb-2">%</span>
                              <p class="text-white-50">From previous period</p>
                           </div>
                           <span class="peity-pie" data-peity='{ "fill": ["rgba(255, 255, 255, 0.8)", "rgba(255, 255, 255, 0.2)"]}' data-width="54" data-height="54">1/1</span>
                        </div>
                     </div>
                     <div class="ml-3 mr-3">
                        <div class="bg-white p-3 mini-stats-desc rounded">
                           <h5 class="float-right mt-0">2 </h5>
                           <h6 class="mt-0 mb-3">Auditors</h6>
                           <p class="text-muted mb-0">Active Auditors</p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-xl-3 col-md-6">
                  <div class="card mini-stats">
                     <div class="p-3 mini-stats-content">
                        <div class="mb-4">
                           <div class="float-right text-right">
                              <span class="badge badge-light text-success mt-2 mb-2">98%</span>
                              <p class="text-white-50">From last week</p>
                           </div>
                           <span class="peity-donut" data-peity='{ "fill": ["rgba(255, 255, 255, 0.8)", "rgba(255, 255, 255, 0.2)"], "innerRadius": 18, "radius": 32 }' data-width="54" data-height="54">4.8/5</span>
                        </div>
                     </div>
                     <div class="ml-3 mr-3">
                        <div class="bg-white p-3 mini-stats-desc rounded">
                           <h5 class="float-right mt-0"> </h5>
                           <h6 class="mt-0 mb-3">Outlets</h6>
                           <p class="text-muted mb-0">Total Outlets</p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-xl-3 col-md-6">
                  <div class="card mini-stats">
                     <div class="p-3 mini-stats-content">
                        <div class="mb-4">
                           <div class="float-right text-right">
                              <span class="badge badge-light text-success mt-2 mb-2">100%</span>
                              <p class="text-white-50"></p>
                           </div>
                           <span class="peity-pie" data-peity='{ "fill": ["rgba(255, 255, 255, 0.8)", "rgba(255, 255, 255, 0.2)"]}' data-width="54" data-height="54">8/8</span>
                        </div>
                     </div>
                     <div class="ml-3 mr-3">
                        <div class="bg-white p-3 mini-stats-desc rounded">
                           <h5 class="float-right mt-0"></h5>
                           <h6 class="mt-0 mb-3">Review Sections</h6>
                           <p class="text-muted mb-0">All Outlet Review Sessions</p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-xl-3 col-md-6">
                  <div class="card mini-stats">
                     <div class="p-3 mini-stats-content">
                        <div class="mb-4">
                           <div class="float-right text-right">
                              <span class="badge badge-light text-warning mt-2 mb-2"> 0%</span>
                              <p class="text-white-50">From last week</p>
                           </div>
                           <span class="peity-donut" data-peity='{ "fill": ["rgba(255, 255, 255, 0.8)", "rgba(255, 255, 255, 0.2)"], "innerRadius": 18, "radius": 32 }' data-width="54" data-height="54">0/5</span>
                        </div>
                     </div>
                     <div class="ml-3 mr-3">
                        <div class="bg-white p-3 mini-stats-desc rounded">
                           <h5 class="float-right mt-0"> </h5>
                           <h6 class="mt-0 mb-3">Skipped Outlet Session</h6>
                           <p class="text-muted mb-0">All Skipped Outlet</p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- end row -->
            <div class="row">
               <div class="col-xl-12">
                  <div class="card">
                     <div class="card-body">
                        <h4 class="mt-0 header-title">Auditors</h4>
                        <div class="row text-center m-t-20">
                           <div class="col-6">
                              <h5 class=""> 2  </h5>
                              <p class="text-muted font-14">Active Auditors</p>
                           </div>
                           <div class="col-6">
                              <h5 class="">0</h5>
                              <p class="text-muted font-14">Inactive Auditors</p>
                           </div>
                        </div>
                        <donut actives='2'></donut>
                        <!-- <div id="morris-donut-example" class="dash-chart morris-charts text-center"></div> -->
                     </div>
                  </div>
               </div>
            </div>
            
         </div>

@endsection

@section("scripts")
   
   <!--Morris Chart-->
      <script src="https://themesbrand.com/foxia/plugins/morris/morris.min.js"></script>
      <script src="https://themesbrand.com/foxia/plugins/raphael/raphael-min.js">
         
      </script><script src="/assets/pages/dashboard.js"></script><!-- App js --> 

@endsection

