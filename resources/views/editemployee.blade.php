@extends('admin/layouts/defaultx')
{{-- Page title --}}
@section('title')
Verify Company
@parent
@stop
{{-- page level styles --}}
@section('header_styles')
<link href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}"  rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/vendors/iCheck/css/all.css') }}"  rel="stylesheet" type="text/css" />
@stop
{{-- Page content --}}
@section('content')
<section class="content-header">
   <!--section starts-->
   <h1>Edit User</h1>
   <ol class="breadcrumb">
      <li>
         <a href="{{ route('dashboard') }}">
         <i class="livicon" data-name="barchart" data-size="14" data-loop="true"></i>
         Dashboard
         </a>
      </li>
      <li class="active">Edit User</li>
   </ol>
</section>
<!--section ends-->
<section class="content">
   <!--main content-->
   <div class="row">
      <div class="col-lg-12 col-xs-12 col-md-12 col-sm-12">
         <div> </div>
      </div>
   </div>
   <hr>
   <div class="row">
      <!--<div class="col-lg-12 col-xs-12 col-md-12 col-sm-12">
         <a href="{{ URL::to('view-registration') }}" class="btn btn-primary btn-sm text-white">Download registration</a>
         <a href="{{ URL::to('view-directorid') }}" target="_blank" class="btn btn-primary btn-sm text-white">Download director's ID</a>
         <a href="{{ URL::to('view-utilitybill') }}" target="_blank" class="btn btn-primary btn-sm text-white">Download utility bill</a>
         </div>-->
   </div>
   <div class="row">
      <!--row starts-->
      <div class="col-md-6">
         <!--lg-6 starts-->
         <!--basic form starts-->
         <div class="panel panel-primary" id="hidepanel1">
            <div class="panel-heading">
               <h3 class="panel-title">
                  <i class="livicon" data-name="clock" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                  Leave blank the fields that you do not want to change
               </h3>
               <span class="pull-right">
                  <!--<i class="glyphicon glyphicon-chevron-up clickable"></i>
                     <i class="glyphicon glyphicon-remove removepanel clickable"></i>-->
               </span>
            </div>
            <div class="panel-body">
               <form class="form-horizontal" enctype="multipart/form-data" action="{{ route('edit-employee-submit') }}" method="POST">
                  <!-- CSRF Token -->
                  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                  <input type="hidden" name="employeeid" value="{{ $employeeData->idnumber }}" />
                  <input type="hidden" name="employeeemail" value="{{ $employeeData->email }}" />
                  <div class="form-group">
                     <label class="col-md-3 control-label" for="first_name">First Name</label>
                     <div class="col-md-9">
                           <input type="text" name="first_name" class="form-control" value="{{ $employeeData->first_name }}">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-md-3 control-label" for="last_name">Last Name</label>
                     <div class="col-md-9">
                           <input type="text" name="last_name" class="form-control" value="{{ $employeeData->last_name }}">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-md-3 control-label" for="idnumber">ID Number</label>
                     <div class="col-md-9">
                           <input type="text" name="idnumber" class="form-control" value="{{ $employeeData->idnumber }}">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-md-3 control-label" for="email">Email</label>
                     <div class="col-md-9">
                           <input type="text" name="email" class="form-control" value="{{ $employeeData->email }}">
                     </div>
                  </div>
            
                  <!-- Form actions -->
                  <div class="form-position">
                     <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-responsive btn-primary btn-sm">Submit</button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <!--md-6 ends-->
   </div>
   <!--main content ends--> 
</section>
<!-- content -->
@stop
{{-- page level scripts --}}
@section('footer_scripts')
<script src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" ></script>
<script src="{{ asset('assets/vendors/iCheck/js/icheck.js') }}"></script>
<script src="{{ asset('assets/js/pages/form_examples.js') }}"></script>
@stop