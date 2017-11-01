@extends('admin/layouts/defaultx')

{{-- Page title --}}
@section('title')
Load Staff/Prospects
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')

    <link rel="stylesheet" href="{{ asset('assets/css/pages/todolist.css') }}"/>
    <meta name="_token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">
    <!-- end of page level css -->
@stop

{{-- Page content --}}
@section('content')

    <section class="content-header">
        <!--section starts-->
   <h1>Load Users</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">
                    <i class="livicon" data-name="barchart" data-size="14" data-color="#000"></i>
                    Dashboard
                </a>
            </li>
      <li>Users</li>
      <li>Load Users</li>
        </ol>
    </section>
    <!--section ends-->
    <section class="content">
        <div class="row">
            <!-- To do list -->
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-1
            2">
                <div class="panel panel-primary todolist">
                    <div class="panel-heading border-light">
                        <h4 class="panel-title">
                            <i class="livicon" data-name="medal" data-size="18" data-color="white" data-hc="white"
                               data-l="true"></i>
                  Available Units: @if($subscriptionPackage->employees_avail < 0) Unlimited @else {{ $subscriptionPackage->employees_avail }} @endif | Available admins: @if($subscriptionPackage->admins_avail < 0) Unlimited @else {{ $subscriptionPackage->admins_avail }} @endif
                  @if(!$verification_docs_status && $user->companyname == null){{ " | Please verify your company before loading any staff/prospect." }} @endif
                        </h4>
                    </div>
                    <div class="panel-body nopadmar">
                        <div class="panel-body">
                  <div class="col-md-3 col-lg-3 col-sm-3 col-xs-3">
                        <div class="add_list adds">
                            {!! Form::open(['class'=>'form', 'id'=>'main_input_box']) !!}
                            <div class="form-group">
                                {!! Form::label('first_name', 'First Name: ') !!}
                                {!! Form::text('first_name', null, ['class' => 'form-control','id'=>'first_name', 'required' => 'required']) !!}
                            </div>
                    </div>
                  </div>
                  <div class="col-md-3 col-lg-3 col-sm-3 col-xs-3">
                     <div class="add_list adds">
                            <div class="form-group">
                                {!! Form::label('last_name', 'Last Name: ') !!}
                                {!! Form::text('last_name', null, ['class' => 'form-control','id'=>'last_name', 'required' => 'required']) !!}
                            </div>
                   </div>
                  </div>
                  <div class="col-md-3 col-lg-3 col-sm-3 col-xs-3">
                     <div class="add_list adds">
                            <div class="form-group">
                                {!! Form::label('idnumber', 'ID Number: ') !!}
                                {!! Form::text('idnumber', null, ['class' => 'form-control','id'=>'idnumber', 'required' => 'required']) !!}
                            </div>
                   </div>
                 </div>
                 <div class="col-md-3 col-lg-3 col-sm-3 col-xs-3">
                     <div class="add_list adds">
                            <div class="form-group">
                                {!! Form::label('email', 'Email: ') !!}
                                {!! Form::email('email', null, ['class' => 'form-control','id'=>'email', 'required' => 'required']) !!}
                            </div>
                    </div>
                 </div>
                <div class="text-center">
                            <button type="submit" value="0" id="add_button" class="btn btn-primary add_button">
                        Add More Users
                            </button>
                            <button type="submit" value="1" id="contract_button" class="btn btn-primary contract_button">
                        Add and Proceed to Slip
                            </button>
                </div>
                            {!! Form::close() !!}
                        </div>
                        </div>

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

    <script type="text/javascript" src="{{ asset('assets/vendors/moment/js/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/js/pages/tasklist.js') }}"></script>

@stop
