@extends('admin/layouts/defaultx')
{{-- Page title --}}
@section('title')
My Account
@parent
@stop
{{-- page level styles --}}
@section('header_styles')
<link href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet"/>
<link href="{{ asset('assets/vendors/x-editable/css/bootstrap-editable.css') }}" rel="stylesheet"/>
<link href="{{ asset('assets/css/pages/user_profile.css') }}" rel="stylesheet"/>
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/iCheck/css/minimal/blue.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/select2/css/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/select2/css/select2-bootstrap.css') }}">
<link rel="stylesheet" type="text/css"
   href="{{ asset('assets/vendors/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/user_account.css') }}">
@stop
{{-- Page content --}}
@section('content')
<?php
   //Setting::set('locale', 'za');
   //set default locale
   ?>
<style>
   h3.text-primary {
   color: #4caf50;
   }
   h5, h3 {
   font-weight: bold;
   }

</style>
<section class="content-header">
   <!--section starts-->
   <h1>Settings</h1>
   <ol class="breadcrumb">
      <li>
         <a href="{{ route('dashboard') }}">
         <i class="livicon" data-name="barchart" data-size="14" data-loop="true"></i>
         Dashboard
         </a>
      </li>
      <li class="active">Settings</li>
   </ol>
</section>
<!--section ends-->
<section class="content">
   <div class="row">
      <div class="col-lg-12">
         <ul class="nav  nav-tabs ">
            <li class="active">
               <a href="#tab1" data-toggle="tab">
               <i class="livicon"
                  data-name="gear"
                  data-size="16"
                  data-c="#000"
                  data-hc="#000"
                  data-loop="true"></i>
               Settings
               </a>
            </li>
            <!--<li>
               <a href="{{ URL::to('admin/user_profile') }}" >
                   <i class="livicon"
                        data-name="gift"
                        data-size="16"
                        data-loop="true"
                        data-c="#000" data-hc="#000"
                        ></i>
                   Advanced User Profile</a>
               </li>-->
         </ul>
         <div class="tab-content mar-top">
            <div id="tab1" class="tab-pane fade active in">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="">
                        <div class="panel-heading">
                           <h3 class="text-primary" id="title">Select Locale</h3>
                        </div>
                     </div>
                     <div class="panel-body">
                        <div class="col-md-12 text-warning">
                           <li>
                              <a data-toggle="modal" id="choose-country" href="#" data-target="#select_country" class="btn1 btn-primary btn-sm text-white">@if(__('general.flag')!== "")<img class="flag" height="10px" width="20px" src="https://lipis.github.io/flag-icon-css/flags/4x3/{{ __('general.flag') }}.svg" alt="French Southern Territories Flag"> {{ __('general.region') }} @else
                              <i class="fa fa-fw fa-globe"></i>{{ __('general.region') }} @endif
                              </a>
                           </li>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-lg-12">
                     <div class="">
                        <div class="panel-heading">
                           <h3 class="text-primary">Select Currency</h3>
                        </div>
                     </div>
                     <div class="panel-body">
                        <div class="col-md-12 text-warning">
                           <li>
                              <a data-toggle="modal" id="choose-currency" href="#" data-target="#select_currency" class="btn1 btn-primary btn-sm text-white">{{ $currencyInformation->currency }} ({{ $currencyInformation->symbol }})
                              </a>
                           </li>
                        </div>
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


 <!--start date modal starts here-->
      <div class="modal fade" id="select_currency" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden=true>×</button>
                <h4 class="modal-title custom_align" id="Heading">
                    Current Currency: {{ __('general.region') }} @if(__('general.flag')!== "")<img class=flag height=20px width=30px src="https://lipis.github.io/flag-icon-css/flags/4x3/{{ __('general.flag') }}.svg" alt="French Southern Territories Flag">
                    @else
                        <i class="fa fa-fw fa-globe"></i>
                    @endif
                </h4>
            </div>
        
            <div class="modal-body">
                @foreach( $currencies as $currency )
                        <a href="{{ route('currency-set', $currency->code) }}">
                            <button type="submit" class="btn btn-link">{{ $currency->country }}: {{ $currency->currency }}, {{ $currency->symbol }}</button>
                        </a><br>
                @endforeach
                <button type="button" class="btn btn-warning" data-dismiss="modal">
                    <span class="glyphicon glyphicon-remove"></span>
                    Back
                </button>
            </div>
        </div>
    </div>
</div>
 <!-- /.modal ends here -->
@stop
{{-- page level scripts --}}
@section('footer_scripts')
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" type="text/javascript"></script>
<script type="text/javascript">
   $(document).ready(function () {
       $('#change-password').click(function (e) {
           e.preventDefault();
           var check = false;
           var sendData = '_token=' + $("input[name='_token']").val() + '&password=' + $('#password').val() + '&password-confirm=' + $('#password-confirm').val();
           if ($('#password').val() === $('#password-confirm').val()) {
               check = true;
           }
           if (check) {
               $.ajax({
                   url: '{{ route('admin.passwordreset', $user->id) }}',
                   type: "post",
                   data: sendData,
                   success: function (data) {
                       alert('password reset successful');
                   },
                   error: function (xhr, ajaxOptions, thrownError) {
                       alert('error in password reset');
                   }
               });
           } else {
               alert('password and password confirm does not match');
           }
       });
   });
   
   $("#my-account").addClass("active");
</script>
<script type="text/javascript" src="{{ asset('assets/vendors/moment/js/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendors/iCheck/js/icheck.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendors/select2/js/select2.js') }}"></script>
<script type="text/javascript"
   src="{{ asset('assets/vendors/datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/frontend/user_account.js') }}"></script>
@stop