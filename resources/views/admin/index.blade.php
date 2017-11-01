@extends('admin/layouts/default')
{{-- Page title --}}
@section('title')
Dashboard
@parent
@stop
{{-- page level styles --}}
@section('header_styles')
<link href="{{ asset('assets/vendors/fullcalendar/css/fullcalendar.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/css/pages/calendar_custom.css') }}" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" media="all" href="{{ asset('assets/vendors/bower-jvectormap/css/jquery-jvectormap-1.2.2.css') }}"/>
<link rel="stylesheet" href="{{ asset('assets/vendors/animate/animate.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/pages/only_dashboard.css') }}"/>
<meta name="_token" content="{{ csrf_token() }}">
<link rel="stylesheet" type="text/css"
   href="{{ asset('assets/vendors/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">
@stop
{{-- Page content --}}
@section('content')
<section class="content-header">
   <h1>Welcome to StaffLife Dashboard</h1>
   <ol class="breadcrumb">
      <li class="active">
         <a href="#">
         <i class="livicon" data-name="home" data-size="16" data-color="#333" data-hovercolor="#333"></i>
         Dashboard
         </a>
      </li>
   </ol>
</section>
<section class="content">
   <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6 margin_10">
         <!-- Trans label pie charts strats here-->
         <div class="lightbluebg no-radius">
            <div class="panel-body squarebox square_boxs">
               <div class="col-xs-12 pull-left nopadmar">
                  <div class="row">
                     <div class="square_box col-xs-7 text-right">
                        <span>Total Number of Users</span>
                        <div class="number" id="myTargetElement1"></div>
                     </div>
                     <i class="livicon  pull-right" data-name="users" data-l="true" data-c="#fff"
                        data-hc="#fff" data-s="70"></i>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 margin_10">
         <!-- Trans label pie charts strats here-->
         <div class="redbg no-radius">
            <div class="panel-body squarebox square_boxs">
               <div class="col-xs-12 pull-left nopadmar">
                  <div class="row">
                     <div class="square_box col-xs-7 pull-left">
                        <span>Number of Businesses</span>
                        <div class="number" id="myTargetElement2"></div>
                     </div>
                     <i class="livicon pull-right" data-name="piggybank" data-l="true" data-c="#fff"
                        data-hc="#fff" data-s="70"></i>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-3 col-sm-6 col-md-6 margin_10">
         <!-- Trans label pie charts strats here-->
         <div class="goldbg no-radius">
            <div class="panel-body squarebox square_boxs">
               <div class="col-xs-12 pull-left nopadmar">
                  <div class="row">
                     <div class="square_box col-xs-7 pull-left">
                        <span>Businesses on Trial</span>
                        <div class="number" id="myTargetElement3"></div>
                     </div>
                     <i class="livicon pull-right" data-name="rotate-left" data-l="true" data-c="#fff"
                        data-hc="#fff" data-s="70"></i>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated">
         <!-- Trans label pie charts strats here-->
         <div class="palebluecolorbg no-radius">
            <div class="panel-body squarebox square_boxs">
               <div class="col-xs-12 pull-left nopadmar">
                  <div class="row">
                     <div class="square_box col-xs-7 pull-left">
                        <span>Businesses on Active Packagess</span>
                        <div class="number" id="myTargetElement4"></div>
                     </div>
                     <i class="livicon pull-right" data-name="star-full" data-l="true" data-c="#fff"
                        data-hc="#fff" data-s="70"></i>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!--/row-->
   <div class="row ">
       <div class="col-lg-12 col-md-12 col-sm-12">
         <div class="panel panel-border">
            <div class="panel-heading">
               <h4 class="panel-title pull-left margin-top-10">
                  <i class="livicon" data-name="map" data-size="16" data-loop="true" data-c="#515763"
                     data-hc="#515763"></i>
                  Members Map
               </h4>
               <div class="btn-group pull-right">
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                  <i class="livicon" data-name="settings" data-size="16" data-loop="true" data-c="#515763"
                     data-hc="#515763"></i>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                     <li>
                        <a class="panel-collapse collapses" href="#">
                        <i class="fa fa-angle-up"></i>
                        <span>Collapse</span>
                        </a>
                     </li>
                     <li>
                        <a class="panel-refresh" href="#">
                        <i class="fa fa-refresh"></i>
                        <span>Refresh</span>
                        </a>
                     </li>
                     <li>
                        <a class="panel-config" href="#panel-config" data-toggle="modal">
                        <i class="fa fa-wrench"></i>
                        <span>Configurations</span>
                        </a>
                     </li>
                     <li>
                        <a class="panel-expand" href="#">
                        <i class="fa fa-expand"></i>
                        <span>Fullscreen</span>
                        </a>
                     </li>
                  </ul>
               </div>
            </div>
            <div class="panel-body nopadmar">
               <div id="world-map-markers" style="width:100%; height:300px;"></div>
            </div>
         </div>
      </div>
   </div>

</section>
@stop
{{-- page level scripts --}}
@section('footer_scripts')
<script type="text/javascript" src="{{ asset('assets/vendors/moment/js/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendors/datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
<!-- EASY PIE CHART JS -->
<script src="{{ asset('assets/vendors/bower-jquery-easyPieChart/js/easypiechart.min.js') }}"></script>
<script src="{{ asset('assets/vendors/bower-jquery-easyPieChart/js/jquery.easypiechart.min.js') }}"></script>
<script src="{{ asset('assets/vendors/bower-jquery-easyPieChart/js/jquery.easingpie.js') }}"></script>
<!--for calendar-->
<script src="{{ asset('assets/vendors/moment/js/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/fullcalendar/js/fullcalendar.min.js') }}" type="text/javascript"></script>
<!--   Realtime Server Load  -->
<script src="{{ asset('assets/vendors/flotchart/js/jquery.flot.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/flotchart/js/jquery.flot.resize.js') }}" type="text/javascript"></script>
<!--Sparkline Chart-->
<script src="{{ asset('assets/vendors/sparklinecharts/jquery.sparkline.js') }}"></script>
<!-- Back to Top-->
<script type="text/javascript" src="{{ asset('assets/vendors/countUp_js/js/countUp.js') }}"></script>
<!--   maps -->
<script src="{{ asset('assets/vendors/bower-jvectormap/js/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('assets/vendors/bower-jvectormap/js/jquery-jvectormap-world-mill-en.js') }}"></script>
<!--  todolist-->
<script src="{{ asset('assets/js/pages/todolist.js') }}"></script>
<script src="{{ asset('assets/js/pages/staffdashboard.js') }}" type="text/javascript"></script>
<script type="text/javascript">
   $( document ).ready(function() {

      var demo = new CountUp("myTargetElement1", <?php echo $total_users; ?>, 9500, 0, 0, options);
      //demo.start();
      var demo = new CountUp("myTargetElement2", <?php echo $businesses_count; ?>, 100, 0, 6, options);
      //demo.start();
      var demo = new CountUp("myTargetElement3", <?php echo $trialcount; ?>, 5000, 0, 6, options);
      //demo.start();
      var demo = new CountUp("myTargetElement4", <?php echo $businesses_active; ?>, 8000, 0, 6, options);
   
   });



   //Map of the members 
//world map
$(function(){
    $('#world-map-markers').vectorMap({
        map: 'world_mill_en',
        scaleColors: ['#C8EEFF', '#0071A4'],
        normalizeFunction: 'polynomial',
        hoverOpacity: 0.7,
        hoverColor: false,
        markerStyle: {
            initial: {
                fill: '#EF6F6C',
                stroke: '#383f47'
            }
        },
        backgroundColor: '#515763',
        markers: [
            <?php 
              foreach($countries_to_plot as $country_to_plot){
                  echo "{latLng: [" .$country_to_plot['latitude'] ."," .$country_to_plot['longitude'] ."], name: '" .$country_to_plot['name'] ." - " .$country_to_plot['number_of_users'] ." users'},";
              }
            ?>
        ]
    });
});
$(document).ready(function() {
    var composeHeight = $('#calendar').height() + 21 - $('.adds').height();
    $('.list_of_items').slimScroll({
        color: '#A9B6BC',
        height: composeHeight + 'px',
        size: '5px'
    });
});

</script>
@stop