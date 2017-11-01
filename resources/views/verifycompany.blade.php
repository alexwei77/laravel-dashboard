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
   <h1>Verify Company</h1>
   <ol class="breadcrumb">
      <li>
         <a href="{{ route('dashboard') }}">
         <i class="livicon" data-name="barchart" data-size="14" data-loop="true"></i>
         Dashboard
         </a>
      </li>
      <li class="active">Verify Company</li>
   </ol>
</section>
<!--section ends-->
<section class="content">
   <!--main content-->
   @if($verificationRow)
   <!--<div class="row">
      <div class="col-lg-12 col-xs-12 col-md-12 col-sm-12">
         <div> Verification status: {{ $verificationRow->verification_status }}</div>
      </div>
   </div>-->
   <hr>
   <div class="row">
      <!--<div class="col-lg-12 col-xs-12 col-md-12 col-sm-12">
         <a href="{{ URL::to('view-registration') }}" class="btn btn-primary btn-sm text-white">Download registration</a>
         <a href="{{ URL::to('view-directorid') }}" target="_blank" class="btn btn-primary btn-sm text-white">Download director's ID</a>
         <a href="{{ URL::to('view-utilitybill') }}" target="_blank" class="btn btn-primary btn-sm text-white">Download utility bill</a>
         </div>-->
   </div>
   @endif
   <div class="row">
      <!--row starts-->
      <div class="col-md-6">
         <!--lg-6 starts-->
         <!--basic form starts-->
         <div class="panel panel-primary" id="hidepanel1">
            <div class="panel-heading">
               <h3 class="panel-title">
                  <i class="livicon" data-name="clock" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                  Upload at least one of the following documents in PDF format
               </h3>
               <span class="pull-right">
                  <!--<i class="glyphicon glyphicon-chevron-up clickable"></i>
                     <i class="glyphicon glyphicon-remove removepanel clickable"></i>-->
               </span>
            </div>
            <div class="panel-body">
               <form class="form-horizontal" enctype="multipart/form-data" action="{{ route('verify-company') }}" method="POST">
                  <!-- CSRF Token -->
                  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                  <div class="form-group">
                     <label class="col-md-3 control-label" for="companyname">Company Name</label>
                     <div class="col-md-9">
                           <input type="text" name="companyname" class="form-control" value="{{ $user->companyname }}" required>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-md-3 control-label" for="name">Company Registration</label>
                     <div class="col-md-9">
                        <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                           <div class="form-control" data-trigger="fileinput">
                              <i class="glyphicon glyphicon-file fileinput-exists"></i>
                              <span class="fileinput-filename"></span>
                           </div>
                           <span class="input-group-addon btn btn-default btn-file">
                           <span class="fileinput-new">Select file</span>
                           <span class="fileinput-exists">Change</span>
                           <input type="file" name="companyregistration"></span>
                           <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-md-3 control-label" for="name">Company Director ID</label>
                     <div class="col-md-9">
                        <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                           <div class="form-control" data-trigger="fileinput">
                              <i class="glyphicon glyphicon-file fileinput-exists"></i>
                              <span class="fileinput-filename"></span>
                           </div>
                           <span class="input-group-addon btn btn-default btn-file">
                           <span class="fileinput-new">Select file</span>
                           <span class="fileinput-exists">Change</span>
                           <input type="file" name="companydirector"></span>
                           <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-md-3 control-label" for="name">Utility Bill</label>
                     <div class="col-md-9">
                        <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                           <div class="form-control" data-trigger="fileinput">
                              <i class="glyphicon glyphicon-file fileinput-exists"></i>
                              <span class="fileinput-filename"></span>
                           </div>
                           <span class="input-group-addon btn btn-default btn-file">
                           <span class="fileinput-new">Select file</span>
                           <span class="fileinput-exists">Change</span>
                           <input type="file" name="companybill"></span>
                           <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                        </div>
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