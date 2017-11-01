@extends('admin/layouts/defaultx')

{{-- Page title --}}
@section('title')
    View User Details
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/vendors/x-editable/css/bootstrap-editable.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/pages/user_profile.css') }}" rel="stylesheet"/>

    <!--styling the jquery autocomplete-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/jquery-ui.css') }}">
@stop


{{-- Page content --}}
@section('content')
    <!--retrieve all the ids for the user to perform checks against-->
    <?php
      $allIdNumbers = array();
      foreach($allIds as $singleid){
          array_push($allIdNumbers,$singleid->idnumber);
          //echo $singleid->idnumber;
      }
      $allIdNumbersJson = json_encode($allIdNumbers);
    ?>

    <section class="content-header">
        <!--section starts-->
        <h1>Generate Contract</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                    Dashboard
                </a>
            </li>
            <li class="active">Generate Contract</li>
        </ol>
    </section>
    <!--section ends-->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <ul class="nav  nav-tabs ">
                    <li class="active">
                        <a href="#tab1" data-toggle="tab">
                            Generate Contract</a>
                    </li>
                    <!--<li>
                        <a href="#tab2" data-toggle="tab">
                            <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
                            Change Password</a>
                    </li>-->
                    <!--<li>
                        <a href="{{ URL::to('admin/user_profile') }}" >
                            <i class="livicon" data-name="gift" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
                            Advanced User Profile</a>
                    </li>-->

                </ul>
                <div  class="tab-content mar-top">
                    <div id="tab1" class="tab-pane fade active in">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel">
                                    <div class="panel-heading">
                                        
                                    </div>
                                    <div class="panel-body">
                                        <div class="col-md-8">
                                            <div class="panel-body">
                                                 <form role="form" id="contractForm" class="form-horizontal" action="{{ route('contractgenerate') }}" method="POST">
                               <input type="hidden" name="_token" value="{{ csrf_token() }}">
                               <div class="ui-widget">
                                   <label for="employeeID">Employee ID Number: </label>
                                   <input type="text" placeholder="Employee ID" name="employeeID" id="employeeID" class="form-control" value="">
                               </div> 
                               <div class="ui-widget">
                                   <label for="employeeEmail">Employee Email: </label>
                                   <input type="text" placeholder="Employee Email" name="employeeEmail" id="employeeEmail" class="form-control" value="">
                               </div> 
                               <div class="ui-widget">
                                   <label for="firstname">First Name: </label>
                                   <input type="text" placeholder="First Name" name="firstname" id="firstname" class="form-control" value="">
                               </div> 
                               <div class="ui-widget">
                                   <label for="lastname">Last Name: </label>
                                   <input type="text" placeholder="Last Name" name="lastname" id="lastname" class="form-control" value="">
                               </div>
                               <br>
                               <div class="ui-widget text-center">
                                   <button class="btn btn-primary" type="submit">submit</button>
                               </div>
                               <br>
                              </form>{{--{!!  Form::close()  !!}--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab2" class="tab-pane fade">
                        <div class="row">
                            <div class="col-md-12 pd-top">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <!-- Bootstrap WYSIHTML5 -->
    <script  src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" type="text/javascript"></script>

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
      var empployeeid = $("#employeeID").val();
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
    $("#generate-contract").addClass("active");
   </script>

   
@stop
