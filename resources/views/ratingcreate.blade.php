@extends('admin/layouts/defaultx')

{{-- Page title --}}
@section('title')
    Add User
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <!--page level css -->
    <link href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/select2/css/select2.min.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('assets/vendors/select2/css/select2-bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/iCheck/css/all.css') }}"  rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/pages/wizard.css') }}" rel="stylesheet">
    <!--end of page level css-->

    <link href="{{ asset('assets/vendors/select2/css/select2.min.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('assets/vendors/select2/css/select2-bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/bootstrapvalidator/css/bootstrapValidator.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/iCheck/css/all.css') }}"  rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/pages/wizard.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/bootstrapStarRating/css/star-rating.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/pages/custom_rating.css') }}" rel="stylesheet" type="text/css"/>

     <!--styling the jquery autocomplete-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/jquery-ui.css') }}">
@stop


{{-- Page content --}}
@section('content')

<?php
      /*$allIdNumbers = array();
      foreach($allIds as $singleid){
          array_push($allIdNumbers,$singleid->idnumber);
          //echo $singleid->idnumber;
      }*/
      $allIdNumbersJson = json_encode($idsWatchedArray);
?>
    <section class="content-header">
        <h1>Create Rating</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                    Dashboard
                </a>
            </li>
            <li class="active">Create Rating</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    
                    <div class="panel-body">
                        <!--main content-->
                        <form id="commentForm" action="{{ route('create-rating') }}"
                              method="POST" enctype="multipart/form-data" class="form-horizontal">
                            <!-- CSRF Token -->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                            <div id="rootwizard">
                                <ul>
                                    <li><a href="#tab1" data-toggle="tab">1. Write your Rating</a></li>
                                    <li><a href="#tab2" data-toggle="tab">2. Tell us more</a></li>
                                    <li><a href="#tab3" data-toggle="tab">3. Publish your Rating</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane" id="tab1">
                                        <h2 class="hidden">&nbsp;</h2>
                                        <div class="form-group {{ $errors->first('employeeID', 'has-error') }}">
                                            <label for="employeeID" class="col-sm-2 control-label">Employee ID Number*</label>
                                            <div class="col-sm-10">
                                                <input id="employeeID" name="employeeID" type="text"
                                                       placeholder="Employee ID Number" class="form-control required"
                                                       value=""/>

                                                {!! $errors->first('employeeID', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->first('ratedCategory', 'has-error') }}">
                                            <input id="ratedCategory" name="ratedCategory" type="hidden" placeholder="Category" class="form-control required" value="Employee">
                                        </div>

                                        <div class="form-group {{ $errors->first('ratingTitle', 'has-error') }}">
                                            <label for="ratingTitle" class="col-sm-2 control-label">Task *</label>
                                            <div class="col-sm-10">
                                                <input id="ratingTitle" name="ratingTitle" placeholder="Task*" type="text"
                                                       class="form-control required" value="{!! old('ratingTitle') !!}"/>
                                                {!! $errors->first('ratingTitle', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->first('experienceDescribe', 'has-error') }}">
                                            <label for="experienceDescribe" class="col-sm-2 control-label">Describe your experience*</label>
                                            <div class="col-sm-10">
                                                 <textarea id="experienceDescribe" placeholder="Write Your Rating" name="experienceDescribe" rows="4" class="form-control required"></textarea>
                                                {!! $errors->first('experienceDescribe', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->first('starRating', 'has-error') }}">
                                            <label for="starRating" class="col-sm-2 control-label">Rate Employee*</label>
                                            <div class="col-sm-10">
                                                 <textarea id="starRating" placeholder="Rate Employee*" name="starRating" rows="4" class="form-control required"></textarea>
                                                {!! $errors->first('starRating', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>
                                        


                                    </div>
                                    <div class="tab-pane" id="tab2" disabled="disabled">
                                        
                                        <div class="form-group {{ $errors->first('incidentTime', 'has-error') }}">
                                            <label for="incidentTime" class="col-sm-2 control-label">Time of incident*</label>
                                            <div class="col-sm-10">
                                                <input placeholder="Time of incident" type="text" name="datetime3" class="form-control" id="datetime3"/>
                                                {!! $errors->first('incidentTime', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>
                                                                             
                                    </div>

                                    <div class="tab-pane" id="tab3" disabled="disabled">
                                        
                                       <div class="form-group">
                                          <label for="ratedTerms" class="control-label">Please tick if you agree to our <a href="#">Ts&Cs</a></label>
                                          <input id="ratedTerms" name="ratedTerms" type="checkbox" class="form-control required number">             
                                       </div>
                                                                             
                                    </div>
                                    <!--end of basic prices-->
                                  
                                    <ul class="pager wizard">
                                        <li class="previous"><a href="#">Previous</a></li>
                                        <li class="next"><a href="#">Next</a></li>
                                        <li class="next finish" style="display:none;"><a href="javascript:;">Finish</a></li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--row end-->
    </section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
     <script src="{{ asset('assets/vendors/iCheck/js/icheck.js') }}"></script>
    <script src="{{ asset('assets/vendors/moment/js/moment.min.js') }}" ></script>
    <script src="{{ asset('assets/vendors/select2/js/select2.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/bootstrapwizard/jquery.bootstrap.wizard.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/pages/form_wizard.js') }}"  type="text/javascript"></script>
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
    $("#create-rating").addClass("active");
   </script>

@stop
