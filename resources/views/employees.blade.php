@extends('admin/layouts/defaultx')
{{-- Page title --}}
@section('title')
Employees
@parent
@stop
{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/dataTables.bootstrap.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/buttons.bootstrap.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/colReorder.bootstrap.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/dataTables.bootstrap.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/rowReorder.bootstrap.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/buttons.bootstrap.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/scroller.bootstrap.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/tables.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">
@stop
{{-- Page content --}}
@section('content')
<section class="content-header">
   <!--section starts-->
   <h1>Employees/Prospects</h1>
   <ol class="breadcrumb">
      <li>
         <a href="{{ route('admin.dashboard') }}">
         <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
         Dashboard
         </a>
      </li>
      <li class="active">Employees/Prospects</li>
   </ol>
</section>
<!--section ends-->
<section class="content">
   <div class="row">
      <div class="col-lg-12">
         <div class="panel panel-primary filterable">
            <div class="panel-heading clearfix  ">
               <div class="panel-title pull-left">
                  <div class="caption">
                     Available employees: @if($subscriptionPackage->employees_avail < 0) Unlimited @else {{ $subscriptionPackage->employees_avail }} @endif | Available admins: @if($subscriptionPackage->admins_avail < 0) Unlimited @else {{ $subscriptionPackage->admins_avail }} @endif
                  </div>
               </div>
            </div>
            <div class="panel-body table-responsive">
               <table class="table table-striped" id="table5">
                  <thead>
                     <tr>
                        <td>
                           <!--<input type="checkbox" class="global-checkbox" autocomplete="off" />-->
                           <input class="checkbox-select-all" type="checkbox" data-checkboxall="0" autocomplete="off">
                        </td>
                        <td>
                           <!--<input type="search" data-column="1"  class="search-input-text">-->
                        </td>
                        <td>
                           <!--<input type="search" data-column="2"  class="search-input-text">-->
                        </td>
                        <td>
                           <!--<input type="search" data-column="3"  class="search-input-text">-->
                        </td>
                        <td>
                           <!--<input type="search" data-column="4"  class="search-input-text">-->
                        </td>
                        <td>
                           <select data-column="5"  class="search-input-select">
                              <option value="Pending">Pending</option>
                              <option value="No start date">No start date</option>
                              <option value="Active">Active</option>
                              <option value="Expired">Expired</option>
                              <option value="Past employee">Past employees</option>
                           </select>
                        </td>
                        <td></td>
                     </tr>
                     <tr class="filters">
                        <th title="Click to order"></th>
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
               <!--<hr>-->
               <a id="all-action-link" href="{{ route('move-all-to-contract') }}"><button type="submit" id="all-action-button" class="btn btn-primary add_pending_button">
               Move all to contract
               </button></a>
               <a id="selected-action-link" href="{{ route('move-selected-to-contract') }}"><button type="submit" id="selected-action-button" class="btn btn-primary add_contract_button">
               Move selected to contract
               </button></a>
               <a id="all-action-link-past" href="#"><button type="submit" id="move-all-historical" data-target="#historical_all" data-toggle="modal" class="btn btn-primary add_contract_button">
               Move all to past
               </button></a>
               <a id="selected-action-link-past" href="#"><button type="submit" id="move-selected-historical" data-target="#historical_selected" data-toggle="modal" class="btn btn-primary add_contract_button">
               Move selected to past
               </button></a>
            </div>
         </div>
      </div>
   </div>
   <!--start date modal starts here-->
   <div class="modal fade" id="add_start_date" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               <h4 class="modal-title custom_align" id="Heading">
                  Add start date
               </h4>
            </div>
            <div class="modal-body">
               <form class="form" id="main_input_box" action="{{ route('contractgenerate') }}" method="POST">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="form-group">
                     {!! Form::label('startdate', 'Start date: ') !!}
                     {!! Form::date('startdate', null, ['class' => 'form-control','id'=>'startdate', 'required' => 'required']) !!}
                  </div>
                  <!--<div class="alert alert-warning">
                     <span class="glyphicon glyphicon-warning-sign"></span>
                     Are you sure you want to delete this Record?
                     </div>-->
            </div>
            <div class="modal-footer ">
            <button type="submit" class="btn btn-warning">
            <span class="glyphicon glyphicon-ok-sign"></span>
            Insert
            </button>
            <button type="button" class="btn btn-warning" data-dismiss="modal">
            <span class="glyphicon glyphicon-remove"></span><?php //echo $id ?>
            Back
            </button>
            </form>
            </div>
         </div>
      </div>
   </div>
   <!-- /.modal ends here -->
   <!--end date modal starts here-->
   <div class="modal fade" id="add_end_date" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               <h4 class="modal-title custom_align" id="Heading">
                  Add end date
               </h4>
            </div>
            <div class="modal-body">
               <form class="form" id="main_input_box2" action="{{ route('contractgenerate') }}" method="POST">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="form-group">
                     {!! Form::label('enddate', 'End date: ') !!}
                     {!! Form::date('enddate', null, ['class' => 'form-control','id'=>'enddate', 'required' => 'required']) !!}
                  </div>
                  <!--<div class="alert alert-warning">
                     <span class="glyphicon glyphicon-warning-sign"></span>
                     Are you sure you want to delete this Record?
                     </div>-->
            </div>
            <div class="modal-footer ">
            <button type="submit" class="btn btn-warning">
            <span class="glyphicon glyphicon-ok-sign"></span>
            Insert
            </button>
            <button type="button" class="btn btn-warning" data-dismiss="modal">
            <span class="glyphicon glyphicon-remove"></span><?php //echo $id ?>
            Back
            </button>
            </form>
            </div>
         </div>
      </div>
   </div>
   <!-- /.modal ends here -->
   <!--end date modal starts here-->
   <div class="modal fade" id="start_date_All" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               <h4 class="modal-title custom_align" id="Heading">
                  Add Start date
               </h4>
            </div>
            <div class="modal-body">
               <form class="form" id="main_input_box2" action="{{ route('start-date-all') }}" method="POST">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="form-group">
                     {!! Form::label('startdate', 'Start date: ') !!}
                     {!! Form::date('startdate', null, ['class' => 'form-control','id'=>'startdate', 'required' => 'required']) !!}
                  </div>
                  <!--<div class="alert alert-warning">
                     <span class="glyphicon glyphicon-warning-sign"></span>
                     Are you sure you want to delete this Record?
                     </div>-->
            </div>
            <div class="modal-footer ">
            <button type="submit" class="btn btn-warning">
            <span class="glyphicon glyphicon-ok-sign"></span>
            Insert
            </button>
            <button type="button" class="btn btn-warning" data-dismiss="modal">
            <span class="glyphicon glyphicon-remove"></span><?php //echo $id ?>
            Back
            </button>
            </form>
            </div>
         </div>
      </div>
   </div>
   <!-- /.modal ends here -->
   <!--end date modal starts here-->
   <div class="modal fade" id="start_date_Selected" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               <h4 class="modal-title custom_align" id="Heading">
                  Add Start date
               </h4>
            </div>
            <div class="modal-body">
               <form class="form" id="main_input_box2" action="{{ route('start-date-selected') }}" method="POST">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="form-group">
                     {!! Form::label('startdate', 'Start date: ') !!}
                     {!! Form::date('startdate', null, ['class' => 'form-control','id'=>'startdate', 'required' => 'required']) !!}
                  </div>
                  <!--<div class="alert alert-warning">
                     <span class="glyphicon glyphicon-warning-sign"></span>
                     Are you sure you want to delete this Record?
                     </div>-->
            </div>
            <div class="modal-footer ">
            <button type="submit" class="btn btn-warning">
            <span class="glyphicon glyphicon-ok-sign"></span>
            Insert
            </button>
            <button type="button" class="btn btn-warning" data-dismiss="modal">
            <span class="glyphicon glyphicon-remove"></span><?php //echo $id ?>
            Back
            </button>
            </form>
            </div>
         </div>
      </div>
   </div>
   <!-- /.modal ends here -->
   <!--end date modal starts here-->
   <div class="modal fade" id="end_date_All" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               <h4 class="modal-title custom_align" id="Heading">
                  Add end date
               </h4>
            </div>
            <div class="modal-body">
               <form class="form" id="main_input_box2" action="{{ route('end-date-all') }}" method="POST">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="form-group">
                     {!! Form::label('enddate', 'End date: ') !!}
                     {!! Form::date('enddate', null, ['class' => 'form-control','id'=>'enddate', 'required' => 'required']) !!}
                  </div>
                  <!--<div class="alert alert-warning">
                     <span class="glyphicon glyphicon-warning-sign"></span>
                     Are you sure you want to delete this Record?
                     </div>-->
            </div>
            <div class="modal-footer ">
            <button type="submit" class="btn btn-warning">
            <span class="glyphicon glyphicon-ok-sign"></span>
            Insert
            </button>
            <button type="button" class="btn btn-warning" data-dismiss="modal">
            <span class="glyphicon glyphicon-remove"></span><?php //echo $id ?>
            Back
            </button>
            </form>
            </div>
         </div>
      </div>
   </div>
   <!-- /.modal ends here -->
   <!--end date modal starts here-->
   <div class="modal fade" id="end_date_Selected" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               <h4 class="modal-title custom_align" id="Heading">
                  Add end date
               </h4>
            </div>
            <div class="modal-body">
               <form class="form" id="main_input_box2" action="{{ route('end-date-selected') }}" method="POST">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="form-group">
                     {!! Form::label('enddate', 'End date: ') !!}
                     {!! Form::date('enddate', null, ['class' => 'form-control','id'=>'enddate', 'required' => 'required']) !!}
                  </div>
                  <!--<div class="alert alert-warning">
                     <span class="glyphicon glyphicon-warning-sign"></span>
                     Are you sure you want to delete this Record?
                     </div>-->
            </div>
            <div class="modal-footer ">
            <button type="submit" class="btn btn-warning">
            <span class="glyphicon glyphicon-ok-sign"></span>
            Insert
            </button>
            <button type="button" class="btn btn-warning" data-dismiss="modal">
            <span class="glyphicon glyphicon-remove"></span><?php //echo $id ?>
            Back
            </button>
            </form>
            </div>
         </div>
      </div>
   </div>
   <!-- /.modal ends here -->
   <!--end date modal starts here-->
   <div class="modal fade" id="historical_all" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               <h4 class="modal-title custom_align" id="Heading">
                  Add start and end date
               </h4>
            </div>
            <div class="modal-body">
               <form class="form" id="main_input_box2" action="{{ route('past-all') }}" method="POST">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="form-group">
                     {!! Form::label('startdate', 'Start date: ') !!}
                     {!! Form::date('startdate', null, ['class' => 'form-control','id'=>'startdate', 'required' => 'required']) !!}
                  </div>
                  <div class="form-group">
                     {!! Form::label('enddate', 'End date: ') !!}
                     {!! Form::date('enddate', null, ['class' => 'form-control','id'=>'enddate', 'required' => 'required']) !!}
                  </div>
                  <!--<div class="alert alert-warning">
                     <span class="glyphicon glyphicon-warning-sign"></span>
                     Are you sure you want to delete this Record?
                     </div>-->
            </div>
            <div class="modal-footer ">
            <button type="submit" class="btn btn-warning">
            <span class="glyphicon glyphicon-ok-sign"></span>
            Insert
            </button>
            <button type="button" class="btn btn-warning" data-dismiss="modal">
            <span class="glyphicon glyphicon-remove"></span><?php //echo $id ?>
            Back
            </button>
            </form>
            </div>
         </div>
      </div>
   </div>
   <!-- /.modal ends here -->
   <!--end date modal starts here-->
   <div class="modal fade" id="historical_selected" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               <h4 class="modal-title custom_align" id="Heading">
                  Add start and end date
               </h4>
            </div>
            <div class="modal-body">
               <form class="form" id="main_input_box2" action="{{ route('past-selected') }}" method="POST">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="form-group">
                     {!! Form::label('startdate', 'Start date: ') !!}
                     {!! Form::date('startdate', null, ['class' => 'form-control','id'=>'startdate', 'required' => 'required']) !!}
                  </div>
                  <div class="form-group">
                     {!! Form::label('enddate', 'End date: ') !!}
                     {!! Form::date('enddate', null, ['class' => 'form-control','id'=>'enddate', 'required' => 'required']) !!}
                  </div>
                  <!--<div class="alert alert-warning">
                     <span class="glyphicon glyphicon-warning-sign"></span>
                     Are you sure you want to delete this Record?
                     </div>-->
            </div>
            <div class="modal-footer ">
            <button type="submit" class="btn btn-warning">
            <span class="glyphicon glyphicon-ok-sign"></span>
            Insert
            </button>
            <button type="button" class="btn btn-warning" data-dismiss="modal">
            <span class="glyphicon glyphicon-remove"></span><?php //echo $id ?>
            Back
            </button>
            </form>
            </div>
         </div>
      </div>
   </div>
   <!-- /.modal ends here -->
</section>
<!-- content -->
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
<script type="text/javascript" src="{{ asset('assets/vendors/moment/js/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendors/datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
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
               url: "{{ action('FrontEndController@employeesdata') }}",
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
           ]
       });
   
       $('.search-input-text').on( 'keyup click', function () {   // for text boxes
       var i =$(this).attr('data-column');  // getting column index
       var v =$(this).val();  // getting search input value
       table5.columns(i).search(v).draw();
       } );
       $('.search-input-select').on( 'change', function () {   // for select box
       var i =$(this).attr('data-column');
       var v =$(this).val();
       table5.columns(i).search(v).draw();
      } );
   
      table5.columns(5).search('Pending').draw();
      $(".search-input-select").val("Pending");
   });
   
   $("#employees").addClass("active");
   
   
   $('#add_start_date').on('show.bs.modal', function(event) {
        //$("#cafeId").val($(event.relatedTarget).data('id'));
        //alert($(event.relatedTarget).data('employeeid'));
        $('#main_input_box').attr('action','add-start-date/'+$(event.relatedTarget).data('employeeid'))
    });
   
     $('#add_end_date').on('show.bs.modal', function(event) {
        $('#main_input_box2').attr('action','add-end-date/'+$(event.relatedTarget).data('employeeid'))
    });
   
   
   /*$('.global-checkbox').change( function() {
    if($(this).is(':checked'))
          { 
              //check all the checkboxes 
              $('[data-checkboxid=41]').prop("checked", true);
   
           }else{
               //uncheck all the checkboxes 
               $('[data-checkboxid=41]').prop("checked", false);
           }
   });*/
   $('#all-action-button').hide();
   $('#move-all-historical').hide();

   $('.search-input-select').change( function() {
      var filter = $(this).val();
   
      if(filter == 'Pending'){
          $('#selected-action-button').show();
          $('#all-action-button').hide();
          $('#all-action-button').parent().unbind('click');
          $('#selected-action-button').parent().unbind('click');
          $('#all-action-button').text('Move all to contract');
          $('#selected-action-button').text('Move selected to contract');
          $('#all-action-button').attr('data-target', '');
          $('#selected-action-button').attr('data-target', '');
          $('#move-all-historical').hide();
          $('#move-selected-historical').show();
          $('#move-all-historical').text('Move all to past');
          $('#move-selected-historical').text('Move selected to past');
          $('#all-action-link').prop('disabled', false); 
          $('#selected-action-link').prop('disabled', false); 
           $('#all-action-link-past').attr('href', '#'); 
          $('#selected-action-link-past').attr('href', '#'); 
          $('#move-all-historical').attr('data-toggle', 'modal');
          $('#move-all-historical').attr('data-target','#historical_all');
          $('#move-selected-historical').attr('data-toggle', 'modal');
          $('#move-selected-historical').attr('data-target','#historical_selected');
   
          $('#all-action-link').attr('href', './move-all-to-contract');
          $('#selected-action-link').attr('href', './move-selected-to-contract');
   
          $('.checkbox-select-all').data("checkboxall", "0");
          $('.checkbox-select-all').prop('checked', false);
      }
      if(filter == 'No start date'){
          $('#selected-action-button').show();
          $('#all-action-button').show();
          $('#all-action-button').text('Add one start date to all');
          $('#all-action-button').parent().click(function (event) {event.preventDefault()});
          $('#selected-action-button').text('Add start date to selected');
          $('#selected-action-button').parent().click(function (event) {event.preventDefault()});
          $('#all-action-button').attr('data-target', '#start_date_All');
          $('#selected-action-button').attr('data-target', '#start_date_Selected');
          $('#all-action-button').attr('data-toggle', 'modal');
          $('#selected-action-button').attr('data-toggle', 'modal');
          $('#all-action-link').prop('disabled', true); 
          $('#selected-action-link').prop('disabled', true); 
          $('#move-all-historical').hide();
          $('#move-selected-historical').hide();
          $('#all-action-link').attr('href', './#');
          $('#selected-action-link').attr('href', './#');
   
          $('.checkbox-select-all').data("checkboxall", "1");
          $('.checkbox-select-all').prop('checked', false);
          //alert($('.checkbox-select-all').data("checkboxall"));
      }
      if(filter == 'Active'){
          $('#selected-action-button').show();
          $('#all-action-button').show();
          $('#all-action-button').text('Add one end date to all');
          $('#selected-action-button').text('Add end date to selected');
          $('#all-action-button').attr('data-target', '');
          $('#selected-action-button').attr('data-target', '');
          $('#all-action-button').parent().click(function (event) {event.preventDefault()});
          $('#selected-action-button').parent().click(function (event) {event.preventDefault()});
          $('#all-action-button').attr('data-toggle', 'modal');
          $('#selected-action-button').attr('data-toggle', 'modal');
          $('#all-action-button').attr('data-target', '#end_date_All');
          $('#selected-action-button').attr('data-target', '#end_date_Selected');
          $('#move-all-historical').hide();
          $('#move-selected-historical').hide();
          $('#all-action-link').attr('href', './#');
          $('#selected-action-link').attr('href', './#');
   
          $('.checkbox-select-all').data("checkboxall", "2");
          $('.checkbox-select-all').prop('checked', false);
      }
      if(filter == 'Expired'){
          $('#all-action-button').parent().unbind('click');
          $('#selected-action-button').parent().unbind('click');
           $('#all-action-link').prop('disabled', false); 
          $('#selected-action-link').prop('disabled', false); 
          $('#all-action-button').text('Delete all');
          $('#selected-action-button').text('Delete selected');
          $('#all-action-button').attr('data-target', '');
          $('#selected-action-button').attr('data-target', '');
          $('#move-all-historical').hide();
          $('#move-selected-historical').hide();
          $('#all-action-link').attr('href', './delete-all-employees');
          $('#selected-action-link').attr('href', './delete-selected-employees');
          $('#selected-action-button').hide();
          $('#all-action-button').show();
   
          $('.checkbox-select-all').data("checkboxall", "3");
          $('.checkbox-select-all').prop('checked', false);
      }
      if(filter == 'Past employee'){
          $('#all-action-button').parent().unbind('click');
          $('#selected-action-button').parent().unbind('click');
           $('#all-action-link').prop('disabled', false); 
          $('#selected-action-link').prop('disabled', false); 
          $('#all-action-button').parent().click(function (event) {event.preventDefault()});
          $('#selected-action-button').parent().click(function (event) {event.preventDefault()});
          $('#all-action-button').text('Delete all');
          $('#selected-action-button').text('Delete selected');
          $('#all-action-button').attr('data-target', '');
          $('#selected-action-button').attr('data-target', '');
   
          $('#move-all-historical').hide();
          $('#move-selected-historical').show();
          $('#move-all-historical').text('Move all back to pending');
          $('#move-selected-historical').text('Move selected back to pending');
   
          $('#move-all-historical').attr('data-toggle', '');
          $('move-all-historical').attr('data-target','');
          $('#move-selected-historical').attr('data-toggle', '');
          $('#move-selected-historical').attr('data-target','');
   
          $('#all-action-link-past').attr('href', './back-pending-all'); 
          $('#selected-action-link-past').attr('href', './back-pending-selected');
   
          $('#all-action-link').attr('href', './delete-all-historical');
          $('#selected-action-link').attr('href', './delete-selected-historical');
          $('#all-action-button').hide();
          $('#selected-action-button').hide();
   
          $('.checkbox-select-all').data("checkboxall", "4");
          $('.checkbox-select-all').prop('checked', false);
   
          /*$('#all-action-button').attr('data-target', '');
          $('#selected-action-button').attr('data-target', '');*/
      }
   
   
   });
   
       var checkedAll = -1;
   
   $('.checkbox-select-all').change(function() {
       var checkbox_class = $('.checkbox-select-all').data("checkboxall");
        if($(this).is(":checked")) {
            //alert($('.checkbox-select-all').data("checkboxall"));
            $("input[data-boxclass='" + checkbox_class +"']").prop('checked', true);
   
        checkedAll = $(this).data('checkboxall');
        console.log(checkedAll);
            
        }else{
            //uncheck the checkboxes
            $("input[data-boxclass='" + checkbox_class +"']").prop('checked', false);
   
            var value = $(this).data('checkboxall');
            checkedAll = -1;
            console.log(checkedAll);
        }
   
        //check the checkboxes
            var sendData2 = 'checkedAll=' + checkedAll;
             $.ajax({
                      url: 'checkedAll',
                        type: "GET",
                        data: sendData2,
                        success: function (data) {
                            //alert('ids stored');
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                           // alert(thrownError);
                        }
              })
   
    });
   
    /*$('.checkbox-select').change( function() {
        alert("item selected");
    });*/
    var checkedids = [];
    var uncheckedId = 0;
   
    //set the stored ids to empty 
    $.ajax({
                      url: 'checkedids',
                        type: "GET",
                        data: sendData,
                        success: function (data) {
                            //alert('ids stored');
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                           // alert(thrownError);
                        }
    });
    $(document).on('click', '.checkbox-select', function (e) {
        //alert($(this).data('checkboxid'));
        //testcount++;
        if($(this).is(':checked')){
        checkedids.push($(this).data('checkboxid'));
        console.log(checkedids);
    }else{
        var value = $(this).data('checkboxid');
        uncheckedId = $(this).data('checkboxid');
            checkedids = checkedids.filter(function(item) { 
                return item !== value;
            });
            console.log(checkedids);
        }
   
           var sendData = 'checkedids=' + checkedids + '&uncheckedId=' + uncheckedId;
             $.ajax({
                      url: 'checkedids',
                        type: "GET",
                        data: sendData,
                        success: function (data) {
                            //alert('ids stored');
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                           // alert(thrownError);
                        }
    })
    })
   
    //reseting the session
    var sendData = 'checkedids=' + checkedids;
             $.ajax({
                      url: 'checkedids',
                        type: "GET",
                        data: sendData,
                        success: function (data) {
                            //alert('ids stored');
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                           // alert(thrownError);
                        }
    })
   
    var sendData2 = 'checkedAll=' + checkedAll;;
     $.ajax({
                      url: 'checkedAll',
                        type: "GET",
                        data: sendData2,
                        success: function (data) {
                            //alert('ids stored');
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                           // alert(thrownError);
                        }
    })
   
</script>
<!--end of custom datatables-->
@stop