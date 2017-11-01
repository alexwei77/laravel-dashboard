<?php 
//Check if the user has bought any package 
    use App\User;
    use Illuminate\Support\Facades\DB;

    $user = Sentinel::getUser();
    $subscriptionCheck = DB::table('dmmx_paysubscriptions')->where('userid', $user->id)->get();

     $checkIfAdmin = DB::table('dmmx_admins_table')->where([['email', $user->email],['status', 'Active']])->get();

     //if the user is supporting admin, grab the subscriptionPackageDAta from the super admin account
        if(count($checkIfAdmin) > 0){
            $adminRow = DB::table('dmmx_admins_table')->where('email', $user->email)->first();
            $subscriptionCheck = DB::table('dmmx_paysubscriptions')->where('userid',$adminRow->userid )->get();
        }

?>
<ul id="menu" class="page-sidebar-menu">
   <li id="overview" {!! (Request::is('dashboard') ? 'class="active"' : '') !!}>
      <a href="{{ route('dashboard') }}">
      <i class="livicon" data-name="barchart" data-size="18" data-c="#6CC66C" data-hc="#ee6f00"
         data-loop="true"></i>
      <span class="title">Dashboard</span>
      <span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="right" title="A summary of user (employees and candidates) activity for the year"></span>
      </a>
   </li>
   @if(count($subscriptionCheck) > 0)
   <li id="my-account">
      <a href="{{ URL::to('my-account') }}">
      <i class="livicon" data-name="home" data-size="18" data-c="#6CC66C" data-hc="#ee6f00"
         data-loop="true"></i>
      <span class="title">My Account</span>
      <span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="right" title="View or update member(employer) account details "></span>
      </a>
   </li>
   <li {!! (Request::is('myemployees') || Request::is('loademployees') ? 'class="active"' : '') !!}>
      <a href="{{ URL::to('myemployees') }}">
      <i class="livicon" data-name="users" data-size="18" data-c="#6CC66C" data-hc="#ee6f00"
         data-loop="true"></i>
      <span class="title">Users</span>
      <span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="right" title="Add, view or manage users (employees and candidates)"></span>
      <span class="fa arrow"></span>
      </a>
      <ul class="sub-menu">
         <li {!! (Request::is('myemployees') ? 'class="active"' : '') !!}>
         <a href="{{ URL::to('myemployees') }}">
         <i class="fa fa-angle-double-right"></i>
          Users List
         </a>
         </li>
         @if(count($checkIfAdmin) == 0)
         <li {!! (Request::is('loademployees') ? 'class="active"' : '') !!}>
         <a href="{{ URL::to('loademployees') }}">
         <i class="fa fa-angle-double-right"></i>
          Add New User
         </a>
         </li>
         @endif
      </ul>
   </li>
   @endif
   @if(count($subscriptionCheck) == 0)
   <li id="subscribe">
      <a href="{{ URL::to('subscribe', 'default') }}">
      <i class="livicon" data-name="users" data-size="18" data-c="#418BCA" data-hc="#ee6f00"
         data-loop="true"></i>
      <span class="title">Subscribe</span>
      <span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="right" title="Select your subscription"></span>
      </a>
   </li>
   @endif
   <!--<li id="generate-contract">
      <a href="{{ URL::to('contractgenerate') }}">
          <i class="livicon" data-name="users" data-size="18" data-c="#418BCA" data-hc="#418BCA"
             data-loop="true"></i>
          <span class="title">Generate Contract</span>
      </a>
      </li>-->
   <!--<li id="consent-management">
      <a href="{{ URL::to('consentmanagement') }}">
          <i class="livicon" data-name="move" data-c="#ef6f6c" data-hc="#ef6f6c" data-size="18"
             data-loop="true"></i>
          <span class="title">Consent Management</span>
      </a>
      </li>-->
   <!--<li id="create-rating">
      <a href="{{ URL::to('create-rating') }}">
      <i class="livicon" data-name="move" data-c="#ef6f6c" data-hc="#ef6f6c" data-size="18"
         data-loop="true"></i>
      <span class="title">Create Rating</span>
      </a>
   </li>-->
  @if(count($subscriptionCheck) > 0)
   @if(count($checkIfAdmin) == 0)
   <li {!! (Request::is('admins') || Request::is('invite') ? 'class="active"' : '') !!}>
      <a href="{{ URL::to('admins') }}">
      <i class="livicon" data-name="gears" data-size="18" data-c="#6CC66C" data-hc="#ee6f00"
         data-loop="true"></i>
      <span class="title">Admins</span>
      <span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="right" title="Add, view or manage account administrators "></span>
      <span class="fa arrow"></span>
      </a>
      <ul class="sub-menu">
         <li {!! (Request::is('admins') ? 'class="active"' : '') !!}>
         <a href="{{ URL::to('admins') }}">
         <i class="fa fa-angle-double-right"></i>
         Admins
         </a>
         </li>
         <li {!! (Request::is('invite') ? 'class="active"' : '') !!}>
         <a href="{{ URL::to('invite') }}">
         <i class="fa fa-angle-double-right"></i>
         Add New Admin
         </a>
         </li>
      </ul>
   </li>
   <!--<li id="create-rating" {!! (Request::is('loademployees') ? 'class="active"' : '') !!}>
      <a href="{{ URL::to('loademployees') }}">
      <i class="livicon" data-name="users-add" data-c="#6CC66C" data-hc="#ee6f00" data-size="18"
         data-loop="true"></i>
      <span class="title">Load prospects</span>
      </a>
   </li>-->
   @if(count($user->subscriptions)!==0)
   <li id="create-rating" {!! (Request::is('upgrade-downgrade') ? 'class="active"' : '') !!}>
      <a href="{{ URL::to('upgrade-downgrade') }}">
      <i class="livicon" data-name="arrow-circle-up" data-c="#6CC66C" data-hc="#ee6f00" data-size="18"
         data-loop="true"></i>
      <span class="title">Upgrade</span>
      <span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="right" title="Change your subscription package"></span>
      </a>
   </li>
   @endif
   @endif
   @endif
   <!-- <li {!! (Request::is('helpcenter/history') || Request::is('helpcenter/compose') || Request::is('helpcenter/view_message') ? 'class="active"' : '') !!}>
      <a href="#">
          <i class="livicon" data-name="mail" data-size="18" data-c="#67C5DF" data-hc="#67C5DF"
             data-loop="true"></i>
          <span class="title">Help Center</span>
          <span class="fa arrow"></span>
      </a>
      <ul class="sub-menu">
          <li {!! (Request::is('helpcenter/history') ? 'class="active"' : '') !!}>
              <a href="{{ URL::to('helpcenter/history') }}">
                  <i class="fa fa-angle-double-right"></i>
                  History
              </a>
          </li>
          <li {!! (Request::is('helpcenter/compose') ? 'class="active"' : '') !!}>
              <a href="{{ URL::to('helpcenter/compose') }}">
                  <i class="fa fa-angle-double-right"></i>
                  Ask Question
              </a>
          </li>
          <li {!! (Request::is('helpcenter/view_message') ? 'class="active"' : '') !!}>
              <a href="{{ URL::to('helpcenter/view_message') }}">
                  <i class="fa fa-angle-double-right"></i>
                  Single Mail
              </a>
          </li>-->
    @if(count($subscriptionCheck) > 0)
    @if(count($checkIfAdmin) == 0)
   <li {!! (Request::is('verify-company') ? 'class="active"' : '') !!}>
      <a href="{{ URL::to('verify-company') }}">
      <i class="livicon" data-name="check-circle" data-c="#6CC66C" data-hc="#ee6f00" data-size="18"
         data-loop="true"></i>
      <span class="title">Verify Company</span>
      <span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="right" title="Upload verification documents. This is required to view or update profiles of users (employees and candidates)"></span>
      </a>
   </li>
   @endif
   @endif
   @if(count($user->subscriptions)==0)
   @if(count($checkIfAdmin) == 0)
    <li {!! (Request::is('gpremium') ? 'class="active"' : '') !!}>
      <a href="{{ route('pay-package') }}">
      <i class="livicon" data-name="star-full" data-c="#6CC66C" data-hc="#ee6f00" data-size="18"
         data-loop="true"></i>
      <span class="title">Subscribe Now</span>
      <span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="right" title="Select your subscription"></span>
      </a>
   </li>
   @endif
   @endif
   <li {!! (Request::is('settings') ? 'class="active"' : '') !!}>
      <a href="{{ route('settings') }}">
      <i class="livicon" data-name="gear" data-c="#6CC66C" data-hc="#ee6f00" data-size="18"
         data-loop="true"></i>
      <span class="title">Settings</span>
      <span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="right" title="Manage your account settings"></span>
      </a>
   </li>

    @if(count($user->subscriptions)!==0)
    @if(count($checkIfAdmin) == 0)
    <li {!! (Request::is('redeem-voucher') || Request::is('vouchers') ? 'class="active"' : '') !!}>
      <a href="{{ URL::to('redeem-voucher') }}">
      <i class="livicon" data-name="gift" data-size="18" data-c="#6CC66C" data-hc="#ee6f00"
         data-loop="true"></i>
      <span class="title">Redeem Voucher</span>
      <span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="right" title="Redeem your vouchers"></span>
         </a>
         </li>
   @endif
   @endif

</ul>
</li>
<!--<li id="admins">
   <a href="{{ URL::to('admins') }}">
       <i class="livicon" data-name="users" data-size="18" data-c="#418BCA" data-hc="#418BCA"
          data-loop="true"></i>
       <span class="title">Groups</span>
   </a>
   </li>-->
<!--<li>
   <a href="{{ URL::to('verifyaccount') }}">
       <i class="livicon" data-name="flag" data-c="#418bca" data-hc="#418bca" data-size="18"
          data-loop="true"></i>
       <span class="title">Employee Verification</span>
   </a>
   </li>-->
<!-- Menus generated by CRUD generator -->
@include('admin/layouts/menu')
</ul>