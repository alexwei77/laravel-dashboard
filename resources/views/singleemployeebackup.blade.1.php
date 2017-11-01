@extends('admin/layouts/defaultx')
{{-- Page title --}}
@section('title')
    @if(!empty($employeeDetails->first_name))
        {{ $employeeDetails->first_name ." " .$employeeDetails->last_name }} | StaffLife
    @else
        Employee | StaffLife
    @endif
@stop
<meta name="description"
      content="We have information on StaffLife about what companies this employee worked for think of them.">
{{-- page level styles --}}
@section('header_styles')
    <!--page level css starts-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/tabbular.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/bootstrap-rating/bootstrap-rating.css') }}">
    <!--end of page level css-->
    <!--ratings-->
    <link href="{{ asset('assets/vendors/select2/css/select2.min.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('assets/vendors/select2/css/select2-bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/bootstrapvalidator/css/bootstrapValidator.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/iCheck/css/all.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/vendors/datatables/css/dataTables.bootstrap.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/buttons.bootstrap.css') }}"/>
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/vendors/datatables/css/colReorder.bootstrap.css') }}"/>
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/vendors/datatables/css/dataTables.bootstrap.css') }}"/>
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/vendors/datatables/css/rowReorder.bootstrap.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/buttons.bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/scroller.bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/tables.css') }}"/>
    <style>

        .panel {
            width: 100%;
        }

        .btn-sm, .btn-xs {
            margin-left: 10px;
        }

        .dataTables_filter, .dataTables_paginate {
            margin-top: 15px;
            position: absolute;
            text-align: right;
            left: 60%;
        }

        .dataTables_filter {
            margin-top: 15px;
            position: absolute;
            text-align: right;
            left: 55%;
        }

        .col-md-3 {
         display: inline;
         overflow-x: auto;
         white-space: nowrap;
          }

    </style>
@stop
{{-- Page content --}}
@section('content')
    <?php
    //create array of pairs of x and y values
    $dataset1 = array();
    $dataset2 = array();
    $counter = 1;
    foreach ($allRatings as $dataunit) {
        //echo $dataunit->rated_fullname;
        $dataset1[] = array($counter, $dataunit->stars);
        $dataset2[] = array($counter + 0.25, $dataunit->stars);
        $counter++;
    }

    ?>
    <section class="content-header">
        <h1>{{ $employeeDetails->first_name  }} {{ $employeeDetails->last_name  }}</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                    Dashboard
                </a>
            </li>
            <li class="active">View employee</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12 col-xs-12 col-md-12 col-sm-12">
              @if(count($user->subscriptions)!==0)
                @if($company_verify)
                    <a href="{{ route('rate-employee', $employeeDetails->id) }}"
                       class="btn btn-primary btn-sm text-white">Score Employee</a>
                @else 
                You need to <a href="{{ route('verify-company') }}">verify</a> your company before updating employee profile.
                @endif
              @else
               <a href="{{ route('pay-package') }}">Subscribe now</a> before updating employee profile.
              @endif
                @if($watchDetails->watchstatus !== "Past employee")
                    <a href="{{ URL::to('viewcontract', $employeeDetails->id) }}" target="_blank"
                       class="btn btn-primary btn-sm text-white">View SLIP</a>
                @endif
                <a href="{{ URL::to('myemployees') }}" class="btn btn-primary btn-sm text-white">Back to
                    Users</a>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-lg-8">
                <!-- Stack charts strats here-->
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Profile summary
                        </h3>
                    </div>
                    <div class="panel-body">
                        <!--individual product description-->
                        <div class="col-md-6">
                            <div class="col-md-6">
                                <div class="fileinput-new thumbnail" style="max-width: 200px; max-height: 150px;">
                                    @if($employeeDetails->pic)
                                        <img src="{{ $url }}" alt="img"
                                             class="img-responsive"/>
                                    @else
                                        <img src="http://placehold.it/200x150" alt="..."
                                             class="img-responsive"/>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                @if($employeeDetails->first_name)
                                    <p>First name: {{ $employeeDetails->first_name }}</p>
                                @endif
                                @if($employeeDetails->last_name)
                                    <p>Last name: {{ $employeeDetails->last_name }}</p>
                                @endif
                                @if($employeeDetails->email)
                                    <p>Email: {{ $employeeDetails->email }}</p>
                                @endif
                                @if($employeeDetails->idnumber)
                                    <p>ID number: {{ $employeeDetails->idnumber }}</p>
                                @endif
                                @if($employeeDetails->gender)
                                    <p>Gender: {{ $employeeDetails->gender }}</p>
                                @endif
                                @if($employeeDetails->dob)
                                    <p>Date of birth: {{ $employeeDetails->dob }}</p>
                                @endif
                                @if($employeeDetails->dob)
                                    <p>Date of birth: {{ $employeeDetails->dob }}</p>
                                @endif
                                @if($employeeDetails->country)
                                    <p>Country: {{ $employeeDetails->country }}</p>
                                @endif
                                @if($employeeDetails->state)
                                    <p>State: {{ $employeeDetails->state }}</p>
                                @endif
                                @if($employeeDetails->city)
                                    <p>City: {{ $employeeDetails->city }}</p>
                                @endif
                                @if($employeeDetails->address)
                                    <p>Address: {{ $employeeDetails->address }}</p>
                                @endif
                                @if($employeeDetails->postal)
                                    <p>Postal: {{ $employeeDetails->postal }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">

            </div>
        </div>

      @if(count($user->subscriptions)==0)
       <div class="row">
        <div class="col-lg-8">
         <a href="{{ route('pay-package') }}">Subscribe now</a> to see the {{ $employeeDetails->first_name }} {{ $employeeDetails->last_name }}'s score from other companies.
         </div>
       </div>
      @else
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <div class="row">
                                <div class="col-md-4">Ethics & Basics - Provable data</div>
                                <div class="col-md-4">
                                    <table class="table table-bordered" id="table">

                                    </table>
                                    <div class="col-md-6">User</div>
                                    <div class="col-md-6">Member</div>
                                    <div class="col-md-6" align="right">Positive</div>
                                    <div class="col-md-6">ddd</div>
                                    <div class="col-md-12">eee</div>
                                </div>
                                <div class="col-md-4">&nbsp;</div>
                            </div>
                        </h3>
                    </div>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Commencement
                        </h3>
                        <span class="pull-right">
                                    <i class="fa fa-fw fa-chevron-up clickable"></i>
                                </span>
                    </div>
                    <div class="panel-body">
                        @foreach($metrics as $metric)
                            @if($metric->metric_section == "Commencement")
                                @if($metric->display_field == 1)
                                    <div class="row">
                                        <div class="col-md-2">
                                            <p>{{ $metric->name }}</p>
                                        </div>
                                        <div class="col-md-7">
                                            <p>{{ $metric->description }}</p>
                                        </div>
                                        <!--check if this metric is checked-->
                                    <?php $metricCheckStatus = 0; ?>
                                    @foreach($theScores as $theScore)
                                        @if(($theScore->metric_id) == ($metric->id))
                                            <?php $metricCheckStatus = $theScore->checked_unchecked; ?>
                                        @endif
                                    @endforeach
                                    <!--check which field to show-->
                                        <div class="col-md-3">
                                            @if($metric->item == "Tick box")
                                                {!! Form::checkbox('scoring'.$metric->id, $metric->id , $metricCheckStatus, ['disabled'=>'true']) !!}
                                            @else
                                                <p>{{ $metricCheckStatus }}</p>
                                            @endif
                                        </div>
                                        
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Employment
                        </h3>
                        <span class="pull-right">
                                    <i class="fa fa-fw fa-chevron-up clickable"></i>
                                </span>
                    </div>
                    <div class="panel-body">
                        @foreach($metrics as $metric)
                            @if($metric->metric_section == "Employment")
                                @if($metric->display_field == 1)
                                    <div class="row">
                                        <div class="col-md-2">
                                            <p>{{ $metric->name }}</p>
                                        </div>
                                        <div class="col-md-7">
                                            <p>{{ $metric->description }}</p>
                                        </div>
                                        <!--check if this metric is checked-->
                                    <?php $metricCheckStatus = 0; ?>
                                    @foreach($theScores as $theScore)
                                        @if(($theScore->metric_id) == ($metric->id))
                                            <?php $metricCheckStatus = $theScore->checked_unchecked; ?>
                                        @endif
                                    @endforeach
                                    <!--check which field to show-->
                                        <div class="col-md-3">
                                            @if(($metric->item) == "Tick box")
                                                {!! Form::checkbox('scoring'.$metric->id, $metric->id , $metricCheckStatus, ['disabled'=>true]) !!}
                                            @else
                                                @if(stripos($metric->name, 'salary') !== false || stripos($metric->name, 'commission') !== false || stripos($metric->name, 'bonuses') !== false)
                                                    <p>{{ $metricCheckStatus }} ({{ $currencySet }})</p>
                                                @else
                                                    <p>{{ $metricCheckStatus }}</p>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Termination
                        </h3>
                        <span class="pull-right">
                                    <i class="fa fa-fw fa-chevron-up clickable"></i>
                                </span>
                    </div>
                    <div class="panel-body">
                        @foreach($metrics as $metric)
                            @if($metric->metric_section == "Termination")
                                @if($metric->display_field == 1)
                                    <div class="row">
                                        <div class="col-md-2">
                                            <p>{{ $metric->name }}</p>
                                        </div>
                                        <div class="col-md-7">
                                            <p>{{ $metric->description }}</p>
                                        </div>
                                        <!--check if this metric is checked-->
                                    <?php $metricCheckStatus = 0; ?>
                                    @foreach($theScores as $theScore)
                                        @if(($theScore->metric_id) == ($metric->id))
                                            <?php $metricCheckStatus = $theScore->checked_unchecked; ?>
                                        @endif
                                    @endforeach
                                    <!--check which field to show-->
                                        <div class="col-md-3">
                                            @if(($metric->item) == "Tick box")
                                                {!! Form::checkbox('scoring'.$metric->id, $metric->id , $metricCheckStatus, ['disabled'=>true]) !!}
                                            @else
                                                @if(stripos($metric->name, 'owing') !== false)
                                                    <p>{{ $metricCheckStatus }} ({{ $currencySet }})</p>
                                                @else
                                                    <p>{{ $metricCheckStatus }}</p>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="panel panel-primary" style="margin-bottom: 0px">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <div class="row">
                                <div class="col-md-12" align="center">Performance - Member's opinion</div>
                            </div>
                        </h3>
                    </div>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-sm-2" align="left">
                                <h3 class="panel-title">
                                    Time
                                </h3>
                            </div>
                            <div class="col-sm-7" align="left">
                                &nbsp;
                            </div>
                            <div class="col-sm-3" align="left">
                                <h3 class="panel-title">
                                    Score (out of 5)
                                </h3>
                            </div>
                        </div>
                        <span class="pull-right">
                                    <i class="fa fa-fw fa-chevron-up clickable"></i>
                                </span>
                    </div>
                    <div class="panel-body">
                        @foreach($metrics as $metric)
                            @if($metric->metric_section == "Time")
                                @if($metric->display_field == 1)
                                    <div class="row">
                                        <div class="col-md-2">
                                            <p>{{ $metric->name }}</p>
                                        </div>
                                        <div class="col-md-7">
                                            <p>{{ $metric->description }}</p>
                                        </div>
                                        <!--check if this metric is checked-->
                                    <?php $metricCheckStatus = 0; ?>
                                    @foreach($theScores as $theScore)
                                        @if(($theScore->metric_id) == ($metric->id))
                                            <?php $metricCheckStatus = $theScore->checked_unchecked; ?>
                                        @endif
                                    @endforeach
                                    <!--check which field to show-->
                                        <div class="col-md-3">
                                            @if($metricCheckStatus == 0)
                                                <p>No rating</p>
                                            @else
                                                <p>{{ $metricCheckStatus }}</p>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-sm-2" align="left">
                                <h3 class="panel-title">
                                    Growth
                                </h3>
                            </div>
                            <div class="col-sm-7" align="left">
                                &nbsp;
                            </div>
                            <div class="col-sm-3" align="left">
                                <h3 class="panel-title">
                                    Score (out of 5)
                                </h3>
                            </div>
                        </div>
                        <span class="pull-right">
                                    <i class="fa fa-fw fa-chevron-up clickable"></i>
                                </span>
                    </div>
                    <div class="panel-body">
                        @foreach($metrics as $metric)
                            @if($metric->metric_section == "Growth")
                                @if($metric->display_field == 1)
                                    <div class="row">
                                        <div class="col-md-2">
                                            <p>{{ $metric->name }}</p>
                                        </div>
                                        <div class="col-md-7">
                                            <p>{{ $metric->description }}</p>
                                        </div>
                                        <!--check if this metric is checked-->
                                    <?php $metricCheckStatus = 0; ?>
                                    @foreach($theScores as $theScore)
                                        @if(($theScore->metric_id) == ($metric->id))
                                            <?php $metricCheckStatus = $theScore->checked_unchecked; ?>
                                        @endif
                                    @endforeach
                                    <!--check which field to show-->
                                        <div class="col-md-3">
                                            @if($metricCheckStatus == 0)
                                                <p>No rating</p>
                                            @else
                                                <p>{{ $metricCheckStatus }}</p>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-sm-2" align="left">
                                <h3 class="panel-title">
                                    Performance
                                </h3>
                            </div>
                            <div class="col-sm-7" align="left">
                                &nbsp;
                            </div>
                            <div class="col-sm-3" align="left">
                                <h3 class="panel-title">
                                    Score (out of 5)
                                </h3>
                            </div>
                        </div>
                        <span class="pull-right">
                                    <i class="fa fa-fw fa-chevron-up clickable"></i>
                                </span>
                    </div>
                    <div class="panel-body">
                        @foreach($metrics as $metric)
                            @if($metric->metric_section == "Performance")
                                @if($metric->display_field == 1)
                                    <div class="row">
                                        <div class="col-md-2">
                                            <p>{{ $metric->name }}</p>
                                        </div>
                                        <div class="col-md-7">
                                            <p>{{ $metric->description }}</p>
                                        </div>
                                        <!--check if this metric is checked-->
                                    <?php $metricCheckStatus = 0; ?>
                                    @foreach($theScores as $theScore)
                                        @if(($theScore->metric_id) == ($metric->id))
                                            <?php $metricCheckStatus = $theScore->checked_unchecked; ?>
                                        @endif
                                    @endforeach
                                    <!--check which field to show-->
                                        <div class="col-md-3">
                                            @if($metricCheckStatus == 0)
                                                <p>No rating</p>
                                            @else
                                                <p>{{ $metricCheckStatus }}</p>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-sm-2" align="left">
                                <h3 class="panel-title">
                                    Traits
                                </h3>
                            </div>
                            <div class="col-sm-7" align="left">
                                &nbsp;
                            </div>
                            <div class="col-sm-3" align="left">
                                <h3 class="panel-title">
                                    Score (out of 5)
                                </h3>
                            </div>
                        </div>
                        <span class="pull-right">
                                    <i class="fa fa-fw fa-chevron-up clickable"></i>
                                </span>
                    </div>
                    <div class="panel-body">
                        @foreach($metrics as $metric)
                            @if($metric->metric_section == "Traits")
                                @if($metric->display_field == 1)
                                    <div class="row">
                                        <div class="col-md-2">
                                            <p>{{ $metric->name }}</p>
                                        </div>
                                        <div class="col-md-7">
                                            <p>{{ $metric->description }}</p>
                                        </div>
                                        <!--check if this metric is checked-->
                                    <?php $metricCheckStatus = 0; ?>
                                    @foreach($theScores as $theScore)
                                        @if(($theScore->metric_id) == ($metric->id))
                                            <?php $metricCheckStatus = $theScore->checked_unchecked; ?>
                                        @endif
                                    @endforeach
                                    <!--check which field to show-->
                                        <div class="col-md-3">
                                            @if($metricCheckStatus == 0)
                                                <p>No rating</p>
                                            @else
                                                <p>{{ $metricCheckStatus }}</p>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
      @endif
    </section>

@stop
{{-- page level scripts --}}
@section('footer_scripts')
    <!--custom datatables-->
    <script type="text/javascript"
            src="{{ asset('assets/vendors/datatables/js/jquery.dataTables.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('assets/vendors/jeditable/js/jquery.jeditable.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('assets/vendors/datatables/js/dataTables.bootstrap.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('assets/vendors/datatables/js/dataTables.buttons.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('assets/vendors/datatables/js/dataTables.colReorder.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('assets/vendors/datatables/js/dataTables.responsive.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('assets/vendors/datatables/js/dataTables.rowReorder.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/buttons.colVis.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/buttons.html5.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/buttons.print.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('assets/vendors/datatables/js/buttons.bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/buttons.print.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/pdfmake.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/vfs_fonts.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('assets/vendors/datatables/js/dataTables.scroller.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap-slider/js/bootstrap-slider.js') }}"></script>
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

        $(function () {
            var table5 = $('#table5').DataTable({
           processing: true,
           serverSide: true,
           order:[[ 0, "desc" ]],
            pageLength: 100,
          
           ajax: {
               url: "{{ action('FrontEndController@employeedata') }}",
               data: function (d) {
                   d.ageRadio2=ageRadio2;
                   d.idSlider2=idSlider2;
                   d.professionSelect2 = professionSelect2;
                   d.jobButton2=jobButton2;
               }
           },
           columns: [
               { data: 'checkbox', name: 'checkbox' },
               { data: 'first_name', name: 'first_name' },
               { data: 'last_name', name: 'last_name' },
               { data: 'idnumber', name: 'idnumber' },
               { data: 'email', name: 'email' },
               { data: 'watchstatus', name: 'watchstatus' },
               { data: 'actions', name: 'actions' },
               // { data: 'consent_granted', name: 'consent_granted' },
            ],
            dom: 'ftlpr<"clearfix">'
       });
        });
    </script>
@stop