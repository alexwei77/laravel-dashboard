@extends('layouts/defaultx')

{{-- Page title --}}
@section('title')
Form Wizard
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link href="{{ asset('assets/vendors/select2/css/select2.min.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('assets/vendors/select2/css/select2-bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/bootstrapvalidator/css/bootstrapValidator.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/iCheck/css/all.css') }}"  rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/pages/wizard.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/bootstrapStarRating/css/star-rating.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/pages/custom_rating.css') }}" rel="stylesheet" type="text/css"/>
    <!--For date picker -->
    <link href="{{ asset('assets/vendors/pickadate/css/default.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/vendors/pickadate/css/default.date.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/vendors/pickadate/css/default.time.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/vendors/airDatepicker/css/datepicker.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/vendors/flatpickrCalendar/css/flatpickr.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/css/pages/adv_date_pickers.css') }}" rel="stylesheet" type="text/css"/>
    <!--end of datepicker css-->

    <link href="{{ asset('assets/vendors/daterangepicker/css/daterangepicker.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/clockface/css/clockface.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet" type="text/css" />

     <!--styling the jquery autocomplete-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/jquery-ui.css') }}">

@stop

{{-- breadcrumb --}}
@section('top')
    <div class="breadcum">
        <div class="container">
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}"> <i class="livicon icon3 icon4" data-name="home" data-size="18" data-loop="true" data-c="#3d3d3d" data-hc="#3d3d3d"></i>Home
                    </a>
                </li>
                <li class="hidden-xs">
                    <i class="livicon icon3" data-name="angle-double-right" data-size="18" data-loop="true" data-c="#4caf50" data-hc="#4caf50"></i>
                    <a href="#">Create Self Rating</a>
                </li>
            </ol>
            <div class="pull-right">
                <i class="livicon icon3" data-name="edit" data-size="20" data-loop="true" data-c="#3d3d3d" data-hc="#3d3d3d"></i> Self Rating
            </div>
        </div>
    </div>
@stop

<?php
      /*$allIdNumbers = array();
      foreach($allIds as $singleid){
          array_push($allIdNumbers,$singleid->idnumber);
          //echo $singleid->idnumber;
      }*/
      $allIdNumbersJson = json_encode($idsWatchedArray);
    ?>

{{-- Page content --}}
@section('content')


<!-- content Section Start -->
<div class="container">
    <div class="row">
     <hr>
    <!--<div class="col-sm-6">
        <div id="table_filter" class="dataTables_filter">
          <label>Search Employee:<input type="search" class="form-control input-sm" placeholder="" aria-controls="table"></label>
        </div>
    </div>-->
    
     <div id="notific">
               @include('notifications')
           </div>
     <h3 id="title">Create Self Rating</h3>
        <div class="col-md-12">
            <div class="panel panel-success">
               
                <div class="panel-body">
                    <form id="selfRatingForm" method="post" action="{{ route('private-ratingscreate') }}">
                        <div id="rootwizard">
                            <ul>
                                <li>
                                    <a href="#tab1" data-toggle="tab">1. Write your Rating</a>
                                </li>
                                <li>
                                    <a href="#tab2" data-toggle="tab">2. Tell us more</a>
                                </li>
                                <li>
                                    <a href="#tab3" data-toggle="tab">3. Publish your Rating</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane" id="tab1">
                                    <h2 class="hidden">&nbsp;</h2>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <!--<div class="form-group">
                                        <label for="ratedName" class="control-label">Name (Person being rated) *</label>
                                        <input id="ratedName" name="ratedName" type="text" placeholder="Employee/Employer Name" class="form-control required">
                                    </div>-->
                                    <div class="form-group">
                                        <label for="yourID" class="control-label">Your ID*(not necessary, can be obtained from database)</label>
                                        <input id="yourID" name="yourID" type="text" placeholder="Your ID Number*" class="form-control required">
                                    </div>
                                    <div class="form-group">
                                        <!--<label for="ratedCategory" class="control-label">Person Category*</label>-->
                                        <!--<select class="form-control" name="ratedCategory" id="ratedCategory"
                                                title="Select an account type...">
                                            <option disabled="" selected="">Select</option>
                                            <option value="employee">Employee</option>
                                            <option value="employer">Employer</option>
                                        </select>-->
                                        <input id="ratedName" name="ratedCategory" type="hidden" placeholder="Category" class="form-control required" value="SelfRating">
                                    </div>
                                    <div class="form-group">
                                        <label for="taskTitle" class="control-label">Task *</label>
                                        <input id="taskTitle" name="taskTitle" type="text" placeholder="Task*" class="form-control required">
                                    </div>
                                    <div class="form-group">
                                      <label for="taskDescribe" class="control-label">Task Description*</label>
                                       <textarea id="taskDescribe" placeholder="Task Description*" name="taskDescribe" rows="4" class="form-control required"></textarea>
                                    </div>
                                    <div class="form-group">
                                      <label for="starRating" class="control-label">Rate Yourself*</label>
                                      <!--<input id="starRating" name="starRating" type="text" class="form-control required">-->
                                       <input data-min="" id="starRating" name="starRating" type="text" placeholder="Rating Title" class="form-control required">
                                       <!--<input id="starRating2" name="starRating2" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1">-->
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab2">
                                    <h2 class="hidden">&nbsp;</h2>
                                    <!--<div class="form-group">
                                        <label for="companyName" class="control-label">At What company did it take place? *</label>
                                        <input id="companyName" name="companyName" placeholder="Company Name" type="text" class="form-control required">
                                    </div>-->
                                    <!--<div class="form-group">
                                        <label for="raterID" class="control-label">Tell us your ID number (if required) *</label>
                                        <input id="raterID" name="raterID" type="text" placeholder=" Enter your Last name" class="form-control required">
                                    </div>-->
                                     <!--<div class="form-group">
                                        <label for="contactConfirm" class="control-label">Please confirm your contact number</label>
                                        <input id="contactConfirm" name="contactConfirm" type="text" placeholder=" Enter your Last name" class="form-control required">
                                    </div>
                                    <div class="form-group">
                                        <label for="experienceNature" class="control-label">What was the nature of your experience?*</label>
                                        <select class="form-control" name="experienceNature" id="experienceNature"
                                                title="Select an account type...">
                                            <option disabled="" selected="">Select</option>
                                            <option value="Bad Attitude">Bad Attitude</option>
                                            <option value="Late">Late</option>
                                            <option value="Salary">Salary</option>
                                            <option value="Work Performance">Work Performance</option>
                                        </select>
                                    </div>-->
                                    <!--<div class="form-group">
                                        <label for="incidentTime" class="control-label">Time of incident*</label>
                                         <input name="incidentTime" class="form-control datepicker1" type="text" placeholder="YYYY/MM/DD HH/MM">
                                      </div> -->
                                      <div class="form-group">
                                         <label for="incidentTime" class="control-label">Time of incident*</label>
                                          <div class="input-group">
                                          <div class="input-group-addon">
                                          
                                        </div>
                                        <input placeholder="Time of incident" type="text" name="datetime3" class="form-control" id="datetime3"/>
                                      </div>
                                      <!-- /.input group -->
                                     </div>
                                    <!--<div class="form-group">
                                        <label for="ratedEmail" class="control-label">The employee's email address</label>
                                        <input id="ratedEmail" name="ratedEmail" type="email" placeholder="Employee Email" class="form-control required number">             
                                    </div>-->
                                </div>
                                <div class="tab-pane" id="tab3">
                                    <div class="form-group">
                                        <label for="acceptTerms" class="control-label">Please tick if you agree to our <a href="#">Ts&Cs</a></label>
                                        <input id="acceptTerms" name="acceptTerms" type="checkbox" class="form-control required number">             
                                    </div>
                                </div>
                                <ul class="pager wizard">
                                    <li class="previous">
                                        <a href="#">Previous</a>
                                    </li>
                                    <li class="next">
                                        <a href="#">Next</a>
                                    </li>
                                    <li class="next finish" style="display:none;">
                                        <div style="float:right;"><button class="btn btn-default" style="color: #757B8D" type="submit">Publish</button></div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div id="myModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">User Register</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>You Submitted Successfully.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
 <!-- //Content Section End -->
</div>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script src="{{ asset('assets/vendors/iCheck/js/icheck.js') }}"></script>
    <script src="{{ asset('assets/vendors/moment/js/moment.min.js') }}" ></script>
    <script src="{{ asset('assets/vendors/select2/js/select2.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/bootstrapwizard/jquery.bootstrap.wizard.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/pages/selfrating_wizard.js') }}"  type="text/javascript"></script>
    <!-- begining of page level js -->
    <script src="{{ asset('assets/vendors/bootstrapStarRating/js/star-rating.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/pages/custom_rating.js') }}" type="text/javascript"></script>
    <!-- end of page level js -->

    <!-- date picker-->
   <script src="{{ asset('assets/vendors/moment/js/moment.min.js') }}" type="text/javascript"></script>
   <script src="{{ asset('assets/vendors/daterangepicker/js/daterangepicker.js') }}" type="text/javascript"></script>
   <script src="{{ asset('assets/vendors/datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
   <script src="{{ asset('assets/vendors/clockface/js/clockface.js') }}" type="text/javascript"></script>
   <script src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" type="text/javascript"></script>
   <script src="{{ asset('assets/js/pages/datepicker.js') }}" type="text/javascript"></script>
   <script src="{{ asset('assets/js/pages/custom_datepicker.js') }}" type="text/javascript"></script>
   <!-- end of date picker-->
   <!--<script>
      $( document ).ready(function() {
          var starRating = document.getElementById('starRating');
          $("#starRating").val(2);
    });
   </script>-->

      <!--auto suggest-->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
     <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  var $j = jQuery.noConflict();
  $j( function() {
    var availableTags = <?php echo $allIdNumbersJson; ?>;
    $j( "#employeeID" ).autocomplete({
      source: availableTags
    });
  } );
  </script>

  <!--populate the fields based on ID selected-->
  <script>
  var $j = jQuery.noConflict();
    $j("#employeeID").on("change", function() {
      var empployeeid = $j("#employeeID").val();
      //alert(empployeeid);
      $j.ajax({
               type:'POST',
               url:'ajaxemployee',
               data:{'_token' : '<?php echo csrf_token() ?>', 'employeeID': empployeeid },
               success:function(data){
                   if(data.length !== 0){
                   $j.each(data, function(index, val) {
                          //alert(val.first_name);
                         //Populate the input fields
                         $j('#employeeEmail').val(val.email);
                         $j('#firstname').val(val.first_name);
                         $j('#lastname').val(val.last_name);

                     });
                   }
               }
            });
    });
   </script>

 

@stop
