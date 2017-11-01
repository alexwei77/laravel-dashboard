@extends('admin/layouts/defaultx')
{{-- Page title --}}
@section('title')
Dashboard
@parent
@stop
{{-- page level styles --}}
@section('header_styles')
@if(isset($subData) && count($subData) > 0)
<script>ga('ecommerce:addTransaction', {
   'id': '<?php echo $subData['transactionid']; ?>',   // Transaction ID. Required.
   'affiliation': 'StaffLife',     // Affiliation or store name.
   'revenue': '<?php echo $subData['amount']; ?>',     // Grand Total.
   'packageid': '<?php echo $subData['packageid']; ?>', // Package ID.
   'packagename': '<?php echo $subData['packagename']; ?>', // Package Name.
   });
   ga('ecommerce:send');
   ga('ecommerce:clear');
</script>
@endif
<link href="{{ asset('assets/vendors/animationcharts/jquery.circliful.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/css/pages/charts.css') }}" rel="stylesheet" type="text/css"/>
<link type="text/css" rel="stylesheet" href="{{ asset('assets/css/pages/flot.css') }}" />
<!--for pie charts -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/c3/c3.min.css') }}" rel="stylesheet" type="text/css" />
<link  rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/morrisjs/morris.css') }}" rel="stylesheet" type="text/css" />
<!--<link href="{{ asset('assets/css/pages/piecharts.css') }}" rel="stylesheet" type="text/css" />-->
<style> 
   #bar-chart-stacked div.xAxis div.tickLabel 
   {    
   transform: rotate(-70deg);
   -ms-transform:rotate(-70deg); /* IE 9 */
   -moz-transform:rotate(-70deg); /* Firefox */
   -webkit-transform:rotate(-70deg); /* Safari and Chrome */
   -o-transform:rotate(-70deg); /* Opera */
   /*rotation-point:50% 50%;*/ /* CSS3 */
   /*rotation:270deg;*/ /* CSS3 */
   margin-top: 20px;
   margin-bottom: 5px;
   }
   .row, .row > div[class*='col-'] {  
   display: -webkit-box;
   display: -moz-box;
   display: -ms-flexbox;
   display: -webkit-flex;
   display: flex;
   flex:1 0 auto;
   }
   .panel {
   width:100%;
   }
   .load-more-employees{
   }
   .bottom-align-text {
   position: absolute;
   bottom: 13%;
   }
   .square_box .number {
   margin-top:10%;
   }
</style>
@stop
{{-- Page content --}}
@section('content')
<?php
   //create array of pairs of x and y values
   $dataset1 = array();
   $dataset2 = array();
   $counter = 1;
   foreach($ratings2Plot as $dataunit){
       //echo $dataunit->rated_fullname;
         $dataset1[] = array($counter, $dataunit->employees_quantity);
         $dataset2[] = array($counter+0.25, $dataunit->employees_quantity);
         $counter++;
   }
   
   
   use App\User;
   use Illuminate\Support\Facades\DB;
   
   $user = Sentinel::getUser();
   
   $checkIfAdmin = DB::table('dmmx_admins_table')->where([['email', $user->email],['status', 'Active']])->get();
   
   if (count($checkIfAdmin) > 0) {
            $adminRow = DB::table('dmmx_admins_table')->where('email', $user->email)->first();
            $userID = $adminRow->userid;
        } else {
            $userID = $user->id;
        }
   
    $user = DB::table('users')->where('id', $userID)->first();
   
   //get the dashboard data 
   $dashboard_data = DB::table('dashboard_data')->where('user_id', $user->id)->whereYear('updated_at', '=', date('Y'))->first();

   
   //get the past 12 months 
   $months = [date("Y-m")];
   for ($i = 1; $i <= 11; $i++) {
    $months[] = date("Y-m", strtotime( date( 'Y-m-01' )." -$i months"));
}

$months = array_reverse($months);

   
   ?>
<section class="content-header">
   <h1><strong> Welcome to dashboard <?php echo $user->first_name ." " .$user->last_name; ?> </strong></h1>
   <ol class="breadcrumb">
      <li>
         <a href="{{ route('admin.dashboard') }}">
         <i class="livicon" data-name="barchart" data-size="14" data-color="#000"></i>
         Dashboard
         </a>
      </li>
   </ol>
</section>
<!-- Main content -->
<section class="content">
   <div class="row">
      <!--<div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInLeftBig">-->
         <!-- Trans label pie charts strats here-->
         <!--<div class="lightbluebg no-radius">
            <div class="panel-body squarebox square_boxs">
               <div class="col-xs-12 pull-left nopadmar">
                  <div class="row">
                     <div class="square_box col-xs-7 text-right">
                        <span><b>Prospects</b></span>
                        <div class="number" id="myTargetElement1"></div>
                     </div>
                     <i class="livicon  pull-right" data-name="eye-open" data-l="true" data-c="#fff"
                        data-hc="#fff" data-s="70"></i>
                  </div>
                  <div class="row">
                     <div class="col-xs-12">
                        <small class="stat-label">Profile lookups in 2017</small>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>-->
      <div class="col-lg-4 col-md-6 col-sm-6 margin_10 animated fadeInUpBig">
         <!-- Trans label pie charts strats here-->
         <div class="goldbg no-radius">
            <div class="panel-body squarebox square_boxs">
               <div class="col-xs-12 pull-left nopadmar">
                  <div class="row">
                     <div class="square_box col-xs-7 pull-left">
                        <span><b>Employees Joined</b></span>
                        <div class="number" id="myTargetElement2"></div>
                     </div>
                     <i class="livicon pull-right" data-name="users-add" data-l="true" data-c="#fff"
                        data-hc="#fff" data-s="70"></i>
                  </div>
                  <div class="row">
                     <div class="col-xs-12">
                        <small class="stat-label">Joined in 2017</small>
                        <h4 id="myTargetElement2.1"></h4>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-4 col-sm-6 col-md-6 margin_10 animated fadeInDownBig">
         <!-- Trans label pie charts strats here-->
         <div class="goldbg no-radius">
            <div class="panel-body squarebox square_boxs">
               <div class="col-xs-12 pull-left nopadmar">
                  <div class="row">
                     <div class="square_box col-xs-7 pull-left">
                        <span><b>Employees Left</b></span>
                        <div class="number" id="myTargetElement3"></div>
                     </div>
                     <i class="livicon pull-right" data-name="users-remove" data-l="true" data-c="#fff"
                        data-hc="#fff" data-s="70"></i>
                  </div>
                  <div class="row">
                     <div class="col-xs-12">
                        <small class="stat-label">Employees left in 2017</small>
                        <h4 id="myTargetElement3.1"></h4>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6 margin_10 animated fadeInRightBig">
         <!-- Trans label pie charts strats here-->
         <div class="goldbg no-radius">
            <div class="panel-body squarebox square_boxs">
               <div class="col-xs-12 pull-left nopadmar">
                  <div class="row">
                     <div class="square_box col-xs-7 pull-left">
                        <span><b>Credits Available</b></span>
                        <div class="number" id="myTargetElement4"></div>
                     </div>
                     <i class="livicon pull-right" data-name="piggybank" data-l="true" data-c="#fff"
                        data-hc="#fff" data-s="70"></i>
                  </div>
                  <div class="row">
                     <div class="col-xs-12">
                        <small class="stat-label">Available credits for the month</small>
                        <h4 id="myTargetElement4.1"></h4>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-lg-6">
         <!-- Stack charts strats here-->
         <div class="panel panel-primary">
            <div class="panel-heading">
               <h3 class="panel-title">
                  <i class="livicon" data-name="barchart" data-size="16" data-loop="true" data-c="#fff" data-hc="#fff"></i> Number active employees for the past 12 months
               </h3>
               <span class="pull-right">
               </span>
            </div>
            <div class="panel-body">
               <div id="basicFlotLegend" class="flotLegend"></div>
               <div id="bar-chart-stacked" class="flotChart1"></div>
            </div>
         </div>
      </div>
      <div class="col-lg-6">
         <div class="panel panel-primary">
            <div class="panel-heading">
               <h3 class="panel-title">
                  <i class="livicon" data-name="piechart" data-size="16" data-loop="true" data-c="#fff" data-hc="#fff"></i> Candidates hired
               </h3>
            </div>
            <div class="panel-body text-center">
               <div class="demo-container">
                  <div id="chart"></div>
               </div>
            </div>
         </div>
      </div>
   </div>

</section>
<!-- content -->
@stop
{{-- page level scripts --}}
@section('footer_scripts')
<script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/flotchart/js/jquery.flot.js') }}" ></script>
<script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/flotchart/js/jquery.flot.stack.js') }}" ></script>
<script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/flotchart/js/jquery.flot.crosshair.js') }}" ></script>
<script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/flotchart/js/jquery.flot.time.js') }}" ></script>
<script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/flotchart/js/jquery.flot.selection.js') }}" ></script>
<script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/flotchart/js/jquery.flot.symbol.js') }}" ></script>
<script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/flotchart/js/jquery.flot.resize.js') }}" ></script>
<script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/flotchart/js/jquery.flot.categories.js') }}"  ></script>
<script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/splinecharts/jquery.flot.spline.js') }}"  ></script>
<script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/flot_tooltip/js/jquery.flot.tooltip.js') }}"  ></script>
<script language="javascript" type="text/javascript" src="{{ asset('assets/js/pages/customcharts.js') }}" ></script>
<script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/d3/d3.min.js') }}"></script>
<script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/d3pie/d3pie.min.js') }}"></script>
<script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/c3/c3.min.js') }}"></script>
<script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/morrisjs/morris.min.js') }}"></script>
<script language="javascript" type="text/javascript" src="{{ asset('assets/js/pages/custompiecharts1.js') }}" ></script>
<script>
   /*------c3 pie chart----*/
   var chart = c3.generate({
   bindto: '#chart',
   data: {
   // iris data from R
   columns: [
   ['Unsuccessful Applicants', <?php echo (isset($dashboard_data->employees_joined)) ? $dashboard_data->unsuccessful_applicants:"0"; ?>],
           ['Successful Applicants', <?php echo (isset($dashboard_data->employees_joined)) ? $dashboard_data->successful_applicants:"0"; ?>]
   ],
   type : 'pie'
   }
   });
</script>
<script>
   //start bar stack
   //var d11 = [["Jan", 130],["Feb",63],["Mar", 104],["Apr", 54],["May", 92],["Jun", 150],["Jul", 50],["Aug", 80],["Sep",120],["Oct", 91],["Nov", 79],["Dec", 112]];
   var d11 = <?php echo "[";
      $counter = 0;
      foreach($months as $dataunit){
          //if the day is there in the database, plot its score or else plot zero
          //check existance of score for the given date 
          //translate the date to Jan,Feb.Mar... 
         
          foreach($ratings2Plot as $ratingUnit){
              $explodedDate = explode("-", $ratingUnit->date);
              $explodeDataUnit = explode("-", $dataunit);
              //echo $explodedDate[1] ." + " .$explodeDataUnit[1];
              if($explodedDate[0] == str_replace('"',"",$explodeDataUnit[0]) && $explodedDate[1]==str_replace('"',"",$explodeDataUnit[1]) ){
               //this is exact date match 
               echo "['" .date("M , Y", strtotime($dataunit)) ."'," .$ratingUnit->employees_quantity ."],";
              }else{
               echo "['" .date("M , Y", strtotime($dataunit)) ."'," ."0" ."],";
              }
          }
     
          $counter++;
      }
      echo "]";
      ?>
   
   console.log(d11);
   
   $.plot("#bar-chart-stacked", [{
    data: d11,
    label: "Number of Employees",
    color: "#ee6f00"
   }], {
    series: {
        stack: !0,
        bars: {
            align: "center",
            lineWidth: 0,
            show: !0,
            barWidth: .30,
            fill: .9
        }
    },
    grid: {
        borderColor: "#ddd",
        borderWidth: 1,
        hoverable: !0
    },
    legend: {
        container: '#basicFlotLegend',
        show: true
    },
    tooltip: !0,
    tooltipOpts: {
        content: "%x : %y",
        defaultTheme: false
    },
    xaxis: {
        tickColor: "#ddd",
        mode: "categories",
    },
    yaxis: {
        tickColor: "#ddd"
    },
    shadowSize: 0
   });
   //end bar chart stack
</script>
<script src="{{ asset('assets/vendors/flotchart/js/jquery.flot.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/animatechart/jquery.flot.animator.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/animationcharts/jquery.circliful.min.js') }}"></script>
<script src="{{ asset('assets/vendors/flotchart/js/jquery.flot.resize.js') }}" language="javascript"
   type="text/javascript"></script>
<script src="{{ asset('assets/js/pages/animation-chart.js') }}"></script>
<script>
   var d8 = <?php echo json_encode($dataset1); ?>;
   var d9 = <?php echo json_encode($dataset2); ?>;
   var plot1 = $.plotAnimator($("#previousRatings"), [{
       data: d8,
       bars: {
           barWidth: 0.5,
           show: true,
           fill: true,
           fillColor: '#ee6f00'
       }
   }, {
       data: d9,
       lines: {
           lineWidth: 3,
           fill: true,
           fillColor: 'rgba(239,111,108,.2)'
       },
       animator: {
           start: $("#start").val(),
           steps: $("#steps").val(),
           duration: $("#duration").val(),
           direction: $("#dir").val()
       }
   }]);
   
   $("#overview").addClass("active");
   
   
</script>
<!--end animated charts-->
<script src="{{ asset('assets/vendors/moment/js/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/fullcalendar/js/fullcalendar.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/sparklinecharts/jquery.sparkline.js') }}"></script>
<!-- Back to Top-->
<script type="text/javascript" src="{{ asset('assets/vendors/countUp_js/js/countUp.js') }}"></script>
<!--   maps -->
<script src="{{ asset('assets/vendors/bower-jvectormap/js/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('assets/vendors/bower-jvectormap/js/jquery-jvectormap-world-mill-en.js') }}"></script>
<!--  todolist-->
<script src="{{ asset('assets/js/pages/todolist.js') }}"></script>
<script src="{{ asset('assets/js/pages/dashboard1.js') }}" type="text/javascript"></script>
<!--Dashboard small boxes-->
<script>
   var demo = new CountUp("myTargetElement2", 0, <?php echo (isset($dashboard_data->employees_joined)) ? $dashboard_data->employees_joined:"0"; ?>, 0, 0, options);
   demo.start();
   var demo = new CountUp("myTargetElement3", 0, <?php echo (isset($dashboard_data->employees_joined)) ? $dashboard_data->employees_left:"0"; ?>, 0, 0, options);
   demo.start();
   var demo = new CountUp("myTargetElement4", 0, <?php echo $subscriptionPackageDAta->employees_avail; ?>, 0, 0, options);
   demo.start();
</script>

    <!--<script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/flotchart/js/jquery.flot.categories.js') }}"  ></script>
    <script language="javascript" type="text/javascript" src="{{ asset('assets/js/pages/customcharts.js') }}" ></script>-->
@stop