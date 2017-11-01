@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Members List
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/vendors/datatables/css/dataTables.bootstrap.css') }}"/>
    <link href="{{ asset('assets/css/pages/tables.css') }}" rel="stylesheet" type="text/css"/>
    <style>
       td {
   border-right: solid 1px #ee6f00; 
   border-left: solid 1px #ee6f00;
   border-top: solid 1px #4CAF50; 
   border-bottom: solid 1px #4CAF50;
   }
   table, .search-input-text {
   table-layout:fixed;
   }

   input[type=search] {
       width: 100%;
       }

       input[type=date] {
       width: 100%;
       height:25px;
       }

       select {
       width: 100%;
       }
    </style>
@stop


{{-- Page content --}}
@section('content')
    <section class="content-header">
        <h1>Members</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                    Dashboard
                </a>
            </li>
            <li class="active">Members</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content paddingleft_right15">
        <div class="row">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#fff"
                           data-hc="white"></i>
                        Members List
                    </h4>
                </div>
                <br/>
                <div class="panel-body">
                    <table class="table table-bordered" id="table">
                    <thead>
                        <tr class="filters">
                            <th>Advanced Search: </th>
                            <th><input type="search" data-column="1"  class="search-input-text"></th>
                            <th><input type="search" data-column="2"  class="search-input-text"></th>
                            <th><select data-column="3" class="search-input-text"><option value=""></option>@foreach($countries as $country) @if($country !== "Select Country")<option value="{{ $country }}">{{ $country }}</option>@endif @endforeach</select></th>
                            <th><select data-column="4" class="search-input-text"><option value=""></option>@foreach($packages as $package)<option value="{{ $package->name }}">{{ $package->name }}</option> @endforeach</select></th>
                            <th><select data-column="5" class="search-input-text"><option value=""></option><option value="Monthly">Monthly</option><option value="Yearly">Yearly</option></select></th>
                            <th>Click title to sort</th>
                            <th><input type="search" data-column="7"  class="search-input-text"></th>
                            <th><input type="search" data-column="8"  class="search-input-text"></th>
                            <th><input type="search" data-column="9"  class="search-input-text"></th>
                            <th><input type="date" data-column="10"  class="search-input-date"></th>
                            <th></th>
                        </tr>
                        <tr class="filters">
                            <th>Id</th>
                            <th>Acc #</th>
                            <th>Company Name</th>
                            <th>Country</th>
                            <th>Package</th>
                            <th>Period</th>
                            <th>Company Verified</th>
                            <th>Status</th>
                            <th>Admins</th>
                            <th>Active Users</th>
                            <th>Joined</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/jquery.dataTables.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.bootstrap.js') }}"></script>

    <script>
      $(function () {
        var table = $('#table').DataTable({
          processing: true,
          serverSide: true,
          'pageLength': 100,
          order: [[0, 'desc']],
          ajax: '{!! route('admin.users.data') !!}',
          columns: [
            {data: 'id', name: 'id'},
            {data: 'acc_no', name: 'acc_no'},
            {data: 'companyname', name: 'companyname'},
            {data: 'country', name: 'country'},
            {data: 'package', name: 'package'},
            {data: 'period', name: 'period'},
            {data: 'verified_html', name: 'verified_html'},
            {data: 'pay_status', name: 'pay_status'},
            {data: 'admins_avail', name: 'admins_avail'},
            {data: 'employees_avail', name: 'employees_avail'},
            {data: 'created_at', name:'created_at'},
            {data: 'actions', name: 'actions', orderable: false, searchable: false}
          ]
        })
        table.on('draw', function () {
          $('.livicon').each(function () {
            $(this).updateLivicon()
          })
        });

        $('.search-input-text').on( 'keyup click', function () {   // for text boxes
       var i =$(this).attr('data-column');  // getting column index
       var v =$(this).val();  // getting search input value
       table.columns(i).search(v).draw();
       } );
       $('.search-input-select').on( 'change', function () {   // for select box
       var i =$(this).attr('data-column');
       var v =$(this).val();
       table.columns(i).search(v).draw();
      } );

      $('.search-input-date').on( 'change', function () {   // for select box
          //alert($(this).val());
       var i =$(this).attr('data-column');
       var v =$(this).val();
       table.columns(i).search(v).draw();
      } );

      })

    </script>


    <div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="user_delete_confirm_title"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content"></div>
        </div>
    </div>
    <script>
      $(function () {
        $('body').on('hidden.bs.modal', '.modal', function () {
          $(this).removeData('bs.modal')
        })
      })
    </script>
@stop
