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
    <link href="{{ asset('assets/css/pages/charts.css') }}" rel="stylesheet" type="text/css"/>
    <!--page level css starts-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/tabbular.css') }}">
    <!--end of page level css-->
    <!--ratings-->
    <link href="{{ asset('assets/vendors/select2/css/select2.min.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('assets/vendors/select2/css/select2-bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/bootstrapvalidator/css/bootstrapValidator.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/iCheck/css/all.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/pages/custom_rating.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/tables.css') }}"/>
    <style>
        label {
            font-weight: normal;
        }
    </style>
@stop
{{-- Page content --}}
@section('content')
    <section class="content-header">
        <h1>View Staff Ratings</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                    Dashboard
                </a>
            </li>
            <li class="active">View Staff Ratings
            <li class="active"></li>
            {{ $employeeDetails->first_name }} {{ $employeeDetails->last_name }}</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary" style="margin-bottom: 0px">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <div class="row">
                                <div class="col-md-2"><p>Data</p></div>
                                <div class="col-md-7"><p>Description</p></div>
                                <div class="col-md-3"><p>Metric</p></div>
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
    </section>
@stop
{{-- page level scripts --}}
@section('footer_scripts')
    <script src="{{ asset('assets/vendors/iCheck/js/icheck.js') }}"></script>
@stop