@extends('layouts/defaultx')
{{-- Page title --}}
@section('title')
Single Product| Welcome to Josh Frontend
@parent
@stop
{{-- page level styles --}}
@section('header_styles')
<!--page level css starts-->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/cart.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/tabbular.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/bootstrap-rating/bootstrap-rating.css') }}">
<!--end of page level css-->
<!--ratings-->
<link href="{{ asset('assets/vendors/select2/css/select2.min.css') }}" type="text/css" rel="stylesheet">
<link href="{{ asset('assets/vendors/select2/css/select2-bootstrap.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendors/bootstrapvalidator/css/bootstrapValidator.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendors/iCheck/css/all.css') }}"  rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/pages/wizard.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendors/bootstrapStarRating/css/star-rating.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/css/pages/custom_rating.css') }}" rel="stylesheet" type="text/css"/>
<!--animated charts-->
<link href="{{ asset('assets/vendors/animationcharts/jquery.circliful.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/css/pages/charts.css') }}" rel="stylesheet" type="text/css"/>
<!--end animated charts-->
<!--PieCharts-->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/c3/c3.min.css') }}" rel="stylesheet" type="text/css" />
<link  rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/morrisjs/morris.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/pages/piecharts.css') }}" rel="stylesheet" type="text/css" />
<style>
   .rating-container .clear-rating{
   display: none !important;
   }
   .rating-container .caption{
   display:none !important;
   }
</style>
@stop
{{-- breadcrumb --}}
@section('top')
<div class="breadcum">
   <div class="container">
      <ol class="breadcrumb">
         <li>
            <a href="{{ route('home') }}"> <i class="livicon icon3 icon4" data-name="home" data-size="18" data-loop="true" data-c="#3d3d3d" data-hc="#3d3d3d"></i>Dashboard
            </a>
         </li>
         <li class="hidden-xs">
            <i class="livicon icon3" data-name="angle-double-right" data-size="18" data-loop="true" data-c="#4caf50" data-hc="#4caf50"></i>
            <a href="#">Single Rating</a>
         </li>
      </ol>
      <div class="pull-right">
         <i class="livicon icon3" data-name="edit" data-size="20" data-loop="true" data-c="#3d3d3d" data-hc="#3d3d3d"></i> Single Rating
      </div>
   </div>
</div>
@stop
{{-- Page content --}}
@section('content')
<!--Create data-points for recent ratings plot -->
<!-- Container Section Start -->
<?php
   //create array of pairs of x and y values
   $dataset1 = array();
   $dataset2 = array();
   $counter = 1;
   foreach($ratings2Plot as $dataunit){
       //echo $dataunit->rated_fullname;
         $dataset1[] = array($counter, $dataunit->stars);
         $dataset2[] = array($counter+0.25, $dataunit->stars);
         $counter++;
   }
   ?>
<div class="container">
<hr>
<!--item view start-->
<div class="row">
   <div class="mart10">
      <!--product view-->
      <div class="col-md-4">
        <div class="box">
         <!-- Stack charts strats here-->
         <div class="panel panel-primary">
            <h4 class="text-center">
               Recent Ratings
            </h4>
            <div class="panel-body">
               <div id="previousRatings" class="animation-chart"></div>
            </div>
         </div>
         </div>
      </div>
      <!--individual product description-->
      <div class="col-md-8">
         <h2 class="text-primary">{{ $employeeData->first_name }} {{ $employeeData->last_name }}</h2>
         <!--<div class="row">
            <div class="product_wrapper">
                <img id="zoom_09" src="{{ asset('assets/images/cart/small/1.jpg') }}" data-zoom-image="{{ asset('assets/images/cart/big/1.jpg') }}" class="img-responsive" />
            </div>
            </div>-->
         <strong>Average Star Rating(verified & unverified): </strong><input id="input-7" class="rating rating-loading" value="{{ $avgRating }}" data-min="0" data-max="5" data-step="1" data-disabled="true">
         <h5>Verified: {{ $employeeData->authoritiesverified }}</h5>
         <h5>Email: {{ $employeeData->email }}</h5>
         <h5>Country: {{ $employeeData->country }}</h5>
         <h5>State: {{ $employeeData->state }}</h5>
         <h5>City: {{ $employeeData->city }}</h5>
         <p></p>
         <!--<a href="#" class="btn btn-primary btn-lg text-white">View All Ratings</a>-->
      </div>
   </div>
</div>
<!--item view end-->
<!--item desciption start-->
<div class="row">
<div class="col-sm-12">
   <!-- Tabbable-Panel Start -->
   <div class="tabbable-panel">
      <!-- Tabbablw-line Start -->
      <div class="tabbable-line">
         <!-- Nav Nav-tabs Start -->
         <ul class="nav nav-tabs ">
            <?php if(isset($_GET['page'])){ ?>
            <li>
               <?php }else{ ?>
            <li class="active">
               <?php } ?>
               <a href="#tab_default_1" data-toggle="tab">
               Ratings Breakdown </a>
            </li>
            <?php if(isset($_GET['page'])){ ?>
            <li class="active">
               <?php }else{ ?>
            <li>
               <?php } ?>
               <a href="#tab_default_2" data-toggle="tab">
               All Ratings </a>
            </li>
         </ul>
         <!-- //Nav Nav-tabs End -->
         <!-- Tab-content Start -->
         <div class="tab-content">
            <?php if(isset($_GET['page'])){ ?>
            <div class="tab-pane" id="tab_default_1">
               <?php }else{ ?>
               <div class="tab-pane active" id="tab_default_1">
                  <?php } ?>
                  <div class="panel panel-primary">
                     
                     <div class="panel-body text-center">
                        <div id="pie3"></div>
                     </div>
                  </div>
               </div>
               <?php if(isset($_GET['page'])){ ?>
               <div class="tab-pane active" id="tab_default_2">
                  <?php }else{ ?>
                  <div class="tab-pane" id="tab_default_2">
                     <?php } ?>
                     <div class="row">
                        <div class="col-sm-8">
                           @foreach ($allRatingsData as $rating)
                           <input id="input-7" class="rating rating-loading" value="{{ $rating->stars }}" data-min="0" data-max="5" data-step="1" data-disabled="true">
                           <h6>Comapny: {{ $rating->company }}</h6>
                           <h6>{{ $rating->rated_fullname }}</h6>
                           <h6>{{ $rating->created_at }}</h6>
                           <strong>{{ $rating->rated_title }}</strong>
                           <p>{{ $rating->experience_description }} </p>
                           @endforeach
                           <ul class="pager">
                              {!! $allRatingsData->render() !!}
                           </ul>
                           <!-- <nav class="pull-right">
                              <ul class="pagination">
                                  <li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
                                  <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                                  <li><a href="#">2 <span class="sr-only">(current)</span></a></li>
                                  <li><a href="#">3 <span class="sr-only">(current)</span></a></li>
                                  <li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&raquo;</span></a></li>
                              </ul>
                              </nav>-->
                        </div>
                     </div>
                  </div>
                  <!-- Tab-content End -->
               </div>
               <!-- //Tabbable-line End -->
            </div>
            <!-- Tabbable_panel End -->
         </div>
      </div>
   </div>
   <!--item desciption end-->
   <!--recently view item-->
   <div class="row">
   </div>
   <hr>
   <!--recently view item end-->
</div>
<!-- //Container Section End -->
@stop
{{-- page level scripts --}}
@section('footer_scripts')
<!--page level js start-->
<script type="text/javascript" src="{{ asset('assets/js/frontend/elevatezoom.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendors/bootstrap-rating/bootstrap-rating.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/frontend/cart.js') }}"></script>
<!--page level js start-->
<script src="{{ asset('assets/vendors/bootstrapStarRating/js/star-rating.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/pages/custom_rating.js') }}" type="text/javascript"></script>
<!--animated charts-->
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
   
   
</script>
<!--end animated charts-->
<!--pie carts-->
<script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/flotchart/js/jquery.flot.pie.js') }}" ></script>
<script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/flotchart/js/jquery.flot.resize.js') }}" ></script>
<script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/d3/d3.min.js') }}"></script>
<script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/d3pie/d3pie.min.js') }}"></script>
<script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/c3/c3.min.js') }}"></script>
<script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/morrisjs/morris.min.js') }}"></script>
<script language="javascript" type="text/javascript" src="{{ asset('assets/js/pages/ratingspiechart.js') }}" ></script>
<script language="javascript" type="text/javascript">
  var pie = new d3pie("#pie3", {
	size: {
		pieOuterRadius: "100%",
		canvasHeight: 350
	},
    labels: {
        mainLabel: {
            font: "Lato"
        },
        percentage: {
            font: "Lato"
        }
    },
	data: {
		sortOrder: "value-asc",
		smallSegmentGrouping: {
			enabled: true,
			value: 2,
			valueType: "percentage",
			label: "Other birds"
		},
		content: [
			{ label: "Verified companies", value: 1, color:"#ee6f00"},
			{ label: "Unverified companies", value: 2,color:"#4caf50"}
		]
	},
	tooltips: {
		enabled: true,
		type: "placeholder",
		string: "{label}, {value}, {percentage}%"
	}
});
</script>
<!--end pie carts-->
@stop