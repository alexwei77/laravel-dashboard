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
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/bootstrap-rating/bootstrap-rating.css') }}">
    <!--end of page level css-->
    <!--ratings-->
    <link href="{{ asset('assets/vendors/select2/css/select2.min.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('assets/vendors/select2/css/select2-bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/bootstrapvalidator/css/bootstrapValidator.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/iCheck/css/all.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/pages/wizard.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/bootstrapStarRating/css/star-rating.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/css/pages/custom_rating.css') }}" rel="stylesheet" type="text/css"/>
    <!--animated charts-->
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
        label {
            font-weight: normal;
        }
    </style>
@stop
{{-- Page content --}}
@section('content')
    <section class="content-header">
        <h1>Member Data Submission</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                    Dashboard
                </a>
            </li>
            <li class="active">Member Data Submission <li class="active"></li> {{ $employeeDetails->first_name }} {{ $employeeDetails->last_name }}</li>
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
                            <div class="row" style="padding: 0px 0px 0px 0px">
                                <div class="col-md-6"><p>Last Member Data Submission Date: {{ $most_recent_submission_member_date }}</p></div>
                                <div class="col-md-6"><p>Evidence</p></div>
                            </div>
                        </h3>
                    </div>
                </div>
                <div class="panel panel-primary" style="margin-bottom: 0px;">
                    <div class="panel-heading" style="background-color: #4c4a50;">
                        <h3 class="panel-title">
                            <div class="row" style="padding: 0px 0px 0px 0px">
                                <div class="col-md-2"><p>Data</p></div>
                                <div class="col-md-3"><p>Description</p></div>
                                <div class="col-md-3"><p>Required As Proof</p></div>
                                <div class="col-md-2"><p>By</p></div>
                                <div class="col-md-2"><p>Metric</p></div>
                            </div>
                        </h3>
                    </div>
                </div>
                <form class="form" id="main_input_box" action="{{ action('EmployeesController@submitscore') }}"
                      method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="employeeid" value="{{ $employeeDetails->id }}">
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
                                            {!! Form::label($metric->name) !!}
                                        </div>
                                        <div class="col-md-3">
                                            {!! Form::label($metric->description) !!}
                                        </div>
                                        <div class="col-md-3">
                                            {!! Form::label($metric->req_as_proof) !!}
                                        </div>
                                        <div class="col-md-2">
                                            {!! Form::label($metric->re_by) !!}
                                        </div>
                                        <!--check if this metric is checked-->
                                    <?php $metricCheckStatus = null; ?>
                                    @foreach($theScores as $theScore)
                                        @if(($theScore->metric_id) == ($metric->id))
                                            <?php $metricCheckStatus = $theScore->checked_unchecked; ?>
                                        @endif
                                    @endforeach
                                    <!--check which field to show-->
                                        <div class="col-md-2">
                                            @if(($metric->item) == "Tick box")
                                                <?php
                                                    if(!isset($metricCheckStatus)) {
                                                        $metricCheckStatus = 0;
                                                    }
                                                ?>
                                                {!! Form::checkbox('scoring'.$metric->id, $metric->id , $metricCheckStatus, ['id'=>'scoring'.$metric->id]) !!}
                                            @endif
                                            @if(($metric->item) == "Date")
                                                    <?php
                                                    if(!isset($metricCheckStatus)) {
                                                        $metricCheckStatus = "";
                                                    }
                                                    ?>
                                                {!! Form::date('scoring'.$metric->id, $metricCheckStatus, ['class'=>'form-control']) !!}
                                            @endif
                                            @if(($metric->item) == "Text")
                                                    <?php
                                                    if($metricCheckStatus == 0) {
                                                        $metricCheckStatus = "";
                                                    }
                                                    ?>
                                                {!! Form::text('scoring'.$metric->id, $metricCheckStatus, ['class' =>'form-control']) !!}
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
                                            {!! Form::label($metric->name) !!}
                                        </div>
                                        <div class="col-md-3">
                                            {!! Form::label($metric->description) !!}
                                        </div>
                                        <div class="col-md-3">
                                            {!! Form::label($metric->req_as_proof) !!}
                                        </div>
                                        <div class="col-md-2">
                                            @if(stripos($metric->name, 'salary') !== false || stripos($metric->name, 'commission') !== false || stripos($metric->name, 'bonuses') !== false)
                                                {{ Form::select($metric->field_name, $currency_lookup, $currencySet, ['id' => $metric->field_name, 'class' => 'currency']) }}
                                            @else
                                                {!! Form::label($metric->re_by) !!}
                                            @endif
                                        </div>
                                        <!--check if this metric is checked-->
                                    <?php $metricCheckStatus = null; ?>
                                    @foreach($theScores as $theScore)
                                        @if(($theScore->metric_id) == ($metric->id))
                                            <?php $metricCheckStatus = $theScore->checked_unchecked; ?>
                                        @endif
                                    @endforeach
                                    <!--check which field to show-->
                                        <div class="col-md-2">
                                            @if(($metric->item) == "Tick box")
                                                <?php
                                                if(!isset($metricCheckStatus)) {
                                                    $metricCheckStatus = 0;
                                                }
                                                ?>
                                                {!! Form::checkbox('scoring'.$metric->id, $metric->id , $metricCheckStatus, ['id'=>'scoring'.$metric->id]) !!}
                                            @endif
                                            @if(($metric->item) == "Date")
                                                    <?php
                                                    if(!isset($metricCheckStatus)) {
                                                        $metricCheckStatus = "";
                                                    }
                                                    ?>
                                                {!! Form::date('scoring'.$metric->id, $metricCheckStatus, ['class'=>'form-control']) !!}
                                            @endif
                                            @if(($metric->item) == "Text")
                                                    <?php
                                                    if($metricCheckStatus == 0) {
                                                        $metricCheckStatus = "";
                                                    }
                                                    ?>
                                                {!! Form::text('scoring'.$metric->id, $metricCheckStatus, ['class' =>'form-control']) !!}
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
                                                {!! Form::label($metric->name) !!}
                                            </div>
                                            <div class="col-md-3">
                                                {!! Form::label($metric->description) !!}
                                            </div>
                                            <div class="col-md-3">
                                                {!! Form::label($metric->req_as_proof) !!}
                                            </div>
                                            <div class="col-md-2">
                                                @if(stripos($metric->name, 'owing') !== false)
                                                {{ Form::select('currency', $currency_lookup, $currencySet, array(), ['id' => 'currency']) }}
                                                @else
                                                {!! Form::label($metric->re_by) !!}
                                                @endif
                                            </div>
                                            <!--check if this metric is checked-->
                                        <?php $metricCheckStatus = null; ?>
                                        @foreach($theScores as $theScore)
                                            @if(($theScore->metric_id) == ($metric->id))
                                                <?php $metricCheckStatus = $theScore->checked_unchecked; ?>
                                            @endif
                                        @endforeach
                                        <!--check which field to show-->
                                            <div class="col-md-2">
                                                @if(($metric->item) == "Tick box")
                                                    <?php
                                                    if(!isset($metricCheckStatus)) {
                                                        $metricCheckStatus = 0;
                                                    }
                                                    ?>
                                                    {!! Form::checkbox('scoring'.$metric->id, $metric->id , $metricCheckStatus, ['id'=>'scoring'.$metric->id]) !!}
                                                @endif
                                                @if(($metric->item) == "Date")
                                                        <?php
                                                        if(!isset($metricCheckStatus)) {
                                                            $metricCheckStatus = "";
                                                        }
                                                        ?>
                                                    {!! Form::date('scoring'.$metric->id, $metricCheckStatus, ['class'=>'form-control']) !!}
                                                @endif
                                                @if(($metric->item) == "Text")
                                                        <?php
                                                        if($metricCheckStatus == 0) {
                                                            $metricCheckStatus = "";
                                                        }
                                                        ?>
                                                    {!! Form::text('scoring'.$metric->id, $metricCheckStatus, ['class' =>'form-control']) !!}
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="panel panel-primary" style="margin-bottom: 0px">
                        <div class="panel-heading" style="background-color: #4c4a50;">
                            <h3 class="panel-title">
                                <div class="row" style="padding: 0px 0px 0px 0px">
                                    <div class="col-md-12" align="center">Performance - Member's opinion</div>
                                </div>
                            </h3>
                        </div>
                    </div>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                Time
                            </h3>
                        </div>
                        <div class="panel-body">
                            @foreach($metrics as $metric)
                                @if($metric->metric_section == "Time")
                                    @if($metric->display_field == 1)
                                        <div class="row">
                                            <div class="col-md-2">
                                                {!! Form::label($metric->name) !!}
                                            </div>
                                            <div class="col-md-4">
                                                {!! Form::label($metric->description) !!}
                                            </div>
                                            <!--check if this metric is checked-->
                                        <?php $metricCheckStatus = 0; ?>
                                        @foreach($theScores as $theScore)
                                            @if(($theScore->metric_id) == ($metric->id))
                                                <?php $metricCheckStatus = $theScore->checked_unchecked; ?>
                                            @endif
                                        @endforeach
                                        <!--check which field to show-->
                                            <div class="col-md-1">
                                                N/A {!! Form::radio('scoring'.$metric->id, 'N/A', $metricCheckStatus == 'N/A' ? true : false, ['id'=>'scoring'.$metric->id]) !!}
                                            </div>
                                            <div class="col-md-1">
                                                1 {!! Form::radio('scoring'.$metric->id, 1, $metricCheckStatus == 1 ? true : false, ['id'=>'scoring'.$metric->id]) !!}
                                            </div>
                                            <div class="col-md-1">
                                                2 {!! Form::radio('scoring'.$metric->id, 2, $metricCheckStatus == 2 ? true : false, ['id'=>'scoring'.$metric->id]) !!}
                                            </div >
                                            <div class="col-md-1">
                                                3 {!! Form::radio('scoring'.$metric->id, 3, $metricCheckStatus == 3 ? true : false, ['id'=>'scoring'.$metric->id]) !!}
                                            </div>
                                            <div class="col-md-1">
                                                4 {!! Form::radio('scoring'.$metric->id, 4, $metricCheckStatus == 4 ? true : false, ['id'=>'scoring'.$metric->id]) !!}
                                            </div>
                                            <div class="col-md-1">
                                                5 {!! Form::radio('scoring'.$metric->id, 5, $metricCheckStatus == 5 ? true : false, ['id'=>'scoring'.$metric->id]) !!}
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
                                Growth
                            </h3>
                        </div>
                        <div class="panel-body">
                            @foreach($metrics as $metric)
                                @if($metric->metric_section == "Growth")
                                    @if($metric->display_field == 1)
                                        <div class="row">
                                            <div class="col-md-2">
                                                {!! Form::label($metric->name) !!}
                                            </div>
                                            <div class="col-md-4">
                                                {!! Form::label($metric->description) !!}
                                            </div>
                                            <!--check if this metric is checked-->
                                        <?php $metricCheckStatus = 0; ?>
                                        @foreach($theScores as $theScore)
                                            @if(($theScore->metric_id) == ($metric->id))
                                                <?php $metricCheckStatus = $theScore->checked_unchecked; ?>
                                            @endif
                                        @endforeach
                                        <!--check which field to show-->
                                            <div class="col-md-1">
                                                N/A {!! Form::radio('scoring'.$metric->id, 'N/A', $metricCheckStatus == 'N/A' ? true : false, ['id'=>'scoring'.$metric->id]) !!}
                                            </div>
                                            <div class="col-md-1">
                                                1 {!! Form::radio('scoring'.$metric->id, 1, $metricCheckStatus == 1 ? true : false, ['id'=>'scoring'.$metric->id]) !!}
                                            </div>
                                            <div class="col-md-1">
                                                2 {!! Form::radio('scoring'.$metric->id, 2, $metricCheckStatus == 2 ? true : false, ['id'=>'scoring'.$metric->id]) !!}
                                            </div >
                                            <div class="col-md-1">
                                                3 {!! Form::radio('scoring'.$metric->id, 3, $metricCheckStatus == 3 ? true : false, ['id'=>'scoring'.$metric->id]) !!}
                                            </div>
                                            <div class="col-md-1">
                                                4 {!! Form::radio('scoring'.$metric->id, 4, $metricCheckStatus == 4 ? true : false, ['id'=>'scoring'.$metric->id]) !!}
                                            </div>
                                            <div class="col-md-1">
                                                5 {!! Form::radio('scoring'.$metric->id, 5, $metricCheckStatus == 5 ? true : false, ['id'=>'scoring'.$metric->id]) !!}
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
                                Performance
                            </h3>
                        </div>
                        <div class="panel-body">
                            @foreach($metrics as $metric)
                                @if($metric->metric_section == "Performance")
                                    @if($metric->display_field == 1)
                                        <div class="row">
                                            <div class="col-md-2">
                                                {!! Form::label($metric->name) !!}
                                            </div>
                                            <div class="col-md-4">
                                                {!! Form::label($metric->description) !!}
                                            </div>
                                            <!--check if this metric is checked-->
                                        <?php $metricCheckStatus = 0; ?>
                                        @foreach($theScores as $theScore)
                                            @if(($theScore->metric_id) == ($metric->id))
                                                <?php $metricCheckStatus = $theScore->checked_unchecked; ?>
                                            @endif
                                        @endforeach
                                        <!--check which field to show-->
                                            <div class="col-md-1">
                                                N/A {!! Form::radio('scoring'.$metric->id, 'N/A', $metricCheckStatus == 'N/A' ? true : false, ['id'=>'scoring'.$metric->id]) !!}
                                            </div>
                                            <div class="col-md-1">
                                                1 {!! Form::radio('scoring'.$metric->id, 1, $metricCheckStatus == 1 ? true : false, ['id'=>'scoring'.$metric->id]) !!}
                                            </div>
                                            <div class="col-md-1">
                                                2 {!! Form::radio('scoring'.$metric->id, 2, $metricCheckStatus == 2 ? true : false, ['id'=>'scoring'.$metric->id]) !!}
                                            </div >
                                            <div class="col-md-1">
                                                3 {!! Form::radio('scoring'.$metric->id, 3, $metricCheckStatus == 3 ? true : false, ['id'=>'scoring'.$metric->id]) !!}
                                            </div>
                                            <div class="col-md-1">
                                                4 {!! Form::radio('scoring'.$metric->id, 4, $metricCheckStatus == 4 ? true : false, ['id'=>'scoring'.$metric->id]) !!}
                                            </div>
                                            <div class="col-md-1">
                                                5 {!! Form::radio('scoring'.$metric->id, 5, $metricCheckStatus == 5 ? true : false, ['id'=>'scoring'.$metric->id]) !!}
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
                                Traits
                            </h3>
                        </div>
                        <div class="panel-body">
                            @foreach($metrics as $metric)
                                @if($metric->metric_section == "Traits")
                                    @if($metric->display_field == 1)
                                        <div class="row">
                                            <div class="col-md-2">
                                                {!! Form::label($metric->name) !!}
                                            </div>
                                            <div class="col-md-4">
                                                {!! Form::label($metric->description) !!}
                                            </div>
                                            <!--check if this metric is checked-->
                                        <?php $metricCheckStatus = 0; ?>
                                        @foreach($theScores as $theScore)
                                            @if(($theScore->metric_id) == ($metric->id))
                                                <?php $metricCheckStatus = $theScore->checked_unchecked; ?>
                                            @endif
                                        @endforeach
                                        <!--check which field to show-->
                                            <div class="col-md-1">
                                                N/A {!! Form::radio('scoring'.$metric->id, 'N/A', $metricCheckStatus == 'N/A' ? true : false, ['id'=>'scoring'.$metric->id]) !!}
                                            </div>
                                            <div class="col-md-1">
                                                1 {!! Form::radio('scoring'.$metric->id, 1, $metricCheckStatus == 1 ? true : false, ['id'=>'scoring'.$metric->id]) !!}
                                            </div>
                                            <div class="col-md-1">
                                                2 {!! Form::radio('scoring'.$metric->id, 2, $metricCheckStatus == 2 ? true : false, ['id'=>'scoring'.$metric->id]) !!}
                                            </div >
                                            <div class="col-md-1">
                                                3 {!! Form::radio('scoring'.$metric->id, 3, $metricCheckStatus == 3 ? true : false, ['id'=>'scoring'.$metric->id]) !!}
                                            </div>
                                            <div class="col-md-1">
                                                4 {!! Form::radio('scoring'.$metric->id, 4, $metricCheckStatus == 4 ? true : false, ['id'=>'scoring'.$metric->id]) !!}
                                            </div>
                                            <div class="col-md-1">
                                                5 {!! Form::radio('scoring'.$metric->id, 5, $metricCheckStatus == 5 ? true : false, ['id'=>'scoring'.$metric->id]) !!}
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <button class="btn btn-warning">
                        <span class="glyphicon glyphicon-ok-sign"></span>
                        SAVE
                    </button>
                </form>
            </div>

        </div>
    </section>
    @stop
    {{-- page level scripts --}}
    @section('footer_scripts')
    <!--page level js start-->
    <script type="text/javascript" src="{{ asset('assets/vendors/bootstrap-rating/bootstrap-rating.js') }}"></script>
    <!--page level js start-->
    <script src="{{ asset('assets/vendors/bootstrapStarRating/js/star-rating.min.js') }}"
            type="text/javascript"></script>
    <!--custom datatables-->
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/jquery.dataTables.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/jeditable/js/jquery.jeditable.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.buttons.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.colReorder.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.responsive.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.rowReorder.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/buttons.colVis.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/buttons.html5.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/buttons.print.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/buttons.bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/buttons.print.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/pdfmake.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/vfs_fonts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.scroller.js') }}"></script>
    <script src="{{ asset('assets/vendors/iCheck/js/icheck.js') }}"></script>
    <script>jQuery('#bonuses, #commission, #monthly_salary').change(function(e) {
                var elemId = e.target.id;
                var currency_code = jQuery('#'+elemId).val();
                // console.log(elemId);
                jQuery.ajax({
                    url: '{{ url('currency-set') }}' + '/' + currency_code,
                    type: 'GET',
                    success: function( result ) {
                        jQuery('.currency').val(currency_code);
                        console.log('Updated currency to: ' + currency_code);
                    }
                });
        });</script>
    @stop