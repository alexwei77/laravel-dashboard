@extends('admin/layouts/default')
{{-- Page title --}}
@section('title')
Edit User
@parent
@stop
{{-- page level styles --}}
@section('header_styles')
<!--page level css -->
<link href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendors/select2/css/select2.min.css') }}" type="text/css" rel="stylesheet">
<link href="{{ asset('assets/vendors/select2/css/select2-bootstrap.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendors/datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendors/iCheck/css/all.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/css/pages/wizard.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/dataTables.bootstrap.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/buttons.bootstrap.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/colReorder.bootstrap.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/dataTables.bootstrap.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/rowReorder.bootstrap.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/buttons.bootstrap.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/scroller.bootstrap.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/tables.css') }}" />
<!--end of page level css-->
<style>
   {{-- @todo oto css --}}
   .padding-20 {
   padding: 20px;
   }
   .padding-30 {
   padding: 30px;
   }
   .padding-40 {
   padding: 40px;
   }
   .padding-50 {
   padding: 50px;
   }
   .input_datetime {
   width: 140px;
   }
</style>
@stop
{{-- Page content --}}
@section('content')
<section class="content-header">
   <h1>Edit Billing</h1>
   <ol class="breadcrumb">
      <li>
         <a href="{{ route('admin.dashboard') }}">
         <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
         Dashboard
         </a>
      </li>
      <li>Members</li>
      <li>Edit</li>
      <li class="active">Billing</li>
   </ol>
</section>
<section class="content">
   <div class="row">
   <div class="col-md-12">
      <div class="col-md-12">
         <div class="panel panel-primary">
            <div class="panel-heading">
               <h3 class="panel-title">
                  <i class="livicon" data-name="users" data-size="16" data-c="#fff" data-hc="#fff"
                     data-loop="true"></i>
                  Editing billing :
                  <p class="user_name_max">{!! $user->first_name!!} {!! $user->last_name!!}</p>
               </h3>
               <span class="pull-right clickable">
               <i class="glyphicon glyphicon-chevron-up"></i>
               </span>
            </div>
            <div class="panel-body">
               <!--main content-->
               <div class="row">
                  <div class="tabbable">
                     <ul class="nav nav-tabs" id="">
                        <li><a href="{{ route('admin.members.edit.company', $user->id) }}">Company</a></li>
                        <li><a href="{{ route('admin.members.edit.admins', $user->id) }}">Admins</a></li>
                        <li class="active"><a href="{{ route('admin.members.edit.billing', $user->id) }}">Billing</a></li>
                        <li><a href="{{ route('admin.members.edit.users', $user->id) }}">Users</a></li>
                        <li><a href="{{ route('admin.members.view.stats', $user->id) }}">Stats</a></li>
                        <li><a href="{{ route('admin.members.view.settings', $user->id) }}">Settings</a></li>
                        <!--
                           <li><a href="#tab_user" data-toggle="tab">deprecated: User Profile</a></li>
                           <li><a href="#tab_bio" data-toggle="tab">deprecated: Bio</a></li>
                           <li><a href="#tab_address" data-toggle="tab">deprecated: Address</a></li>
                           <li><a href="#tab_user_group" data-toggle="tab">deprecated: User Group</a></li>
                           -->
                     </ul>
                     <div class="row padding-30">
                        <div class="tab-content">
                           <section class="content">
                              <form class="form-horizontal" role="form" method="post"
                                 action="{{ route('admin.members.edit.post_billing_note', $user->id) }}">
                                 <fieldset>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                    {{--
                                    <legend>Company</legend>
                                    --}}
                                    <div class="form-group">
                                       <label class="col-md-4 control-label" for="acc">Package
                                       </label>
                                       <div class="col-md-4">
                                          <input id="acc"
                                             name="package"
                                             type="text"
                                             placeholder="" class="form-control input-md"
                                             value="{{ $user->package }}"
                                             disabled
                                             />
                                       </div>
                                    </div>
                                  
                                      
                                       <div class="form-group">
                                          <label class="col-md-4 control-label" for="contact_number">Period</label>
                                          <div class="col-md-4">
                                             <input class="form-control input-md"
                                                id="contact_number"
                                                name="period"
                                                type="text"
                                                placeholder="{{ $user->period }}"
                                                value=""
                                                disabled
                                                />
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label class="col-md-4 control-label" for="registration">Total paid
                                          </label>
                                          <div class="col-md-4">
                                          <div class="input-group">
                                          <span class="input-group-addon">$</span>
                                             <input id="registration"
                                                name="total_paid"
                                                type="text"
                                                placeholder=""
                                                class="form-control input-md"
                                                value="{{ $user->total_paid }}"
                                                disabled
                                                />
                                          </div>
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label class="col-md-4 control-label" for="pay_status">Overdue</label>
                                          <div class="col-md-4">
                                             <div class="input-group">
                                                <span class="input-group-addon">$</span>
                                                <input id="pay_status"
                                                   name="overdue"
                                                   class="form-control"
                                                   placeholder=""
                                                   value="{{ $user->overdue }}"
                                                   disabled
                                                   />
                                             </div>
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label class="col-md-4 control-label"
                                             for="bio">Notes</label>
                                          <div class="col-md-4">
                                             <textarea class="form-control"
                                                id="notes"
                                                name="notes"></textarea>
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label class="col-md-4 control-label" for="button1id">
                                          {{--Action--}}
                                          </label>
                                          <div class="col-md-8 btn-group">
                                             <button id="company_save" name="save"
                                                class="btn btn-success">Send
                                             </button>
                                          </div>
                                       </div>
                                 </fieldset>
                              </form>
                           </section>
                           </div>
                        </div>
                     </div>
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
<!--page level js start-->
<script type="text/javascript" src="{{ asset('assets/js/frontend/elevatezoom.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendors/bootstrap-rating/bootstrap-rating.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/frontend/cart.js') }}"></script>
<!--page level js start-->
<!--custom datatables-->
<script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/jquery.dataTables.js') }}" ></script>
<script type="text/javascript" src="{{ asset('assets/vendors/jeditable/js/jquery.jeditable.js') }}" ></script>
<script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.bootstrap.js') }}" ></script>
<script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.buttons.js') }}" ></script>
<script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.colReorder.js') }}" ></script>
<script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.responsive.js') }}" ></script>
<script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.rowReorder.js') }}" ></script>
<script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/buttons.colVis.js') }}" ></script>
<script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/buttons.html5.js') }}" ></script>
<script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/buttons.print.js') }}" ></script>
<script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/buttons.bootstrap.js') }}" ></script>
<script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/buttons.print.js') }}" ></script>
<script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/pdfmake.js') }}" ></script>
<script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/vfs_fonts.js') }}" ></script>
<script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.scroller.js') }}" ></script>
<script src="{{ asset('assets/vendors/bootstrap-slider/js/bootstrap-slider.js') }}" ></script>
<script src="{{ asset('assets/vendors/iCheck/js/icheck.js') }}"></script>
@stop