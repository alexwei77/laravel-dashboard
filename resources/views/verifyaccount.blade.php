@extends('admin/layouts/defaultx')

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

     <!--page level css starts-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/tabbular.css') }}">
    <!--end of page level css-->
    <!--for custom datatables-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/dataTables.bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/buttons.bootstrap.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/colReorder.bootstrap.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/dataTables.bootstrap.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/rowReorder.bootstrap.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/buttons.bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/scroller.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-slider/css/bootstrap-slider.min.css') }}" />
    <link href="{{ asset('assets/vendors/iCheck/css/all.css') }}"  rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/tables.css') }}" />
    <style>
       thead{
           background-color: #ee6f00;
           color: #fff;
       }
    </style>
    <!--end of for custom datatables-->
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
                    <a href="#">Consent Management</a>
                </li>
            </ol>
            <div class="pull-right">
                <i class="livicon icon3" data-name="edit" data-size="20" data-loop="true" data-c="#3d3d3d" data-hc="#3d3d3d"></i> Consent Management
            </div>
        </div>
    </div>
@stop


{{-- Page content --}}
@section('content')

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
                    
                        <!-- Tab-content Start -->
                        <div class="tab-content">
                            
                             <div class="container">
        <!--<h2>All Ratings</h2>-->
        <div class="row">
            <div class="content">
                <div class="col-md-16">

                        <section class="content">
                          
                               
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-primary filterable">
                            <div class="panel-heading clearfix" >
                                <div class="pull-right" data-toggle="buttons">
                                    <!--<label class="btn btn-default tag"  id="buttonMale2">
                                        <input type="radio" name="tags" value="button1" id="buttonMale2" autocomplete="off" data-value="male"> Employees
                                    </label>
                                    <label class="btn btn-default tag"  id="buttonFemale2">
                                        <input type="radio" name="tags" value="button2" id="buttonFemale2" autocomplete="off" data-value="female"> Employers
                                    </label>-->
                                </div>
                                <div class="panel-title pull-left">
                                    <div class="caption">
                                        <!--<i class="livicon" data-name="camera" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>-->
                                       <?php //echo $ratingsCounter ?> <!--Ratings Found-->
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    
                                </div>

                                <div class="col-md-6 text-center">
                                    <!--<label class="control-label">Star Rating :</label><br>
                                    <label class="radio-inline">
                                        &nbsp;<input type="radio" class="custom-radio2" name="radioAge[]" id="radio_one" value="1" >&nbsp; 1</label>
                                    <label class="radio-inline">
                                        <input type="radio" class="custom-radio2" name="radioAge[]" id="radio_two" value="2">&nbsp; 2</label>
                                    <label class="radio-inline">
                                        <input type="radio"  class="custom-radio2" name="radioAge[]" id="radio_three" value="3">&nbsp; 3</label>
                                    <label class="radio-inline">
                                        <input type="radio" class="custom-radio2" name="radioAge[]" id="radio_two" value="4">&nbsp; 4</label>
                                    <label class="radio-inline">
                                        <input type="radio"  class="custom-radio2" name="radioAge[]" id="radio_three" value="5">&nbsp; 5</label>-->
                                </div>

                                    <div class="col-md-3">
                                      
                                    </div>
                            </div>
                            <div class="panel-body table-responsive">
                                <table class="table table-striped" id="table5">
                                    <thead>
                                    <tr class="filters">
                                        <th title="Click to order">First Name</th>
                                        <th title="Click to order">Last Name</th>
                                        <th title="Click to order">ID Number</th>
                                        <th title="Click to order">Email</th>
                                        <th title="Click to order">Watch Status</th>
                                        <th title="Click to order">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- row-->
            </section>
            <!-- content -->
                  
                </div>
             
                <!-- /.col-md-4 -->
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
    <script>
        $('input[type="radio"].custom-radio').iCheck({
            radioClass: 'iradio_flat-blue',
            increaseArea: '20%'
        });
        $('input[type="radio"].custom-radio2').iCheck({
            radioClass: 'iradio_flat-blue',
            increaseArea: '20%'
        });
        $(function() {
            var jobButton,ageRadio,idSlider,professionSelect;
            var jobButton2,ageRadio2,idSlider2,professionSelect2;
    
            $('#buttonFemale').click(function () {
                jobButton='female';
                table4.draw();
            });

           
            $('.custom-radio2').on('ifChanged', function(event){
                ageRadio2 =  $(this).val();
                table5.draw();
            });
            $('#professions2').click(function () {
                professionSelect2 = $(this).val();
                table5.draw();
            });
            $('#buttonMale2').click(function () {
                jobButton2='male';
                table5.draw();
            });
            $('#buttonFemale2').click(function () {
                jobButton2='female';
                table5.draw();
            });

            var table5 = $('#table5').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ action('FrontEndController@verifyaccountData') }}",
                    data: function (d) {
                        d.ageRadio2=ageRadio2;
                        d.idSlider2=idSlider2;
                        d.professionSelect2 = professionSelect2;
                        d.jobButton2=jobButton2;
                    }
                },
                columns: [
                    { data: 'first_name', name: 'first_name' },
                    { data: 'last_name', name: 'last_name' },
                    { data: 'idnumber', name: 'idnumber' },
                    { data: 'email', name: 'email' },
                    { data: 'watchstatus', name: 'watchstatus' },
                    { data: 'actions', name: 'actions' },
                ]
            });
        });
    </script>
    <!--end of custom datatables-->

@stop
