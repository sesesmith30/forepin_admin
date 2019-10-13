@extends("layouts.app")

@section('styles')
   <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection

@section("map")
   <div id="app" class="col-md-12" style="border-radius: 6px;">
      <br>
      <br>
      <google-map></google-map>
   </div>
@endsection


@section("scripts")
   <script src="https://www.gstatic.com/firebasejs/5.8.2/firebase-app.js"></script>
   <script src="https://www.gstatic.com/firebasejs/5.8.2/firebase-database.js"></script>
   <script src="//cdn.rawgit.com/lil-js/uuid/0.1.0/uuid.js"></script>    
   <script src="/js/app.js"></script>
      
   <!--Morris Chart-->
     <!--  <script src="https://themesbrand.com/foxia/plugins/morris/morris.min.js"></script>
      <script src="https://themesbrand.com/foxia/plugins/raphael/raphael-min.js"></script>
         
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
      <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
      <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script> -->
      <!-- {!! $data['chart']->script() !!} -->

     <!--  <script type="text/javascript">
         $('input[name="daterange"]').daterangepicker();
      </script> -->

@endsection

