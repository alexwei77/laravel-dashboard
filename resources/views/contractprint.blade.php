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
                    <a href="#">Dashboard</a>
                </li>
                <li class="hidden-xs">
                    <i class="livicon icon3" data-name="angle-double-right" data-size="18" data-loop="true" data-c="#4caf50" data-hc="#4caf50"></i>
                    <a href="#">Generate Contract</a>
                </li>
                <li class="hidden-xs">
                    <i class="livicon icon3" data-name="angle-double-right" data-size="18" data-loop="true" data-c="#4caf50" data-hc="#4caf50"></i>
                    <a href="#">Contract Print</a>
                </li>
            </ol>
            <div class="pull-right">
                <i class="livicon icon3" data-name="edit" data-size="20" data-loop="true" data-c="#3d3d3d" data-hc="#3d3d3d"></i> Contract Print
            </div>
        </div>
    </div>
@stop


{{-- Page content --}}
@section('content')
    <!-- Notifications -->
    @include('notifications')
    <!-- Container Section Start -->
    <div class="container">
        <!--item view start-->
        <div class="row">
            <div class="mart10">
                
                
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
                            <li>
                                <a href="{{ URL::to('dashboard') }}">
                                Overview</a>
                            </li>
                            <li>
                                <a href="{{ URL::to('my-account') }}">
                                My Account </a>
                            </li>
                            <li>
                                <a href="{{ URL::to('employees') }}">
                                Employees </a>
                            </li>
                            <li>
                                <a href="{{ URL::to('subscribe') }}">
                                Purchase Contracts </a>
                            </li>
                            <li class="active">
                                <a href="#tab_default_2" data-toggle="tab">
                                Generate Contract </a>
                            </li>
                            <li>
                                <a href="{{ URL::to('consentmanagement') }}">
                                Consent Management </a>
                            </li>
                            
                        </ul>
                        <!-- //Nav Nav-tabs End -->
                        <!-- Tab-content Start -->
                        <div class="tab-content">
                            <div class="tab-pane active col-lg-6" id="tab_default_1">
                            <p> A contract request for <b><?php echo $employeeData->first_name ." " .$employeeData->last_name; ?></b> has been successfuly generated. However, you are not going to be able to watch the employee until we receive consent from the employee. Below you can download the contract for the employee to sign. </p>
                              <form role="form" id="contractForm" class="form-horizontal" action="{{ action('FrontEndController@contractprint') }}" method="POST">
                               <input type="hidden" name="_token" value="{{ csrf_token() }}">
                               <div class="ui-widget">
                                   <input type="hidden" placeholder="Employee ID" name="employeeID" id="employeeID" class="form-control" value="<?php echo $employeeData->idnumber ?>">
                               </div> 
                               <div class="ui-widget">
                                   <input type="hidden" placeholder="Employee Email" name="employeeEmail" id="employeeEmail" class="form-control" value="<?php echo $employeeData->email ?>">
                               </div> 
                               <div class="ui-widget">
                                   <input type="hidden" placeholder="First Name" name="firstname" id="firstname" class="form-control" value="<?php echo $employeeData->first_name ?>">
                               </div> 
                               <div class="ui-widget">
                                   <input type="hidden" placeholder="Last Name" name="lastname" id="lastname" class="form-control" value="<?php echo $employeeData->last_name ?>">
                               </div>
                               <br>
                               <div class="ui-widget text-center">
                                   <button class="btn btn-primary" type="submit">View Contract</button>
                               </div>
                               <br>
                              </form>{{--{!!  Form::close()  !!}--}}
                            </div>
                            


                             <!--<section class="content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-primary filterable">
                            <div class="panel-heading clearfix  ">
                                <div class="panel-title pull-left">
                                       <div class="caption">
                                    <i class="livicon" data-name="camera" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                    TableTools
                                </div>
                                </div>
                            </div>
                            <div class="panel-body table-responsive">
                                <table class="table table-striped table-bordered" id="table2">
                                    <thead>
                                        <tr>

                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>User Name</th>
                                            <th>
                                                User E-mail
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>

                                            <td>Mark</td>
                                            <td>Otto</td>
                                            <td>Markotto</td>
                                            <td>
                                                Markotto@test.com
                                            </td>
                                        </tr>
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>-->
            <!-- content -->




                        </div>
                        <!-- //Tabbable-line End -->
                    </div>
                    <!-- Tabbable_panel End -->
                </div>
            </div>
        </div>
        <!--item desciption end-->
        
    </div>
    <!-- //Container Section End -->
   

@stop

{{-- page level scripts --}}
@section('footer_scripts')

    <!--page level js start-->
    <script type="text/javascript" src="{{ asset('assets/js/frontend/elevatezoom.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/bootstrap-rating/bootstrap-rating.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/jquery.dataTables.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.buttons.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/buttons.colVis.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/buttons.html5.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/buttons.print.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/buttons.bootstrap.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/buttons.print.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/pdfcontract.js') }}" ></script><!--the pdf download is done in this file-->
    <!--<script type="text/javascript" src="{{ asset('assets/js/frontend/cart.js') }}"></script>-->
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/vfs_fonts.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/js/pages/table-advanced-print.js') }}" ></script>


@stop
