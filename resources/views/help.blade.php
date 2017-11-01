<?php $og = new OpenGraph(); 
$og->title('Help - StaffLife.com')
        ->image("")
        ->description("Need some help getting started on StaffLife? Our Help section covers a wide range of topics, assisting you in getting the most out of your StaffLife account.")
        ->url();
?>
<!DOCTYPE html>
<html lang="en">
<head>
{!! $og->renderTags() !!}
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Need some help getting started on StaffLife? Our Help section covers a wide range of topics, assisting you in getting the most out of your StaffLife account.">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
  @include('layouts/csp')
</head>

@extends('layouts/defaultboth')

{{-- Page title --}}
@section('title')
    Support
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <!--start of page level css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/help.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/indexboth.css') }}">
    <!--end of page level css-->
    <style>

        body {
            margin-top:-20px;
        }

       @media screen and (max-width:530px) {
           .nav-tabsb {
               border-bottom: 0;
               margin-bottom: 0 !important;
           }
       }
     
/*style for vertical tabs start */
    * {box-sizing: border-box}
    body {font-family: "Open Sans", sans-serif;}

/* Style the tab */
    div.tab {
        float: left;
        background-color: #ffffff;
        width: 30%;
    }

/* Style the buttons inside the tab */
    div.tab button {
        display: block;
        background-color: inherit;
        padding: 10px 16px;
        width: 100%;
        border: none;
        outline: none;
        text-align: left;
        cursor: pointer;
        transition: 0.3s;
    }

/* Change background color of buttons on hover */
    div.tab button:hover {
        background-color: #4CAF50;
        color:#ffffff;
    }

/* Create an active/current "tab button" class */
    div.tab button.active {
        background-color: #4CAF50;
        color:#ffffff;
    }

/* Style the tab content */
    .tabcontent {
        float: left;
        padding: 0px 12px;
        width: 70%;
        border-left: none;
        min-height: 650px;
        max-height:100%;
        background-color:#ffffff;
    }

/*Style for vertical tabs END */

@media screen and (max-width:767px) {
    .deskhelp {
        display:none;
    }
} 

@media screen and (min-width:768px) {
    .mobhelp {
        display:none;
    }
} 

@media screen and (max-width:767px) {
    .nav-tabs>li.active>a, .nav-tabs>li.active>a:hover {
        color: #fff;
        cursor: default;
        background-color: #4caf50;
        border: 1px solid #ddd;
        border-bottom-color: transparent;
    }
} 
    </style>
@stop


{{-- Page content --}}
@section('content')
<!-- Container Section Start -->
<div class="font-open-sans">
    <div class="jumbotext text-center">
        <h1>Help</h1>
    </div>
        
        
    <!-- Desktop Version -->
    <div class="deskhelp">
        <!-- FAQ Section Start -->
        <div class="container" style="padding-top:50px !important;">
    
            <ul class="navb nav-tabsb" style="padding-bottom:10px;">
                <li id="employer_tab" class="active"><a data-toggle="tab" href="#home">Employers Using StaffLife</a></li>
                <li id="employee_tab"><a data-toggle="tab" href="#menu1">Employees Using StaffLife</a></li>
            </ul>
        </div>
        
        <div class="container marbottom" style="padding-top:20px !important; padding-bottom:20px;">
            <div class="tab-content" id="help">
            
    <!-- Employer section Start -->
                <div id="home" class="tab-pane fade in active">
                    <div class="container addpadf">
                    
                    
                        <div class="content">                    
                            <!-- Vertical Tab Menu Start -->
                            <div class="tab">
                                <button class="tablinks" onclick="openCity(event, '1')" id="defaultOpen">Joining StaffLife</button>
                                <button class="tablinks" onclick="openCity(event, '2')">Account Settings</button>
                                <button class="tablinks" onclick="openCity(event, '3')">Adding Employees</button>
                                <button class="tablinks" onclick="openCity(event, '4')">Managing your Employees</button>
                                <button class="tablinks" onclick="openCity(event, '5')">Updating Employee Profiles</button>
                                <button class="tablinks" onclick="openCity(event, '6')">Candidate Searches</button>
                                <button class="tablinks" onclick="openCity(event, '7')">Credits</button>
                                <button class="tablinks" onclick="openCity(event, '8')">Trouble Logging In</button>
                            </div>
                            <!-- Vertical Tab Menu END -->
                            
    <!-- 1st batch questions Section -->
                            <div id="1" class="tabcontent">
                                <div class="col-sm-12" style="background-color: #f4f4f4; padding-top: 20px; padding-bottom: 30px;">
                                    <div id="join">
                                        <div class="addpadf">
            
                                            <div class="panel-group" id="faqAccordion">
                
                
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordion" data-target="#step0">
                                                        <p class="faqtextbigb"><a href="#step0" class="ing">Getting started</a></p>
                                                    </div>
                                                    <div id="step0" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">To start using StaffLife, you will need to select the option on our pricing page that best suits your organisation's size. Once you have registered, you are able to start adding your Employees to your account and looking up Profiles of candidates that have applied to join your organisation.</p>
                                                        </div>
                                                    </div>
                                                </div>
                    
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordion" data-target="#step1">
                                                        <p class="faqtextbigb"><a href="#step1" class="ing">Choosing a membership package</a></p>
                                                    </div>
                                                    <div id="step1" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">Your ideal package will be determined by the number of Employees within your {{ __('help.organisation') }}, as well as the number of candidate Profiles you will look up on average per month. It is important that all Employees are added under your Profile, in order to fully reap the benefits of the StaffLife system.</p>
                                                        </div>
                                                    </div>
                                                </div>
                    
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordion" data-target="#step2">
                                                        <p class="faqtextbigb"><a href="#step2" class="ing">Creating your account</a></p>
                                                    </div>
                                                    <div id="step2" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">Creating your account is quick and easy, and can be done here. In order to create your account, you will need to enter the name, surname and email address of the account administrator. Once your account has been created and payment has been made, you will verify your company by submitting either your {{ __('help.incorporationdocs') }}, an invoice or a {{ __('help.utilitybill') }}. Once verified, you are able to add your Employees to the StaffLife system.</p>
                                                        </div>
                                                    </div>
                                                </div>
                    
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordion" data-target="#step3">
                                                        <p class="faqtextbigb"><a href="#step3" class="ing">Company verification</a></p>
                                                    </div>
                                                    <div id="step3" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">In order to verify your company, it is required that you submit your{{ __('help.incorporationdocs') }}, and either an invoice or {{ __('help.utilitybill') }}. Verification is done within your Profile, by clicking Verify Company on the left-hand menu.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
    <!-- 2nd batch questions Section -->
                            <div id="2" class="tabcontent">
                                <div class="col-sm-12" style="background-color: #f4f4f4; padding-top: 20px; padding-bottom: 30px;">
                                    <div id="admin_settings">
                                        <div class="addpadf">
                                            <div class="panel-group" id="faqAccordion2">
                
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordion2" data-target="#step4">
                                                        <p class="faqtextbigb"><a href="#step4" class="ing">Logging into your account</a></p>
                                                    </div>
                                                    <div id="step4" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">In order to log in, <a style="text-decoration: underline;" href="{{ URL::to('login') }}">click here</a>. You will log in using the email address and password used to create your account. For trouble logging in, <a style="text-decoration: underline;" href="{{ URL::to('forgot-password') }}">click here</a>.</p>
                                                        </div>
                                                    </div>
                                                </div>
                    
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordion2" data-target="#step5">
                                                        <p class="faqtextbigb"><a href="#step5" class="ing">Changing account settings</a></p>
                                                    </div>
                                                    <div id="step5" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">Your account settings may be changed by clicking the My Account option on the left-hand menu. To access your account settings, <a style="text-decoration: underline;" href="{{ URL::to('login') }}">click here</a>.</p>
                                                        </div>
                                                    </div>
                                                </div>
                    
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordion2" data-target="#step6">
                                                        <p class="faqtextbigb"><a href="#step6" class="ing">Cancellation</a></p>
                                                    </div>
                                                    <div id="step6" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">You may cancel your membership at any time, subject to our <a style="text-decoration: underline;" href="{{ URL::to('terms-and-conditions') }}">cancellation terms</a>.</p>
                                                        </div>
                                                    </div>
                                                </div>
                    
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordion2" data-target="#step7">
                                                        <p class="faqtextbigb"><a href="#step7" class="ing">Deactivating your account</a></p>
                                                    </div>
                                                    <div id="step7" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">You may deactivate your account at any time, by selecting Deactivate My Account in the My Account option on the left-hand menu.</p>
                                                        </div>
                                                    </div>
                                                </div>
                    
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordion2" data-target="#step8">
                                                        <p class="faqtextbigb"><a href="#step8" class="ing">Reactivating your account</a></p>
                                                    </div>
                                                    <div id="step8" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">You may reactivate your account at any time by logging in and selecting Reactivate My Account in the My Account option on the left-hand menu.</p>
                                                        </div>
                                                    </div>
                                                </div>
                    
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordion2" data-target="#step9">
                                                        <p class="faqtextbigb"><a href="#step9" class="ing">Changing membership packages</a></p>
                                                    </div>
                                                    <div id="step9" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">You can easily change your membership option once you are logged in, by selecting the Upgrade option on the left-hand menu.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
    <!-- 3rd batch questions Section -->
                            <div id="3" class="tabcontent">
                                <div class="col-sm-12" style="background-color: #f4f4f4; padding-top: 20px; padding-bottom: 30px;">
                                    <div id="adding_employees">
                                        <div class="addpadf">
                                            <div class="panel-group" id="faqAccordion3">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordion3" data-target="#step10">
                                                        <p class="faqtextbigb">
                                                            <a href="#step10" class="ing">Generating a SLIP</a>
                                                        </p>
                                                    </div>
                                                    <div id="step10" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">In order to add an Employee, you are required to generate a SLIP, which must then besigned by the Employee in question to confirm that they have given their consent.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordion3" data-target="#step11">
                                                        <p class="faqtextbigb"><a href="#step11" class="ing">Information required to add an Employee</a></p>
                                                    </div>
                                                    <div id="step11" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">In order to generate a SLIP, you must enter the following information for an Employee: full name, ID number and personal email address. </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordion3" data-target="#step12">
                                                        <p class="faqtextbigb"><a href="#step12" class="ing">Obtaining consent from Employees</a></p>
                                                    </div>
                                                    <div id="step12" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">Before you are entitled to add information to the Profile of an Employee, you must have them sign their uniquely generated SLIP. Once generated, the SLIP must be printed and presented to the Employee for signature. A signed copy of the SLIP must be retained for your records. </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordion3" data-target="#step13">
                                                        <p class="faqtextbigb"><a href="#step13" class="ing">Adding an Employee's Profile</a></p>
                                                    </div>
                                                    <div id="step13" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">To add an Employee, you will need to log in and click Employees on the left-hand menu, and from the drop-down select Add New. This will allow you to generate a SLIP for the Employee you are adding, by entering their full name, {{ __('help.idnumber') }} and personal email address. Once the SLIP has been signed by the Employee and you have confirmed this on the system, your Employee's Profile will be ready for reviews and information to be added. </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><p class="soylent_green"></p>
                                    </div>
                                </div>
                            </div>
                            
                            
    <!-- 4th batch questions Section -->
                            <div id="4" class="tabcontent">
                                <div class="col-sm-12" style="background-color: #f4f4f4; padding-top: 20px; padding-bottom: 30px;">
                                    <div id="admin_settings">
                                        <div class="addpadf">
                                            <div class="panel-group" id="faqAccordion4">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordion4" data-target="#step14">
                                                        <p class="faqtextbigb"><a href="#step14" class="ing">Adding information to an Employee's Profile</a></p>
                                                    </div>
                                                    <div id="step14" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">Once you have obtained a signed SLIP, you may start adding reviews and information to your Employee's Profile. The information is split into subjective (Performance) and objective (Basics & Ethics) sections. These sections should be completed once an Employee has been added, and should be updated on a regular basis. </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordion4" data-target="#step15">
                                                        <p class="faqtextbigb"><a href="#step15" class="ing">Adding the start date of an Employee</a></p>
                                                    </div>
                                                    <div id="step15" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">In order to add information to an Employee's Profile, you will need to add their start date. The start date is the date upon which the Employee commenced employment with your {{ __('help.organisation') }}.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordion4" data-target="#step16">
                                                        <p class="faqtextbigb"><a href="#step16" class="ing">Adding the end date of an Employee</a></p>
                                                    </div>
                                                    <div id="step16" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">Once an Employee is no longer with your {{ __('help.organisation') }}, you will need to add their end date. The end date is the date upon which the employment was effectively terminated (by either party). If you do not enter the end date, an additional credit will be used on a monthly basis in respect of this Employee. </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
    <!-- 5th batch questions Section -->
                            <div id="5" class="tabcontent">
                                <div class="col-sm-12" style="background-color: #f4f4f4; padding-top: 20px; padding-bottom: 30px;">
                                    <div id="admin_settings">
                                        <div class="addpadf">
                                            <div class="panel-group" id="faqAccordion5">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                    data-toggle="collapse" data-parent="#faqAccordion5"
                                                    data-target="#step17">
                                                        <p class="faqtextbigb">
                                                            <a href="#step17" class="ing">Employee Profile sections</a>
                                                        </p>

                                                    </div>
                                                    
                                                    
                                                    <div id="step17" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">The Employee Profile is split into two sections: Basics & Ethics and Performance. The Basics & Ethics section contains objective and verifiable information relating to an Employee, such as labour dispute referrals, disciplinary measures taken, promotions etc. The Performance section contains subjective ratings of an Employee, and includes a self-rating by the Employee. The Employee may access their Profile, and view the information that has been added by you (and previous Members) in each section respectively.  </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                    data-toggle="collapse" data-parent="#faqAccordion5"
                                                    data-target="#step18">
                                                        <p class="faqtextbigb">
                                                            <a href="#step18" class="ing">Ethics & Basics section</a>
                                                        </p>

                                                    </div>
                                                    
                                                    
                                                    <div id="step18" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">This section contains information about an Employee that is both objective and verifiable. This information may be challenged by an Employee where they feel it is not factually true. In such a case, you may be required to provide evidence (such as a {{ __('help.ccmaref') }}). This includes information relating to {labour} dispute referrals, dismissals, resignations, promotions, positive performance reviews etc. </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion5"
                                                        data-target="#step19">
                                                        <p class="faqtextbigb">
                                                            <a href="#step19" class="ing">Performance section</a>
                                                        </p>

                                                    </div>
                                                    
                                                    
                                                    <div id="step19" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">This section contains subjective information relating to an Employee's performance within an {{ __('help.organisation') }}. There are several criteria upon which you will rate each Employee, such as work-ethic, dedication etc. and the Employee will also include a self-rating. This information is available to the Employee, but is not capable of being challenged.  </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
    <!-- 6th batch questions Section -->
                            <div id="6" class="tabcontent">
                                <div class="col-sm-12" style="background-color: #f4f4f4; padding-top: 20px; padding-bottom: 30px;">
                                    <div id="admin_settings">
                                        <div class="addpadf">
                                            <div class="panel-group" id="faqAccordion6">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion6"
                                                        data-target="#step20">
                                                        <p class="faqtextbigb">
                                                            <a href="#step20" class="ing">Generating a SLIP for candidates</a>
                                                        </p>

                                                    </div>
                                                    <div id="step20" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">If you wish to view the Profile of a candidate you may hire, you will require a signed SLIP. This is generated by entering their full name, {{ __('help.idnumber') }} and personal email address of the candidate (as with existing Employees). Once generated, the candidate will be notified via email. </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion6"
                                                        data-target="#step21">
                                                        <p class="faqtextbigb">
                                                            <a href="#step21" class="ing">Obtaining consent from candidates</a>
                                                        </p>

                                                    </div>
                                                    <div id="step21" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">Once you have generated the SLIP, it is important that the candidate signs the form to confirm that they have consented to their Profile being viewed by you. Without a signed SLIP, you are not permitted to access a candidate's Profile. Once you have confirmed receipt of a signed SLIP, you may access the candidate's StaffLife Profile. </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion6"
                                                        data-target="#step22">
                                                        <p class="faqtextbigb">
                                                            <a href="#step22" class="ing">Viewing an individual's Profile</a>
                                                        </p>

                                                    </div>
                                                    <div id="step22" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">Once you have confirmed that a candidate has signed the SLIP, you may view their Profile. You will be given access to all sections of their Profile, which are not publicly accessible. The Profile is laid out clearly, and you will easily be able to navigate through and interpret the information.  </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion6"
                                                        data-target="#step23">
                                                        <p class="faqtextbigb">
                                                            <a href="#step23" class="ing">Interpreting a candidate's Profile</a>
                                                        </p>
                                                    </div>
                                                <div id="step23" class="panel-collapse collapse" style="height: 0px;">
                                                    <div class="panel-body">
                                                        <p class="faqtextsml">The Basics & Ethics section contains objective and verifiable information. This information may be accepted as factual, and any information which is factually incorrect may be challenged by the Employee and will be removed by StaffLife in the absence of proof by the Member. The Performance section contains subjective ratings of an Employee, and includes both a rating done by the Member, and by the Employee of themselves. This section should be interpreted bearing in mind that the data contained therein is based on subjective opinions. </p>
                                                    </div>
                                                </div>
                                            </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion6"
                                                        data-target="#step24">
                                                        <p class="faqtextbigb">
                                                            <a href="#step24" class="ing">Successful candidate Profiles</a>
                                                        </p>

                                                    </div>
                                                <div id="step24" class="panel-collapse collapse" style="height: 0px;">
                                                    <div class="panel-body">
                                                        <p class="faqtextsml">Once a candidate is successful, you will enter a start date for this Employee. This will allow you to enter data on the Employee's Profile on a monthly basis, provided you remain a member of StaffLife. </p>
                                                    </div>
                                                </div>
                                            </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion6"
                                                        data-target="#step25">
                                                        <p class="faqtextbigb">
                                                            <a href="#step25" class="ing">Unsuccessful candidate Profiles</a>
                                                        </p>
                                                    </div>
                                                    
                                                    <div id="step25" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">A candidate's Profile will remain open for a period of 30 days. In the event that you do not hire the candidate, you will merely not enter a start date for the Employee. No additional action is required. </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
    <!-- 7th batch questions Section -->
                            <div id="7" class="tabcontent">
                                <div class="col-sm-12" style="background-color: #f4f4f4; padding-top: 20px; padding-bottom: 30px;">
                                    <div id="admin_settings">
                                        <div class="addpadf">
                                            <div class="panel-group" id="faqAccordion7">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion7"
                                                        data-target="#step26">
                                                        <p class="faqtextbigb">
                                                            <a href="#step26" class="ing">Using credits</a>
                                                        </p>

                                                    </div>
                                                    <div id="step26" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">One credit will be {{ __('help.utilised') }} per Employee per month, as well as an additional credit per candidate search. You can check your credit balance at any time by logging into your Dashboard. </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion7"
                                                        data-target="#step27">
                                                        <p class="faqtextbigb">
                                                            <a href="#step27" class="ing">Viewing credit balance</a>
                                                        </p>

                                                    </div>
                                                    <div id="step27" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">Your credit balance will be displayed on your Dashboard. </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion7"
                                                        data-target="#step28">
                                                        <p class="faqtextbigb">
                                                            <a href="#step28" class="ing">Additional credits</a>
                                                        </p>

                                                    </div>
                                                    <div id="step28" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">Should you wish to acquire additional credits, you may do so by <a style="text-decoration: underline;" href="{{ URL::to('login') }}">logging in</a> and selecting the Upgrade option on the left-hand menu. </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
    <!-- 8th batch questions Section -->
                            <div id="8" class="tabcontent">
                                <div class="col-sm-12" style="background-color: #f4f4f4; padding-top: 20px; padding-bottom: 30px;">
                                    <div id="admin_settings">
                                        <div class="addpadf">
                                            <div class="panel-group" id="faqAccordion8">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion8"
                                                        data-target="#step29">
                                                        <p class="faqtextbigb">
                                                            <a href="#step29" class="ing">Incorrect Username</a>
                                                        </p>
        
                                                    </div>
                                                    <div id="step29" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">To have your username sent to your personal email address, click <a style="text-decoration: underline;" href="{{ URL::to('forgot-password') }}">Trouble Logging In</a>. Select the Forgot username / password option.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion8"
                                                        data-target="#step30">
                                                        <p class="faqtextbigb">
                                                            <a href="#step30" class="ing">Incorrect Password</a>
                                                        </p>
        
                                                    </div>
                                                    <div id="step30" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">To have your password sent to your personal email address, click <a style="text-decoration: underline;" href="{{ URL::to('forgot-password') }}">Trouble Logging In</a>. Select the Forgot username / password option.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion8"
                                                        data-target="#step31">
                                                        <p class="faqtextbigb">
                                                            <a href="#step31" class="ing">Forgotten Username / Password</a>
                                                        </p>

                                                    </div>
                                                    <div id="step31" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">In the login box, click <a style="text-decoration: underline;" href="{{ URL::to('forgot-password') }}">Trouble Logging In</a>. Select the Forgot username / password option. This will allow you to reset your username and/or password.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion8"
                                                        data-target="#step32">
                                                            <p class="faqtextbigb">
                                                            <a href="#step32" class="ing">Other Issues Logging In</a>
                                                        </p>
        
                                                    </div>
                                                    <div id="step32" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">For any other issues logging in, please <a style="text-decoration: underline;" href="{{ route(session('nav_section').'.contacts', session('custom_lang')) }}">contact us</a>.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- FAQ Section Employters End -->
                        </div>
                    </div>
                </div>
    <!-- Employer section END -->


                
    <!-- Employee section Start -->
                <div id="menu1" class="tab-pane fade">
                    <div class="container addpadf">
                    
                    
                        <div class="content">                    
                            <!-- Vertical Tab Menu Start -->
                            <div class="tab">
                                <button class="tablinks" onclick="openCity(event, '11')" id="defaultOpen">Setting Up A Profile</button>
                                <button class="tablinks" onclick="openCity(event, '12')">Accessing your Profile</button>
                                <button class="tablinks" onclick="openCity(event, '13')">Managing your Profile</button>
                                <button class="tablinks" onclick="openCity(event, '14')">Controlling access to your Profile</button>
                                <button class="tablinks" onclick="openCity(event, '15')">Challenging information</button>
                                <button class="tablinks" onclick="openCity(event, '16')">Trouble Logging In</button>
                            </div>
                            <!-- Vertical Tab Menu END -->
    <!-- a batch questions Section -->
                            <div id="11" class="tabcontent">
                                <div class="col-sm-12" style="background-color: #f4f4f4; padding-top: 20px; padding-bottom: 30px;">
                                    <div id="setting_up_a_profile">
                                        <div class="addpadf">
                                            <div class="panel-group" id="faqAccordion9">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion9"
                                                        data-target="#step00">
                                                        <p class="faqtextbigb">
                                                            <a href="#step00" class="ing">Joining through your member</a>
                                                        </p>
                                                    </div>
                                                    
                                                    <div id="step00" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">Once your Member becomes a member, he will add your Profile by generating a SLIP, and presenting it to you for signature. By signing, you consent to information being added to your Profile by your Member. Your Profile will be set up using your personal email address, and you will receive monthly updates of the information that is included in your Profile. Any Basics & Ethics information which is not factually correct may be challenged by you, which will require your Member to furnish proof to StaffLife. Whenever a SLIP is generated using your details, you will be notified via email.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion9"
                                                        data-target="#step01">
                                                        <p class="faqtextbigb">
                                                            <a href="#step01" class="ing">Setting up your own Profile</a>
                                                        </p>
                                                    </div>
                                                    
                                                    <div id="step01" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">You may create your own StaffLife Profile if you prefer. When an existing or prospective Member generates a SLIP using your details, you will be notified via email.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
    <!-- b batch questions Section -->     
                            <div id="12" class="tabcontent">
                                <div class="col-sm-12" style="background-color: #f4f4f4; padding-top: 20px; padding-bottom: 30px;">
                                    <div id="accessing_your_profile">
                                        <div class="addpadf">
                                            <div class="panel-group" id="faqAccordion10">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion10"
                                                        data-target="#step02">
                                                        <p class="faqtextbigb">
                                                            <a href="#step02" class="ing">Logging in</a>
                                                        </p>
                                                    </div>
                                                    
                                                    <div id="step02" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">To log in, select Login from the home page. For trouble logging in, click here.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion10"
                                                        data-target="#step03">
                                                        <p class="faqtextbigb">
                                                            <a href="#step03" class="ing">Viewing your Profile</a>
                                                        </p>
                                                    </div>
                                                    
                                                    <div id="step03" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">You can easily view your Profile by logging in, or via the email update sent on a monthly basis.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
    <!-- c batch questions Section -->
                            <div id="13" class="tabcontent">
                                <div class="col-sm-12" style="background-color: #f4f4f4; padding-top: 20px; padding-bottom: 30px;">
                                    <div id="adding_employees">
                                        <div class="addpadf">
                                            <div class="panel-group" id="faqAccordion11">
                                            
                                            
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion11"
                                                        data-target="#step04">
                                                        <p class="faqtextbigb">
                                                            <a href="#step04" class="ing">Updating your email address</a>
                                                        </p>
                                                    </div>
                                                    <div id="step04" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">To update your personal email address, log in to your Profile. On the left-hand side, select My Account. This will allow you to update any details relating to your account. 			.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion11"
                                                        data-target="#step05">
                                                        <p class="faqtextbigb">
                                                            <a href="#step05" class="ing">Updating your Profile</a>
                                                        </p>
                                                    </div>
                                                    <div id="step05" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">You can update your personal details, as well as the Employee part of the Performance section within your Dashboard, once you have logged in.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion11"
                                                        data-target="#step06">
                                                        <p class="faqtextbigb">
                                                            <a href="#step06" class="ing">Using your Profile in a job application</a>
                                                        </p>
                                                    </div>
                                                    <div id="step06" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">If you would like to use your Profile to support an application, you can send a prospective Member your SL details (full name, {ID number} and personal email address, so that they are able to generate a SLIP for you to sign.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion11"
                                                        data-target="#step07">
                                                        <p class="faqtextbigb">
                                                            <a href="#step07" class="ing">Updating incorrect information</a>
                                                        </p>
                                                    </div>
                                                    <div id="step07" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">Any factually incorrect information which is included in the Basics & Ethics section of your Profile may be challenged. Once challenged, your Member is required to furnish proof that the information is true. In the event that it is not proven, it will be removed and your Member will be bench-marked on the system.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
    <!-- d batch questions Section -->                        
                            <div id="14" class="tabcontent">
                                <div class="col-sm-12" style="background-color: #f4f4f4; padding-top: 20px; padding-bottom: 30px;">
                                    <div id="controlling_access_to_your_profile">
                                        <div class="addpadf">
                                        
                                        
                                            <div class="panel-group" id="faqAccordion12">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion12"
                                                        data-target="#step08">
                                                        <p class="faqtextbigb">
                                                            <a href="#step08" class="ing">Hiding the performance section of your Profile</a>
                                                        </p>
                                                    </div>
                                                    <div id="step08" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">You can easily hide the Performance section of your Profile, by ticking the Hide this section. Once logged in, you will see the tickbox is located above the Performance section on the upper left-hand side.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion12"
                                                        data-target="#step09">
                                                        <p class="faqtextbigb">
                                                            <a href="#step09" class="ing">Controlling who can access your Profile</a>
                                                        </p>
                                                    </div>
                                                    <div id="step09" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">A prospective Member may not access your Profile without your consent (a signed SLIP). You will be notified when a SLIP is generated using your details, and where your Profile is accessed. Your Profile is not publicly available, and other Employees are not able to access your Profile.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
    <!-- e batch questions Section -->                        
                            <div id="15" class="tabcontent">
                                <div class="col-sm-12" style="background-color: #f4f4f4; padding-top: 20px; padding-bottom: 30px;">
                                    <div id="challenging_information">
                                        <div class="addpadf">
                                            <div class="panel-group" id="faqAccordion13">
                                            
                                            
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion13"
                                                        data-target="#step101">
                                                        <p class="faqtextbigb">
                                                            <a href="#step101" class="ing">Number of challenges permitted</a>
                                                        </p>
                                                    </div>
                                                    <div id="step101" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">You may challenge information recorded in the Basics & Ethics section of your Profile. You have an unlimited number of challenges, provided that your challenges are successful. If you unsuccessfully challenge information twice, you will not be permitted to challenge any further information for the remainder of the year.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion13"
                                                        data-target="#step102">
                                                        <p class="faqtextbigb">
                                                            <a href="#step102" class="ing">Successful challenges</a>
                                                        </p>
                                                    </div>
                                                    <div id="step102" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">In the event that your Member is unable to furnish proof of the information challenged, StaffLife will remove the challenged information and benchmark your Member.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion13"
                                                        data-target="#step103">
                                                        <p class="faqtextbigb">
                                                            <a href="#step103" class="ing">Unsuccessful challenges</a>
                                                        </p>
                                                    </div>
                                                    <div id="step103" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">There are no negative repercussions for challenging information. However, if you unsuccessfully challenge information on your Profile twice, you will be blocked from challenging information for the remainder of the year.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
    <!-- f batch questions Section -->                        
                            <div id="16" class="tabcontent">
                                <div class="col-sm-12" style="background-color: #f4f4f4; padding-top: 20px; padding-bottom: 30px;">
                                    <div id="login_trouble">
                                        <div class="addpadf">
                                            <div class="panel-group" id="faqAccordion14">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion14"
                                                        data-target="#step104">
                                                        <p class="faqtextbigb">
                                                            <a href="#step104" class="ing">Incorrect Username</a>
                                                        </p>

                                                    </div>
                                                    <div id="step104" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">To have your username sent to your personal email address, click Trouble Logging In. Select the Forgot username / password option.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion14"
                                                        data-target="#step105">
                                                        <p class="faqtextbigb">
                                                            <a href="#step105" class="ing">Incorrect Password</a>
                                                        </p>

                                                    </div>
                                                    <div id="step105" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">To have your password sent to your personal email address, click Trouble Logging In. Select the Forgot username / password option.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion14"
                                                        data-target="#step106">
                                                        <p class="faqtextbigb">
                                                            <a href="#step106" class="ing">Forgotten Username / Password</a>
                                                        </p>

                                                    </div>
                                                    <div id="step106" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">In the login box, click Trouble Logging In. Select the Forgot username / password option. This will allow you to reset your username and/or password.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion14"
                                                        data-target="#step107">
                                                        <p class="faqtextbigb">
                                                            <a href="#step107" class="ing">Other Issues Logging In</a>
                                                        </p>

                                                    </div>
                                                    <div id="step107" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">For any other issues logging in, please <a style="text-decoration: underline;" href="{{ route(session('nav_section').'.contacts', session('custom_lang')) }}">contact us</a>.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>            
                        </div>
                    </div>
                </div>
    <!-- Employee section END -->
                
            </div>
        </div>
    </div>    
    <!-- Desktop version END -->

    <!-- Mobile version -->
    <div class="mobhelp">
    <!-- FAQ Section Start -->

        <div class="container" style="padding-top:50px !important;">
            <ul class="navb nav-tabsb" style="padding-bottom:10px;">
                <li id="employer_tab1" class="active"><a data-toggle="tab" href="#ma">Employers Using StaffLife</a></li>
                <li id="employee_tab2"><a data-toggle="tab" href="#mb">Employees Using StaffLife</a></li>
            </ul>
        </div>
        
        
        <div class="container marbottom" style="padding-top:20px !important; padding-bottom:20px;">
            <div class="tab-content" id="help2">
                <div id="ma" class="tab-pane fade in active">
                    <div class="container addpadf">

                        <ul class="nav nav-tabs nav-stacked">
                            <li class="active"><a data-toggle="tab" href="#m1">Joining StaffLife</a></li>
                            <li><a data-toggle="tab" href="#m2">Account Settings</a></li>
                            <li><a data-toggle="tab" href="#m3">Adding Employees</a></li>
                            <li><a data-toggle="tab" href="#m4">Managing your Employees</a></li>
                            <li><a data-toggle="tab" href="#m5">Updating Employee Profiles</a></li>
                            <li><a data-toggle="tab" href="#m6">Candidate Searches</a></li>
                            <li><a data-toggle="tab" href="#m7">Credits</a></li>
                            <li><a data-toggle="tab" href="#m8">Trouble Logging In</a></li>
                        </ul>

                        <div class="tab-content">
    <!-- 1 -->
                            <div id="m1" class="tab-pane fade in active">
                                <div class="col-sm-12" style="background-color: #f4f4f4; padding-top: 20px; padding-bottom: 30px;">
                                    <div id="join">
                                        <div class="addpadf">
            
                                            <div class="panel-group" id="faqAccordionb">
                
                
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordionb" data-target="#step0b">
                                                        <p class="faqtextbigb"><a href="#step0b" class="ing">Getting started</a></p>
                                                    </div>
                                                    <div id="step0b" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">To start using StaffLife, you will need to select the option on our pricing page that best suits your organisation's size. Once you have registered, you are able to start adding your Employees to your account and looking up Profiles of candidates that have applied to join your organisation.</p>
                                                        </div>
                                                    </div>
                                                </div>
                    
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordionb" data-target="#step1b">
                                                        <p class="faqtextbigb"><a href="#step1b" class="ing">Choosing a membership package</a></p>
                                                    </div>
                                                    <div id="step1b" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">Your ideal package will be determined by the number of Employees within your {{ __('help.organisation') }}, as well as the number of candidate Profiles you will look up on average per month. It is important that all Employees are added under your Profile, in order to fully reap the benefits of the StaffLife system.</p>
                                                        </div>
                                                    </div>
                                                </div>
                    
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordionb" data-target="#step2b">
                                                        <p class="faqtextbigb"><a href="#step2b" class="ing">Creating your account</a></p>
                                                    </div>
                                                    <div id="step2b" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">Creating your account is quick and easy, and can be done here. In order to create your account, you will need to enter the name, surname and email address of the account administrator. Once your account has been created and payment has been made, you will verify your company by submitting either your {{ __('help.incorporationdocs') }}, an invoice or a {{ __('help.utilitybill') }}. Once verified, you are able to add your Employees to the StaffLife system.</p>
                                                        </div>
                                                    </div>
                                                </div>
                    
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordionb" data-target="#step3b">
                                                        <p class="faqtextbigb"><a href="#step3b" class="ing">Company verification</a></p>
                                                    </div>
                                                    <div id="step3b" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">In order to verify your company, it is required that you submit your{{ __('help.incorporationdocs') }}, and either an invoice or {{ __('help.utilitybill') }}. Verification is done within your Profile, by clicking Verify Company on the left-hand menu.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
    <!-- 2 -->    
                            <div id="m2" class="tab-pane fade">
                                <div class="col-sm-12" style="background-color: #f4f4f4; padding-top: 20px; padding-bottom: 30px;">
                                    <div id="admin_settings">
                                        <div class="addpadf">
                                            <div class="panel-group" id="faqAccordion2b">
                
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordion2b" data-target="#step4b">
                                                        <p class="faqtextbigb"><a href="#step4b" class="ing">Logging into your account</a></p>
                                                    </div>
                                                    <div id="step4b" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">In order to log in, <a style="text-decoration: underline;" href="{{ URL::to('login') }}">click here</a>. You will log in using the email address and password used to create your account. For trouble logging in, <a style="text-decoration: underline;" href="{{ URL::to('forgot-password') }}">click here</a>.</p>
                                                        </div>
                                                    </div>
                                                </div>
                    
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordion2b" data-target="#step5b">
                                                        <p class="faqtextbigb"><a href="#step5b" class="ing">Changing account settings</a></p>
                                                    </div>
                                                    <div id="step5b" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">Your account settings may be changed by clicking the My Account option on the left-hand menu. To access your account settings, <a style="text-decoration: underline;" href="{{ URL::to('login') }}">click here</a>.</p>
                                                        </div>
                                                    </div>
                                                </div>
                    
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordion2b" data-target="#step6b">
                                                        <p class="faqtextbigb"><a href="#step6b" class="ing">Cancellation</a></p>
                                                    </div>
                                                    <div id="step6b" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">You may cancel your membership at any time, subject to our <a style="text-decoration: underline;" href="{{ URL::to('terms-and-conditions') }}">cancellation terms</a>.</p>
                                                        </div>
                                                    </div>
                                                </div>
                    
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordion2b" data-target="#step7b">
                                                        <p class="faqtextbigb"><a href="#step7b" class="ing">Deactivating your account</a></p>
                                                    </div>
                                                    <div id="step7b" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">You may deactivate your account at any time, by selecting Deactivate My Account in the My Account option on the left-hand menu.</p>
                                                        </div>
                                                    </div>
                                                </div>
                    
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordion2b" data-target="#step8b">
                                                        <p class="faqtextbigb"><a href="#step8b" class="ing">Reactivating your account</a></p>
                                                    </div>
                                                    <div id="step8b" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">You may reactivate your account at any time by logging in and selecting Reactivate My Account in the My Account option on the left-hand menu.</p>
                                                        </div>
                                                    </div>
                                                </div>
                    
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordion2b" data-target="#step9b">
                                                        <p class="faqtextbigb"><a href="#step9b" class="ing">Changing membership packages</a></p>
                                                    </div>
                                                    <div id="step9b" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">You can easily change your membership option once you are logged in, by selecting the Upgrade option on the left-hand menu.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>    
                            </div>
    <!-- 3 -->
                            <div id="m3" class="tab-pane fade">
                                <div class="col-sm-12" style="background-color: #f4f4f4; padding-top: 20px; padding-bottom: 30px;">
                                    <div id="adding_employees">
                                        <div class="addpadf">
                                            <div class="panel-group" id="faqAccordion3b">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordion3b" data-target="#step10b">
                                                        <p class="faqtextbigb">
                                                            <a href="#step10b" class="ing">Generating a SLIP</a>
                                                        </p>
                                                    </div>
                                                    <div id="step10b" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">In order to add an Employee, you are required to generate a SLIP, which must then besigned by the Employee in question to confirm that they have given their consent.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordion3b" data-target="#step11b">
                                                        <p class="faqtextbigb"><a href="#step11b" class="ing">Information required to add an Employee</a></p>
                                                    </div>
                                                    <div id="step11b" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">In order to generate a SLIP, you must enter the following information for an Employee: full name, ID number and personal email address. </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordion3b" data-target="#step12b">
                                                        <p class="faqtextbigb"><a href="#step12b" class="ing">Obtaining consent from Employees</a></p>
                                                    </div>
                                                    <div id="step12b" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">Before you are entitled to add information to the Profile of an Employee, you must have them sign their uniquely generated SLIP. Once generated, the SLIP must be printed and presented to the Employee for signature. A signed copy of the SLIP must be retained for your records. </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordion3b" data-target="#step13b">
                                                        <p class="faqtextbigb"><a href="#step13b" class="ing">Adding an Employee's Profile</a></p>
                                                    </div>
                                                    <div id="step13b" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">To add an Employee, you will need to log in and click Employees on the left-hand menu, and from the drop-down select Add New. This will allow you to generate a SLIP for the Employee you are adding, by entering their full name, {{ __('help.idnumber') }} and personal email address. Once the SLIP has been signed by the Employee and you have confirmed this on the system, your Employee's Profile will be ready for reviews and information to be added. </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><p class="soylent_green"></p>
                                    </div>
                                </div>
                            </div>
    <!-- 4 -->
                            <div id="m4" class="tab-pane fade">
                                <div class="col-sm-12" style="background-color: #f4f4f4; padding-top: 20px; padding-bottom: 30px;">
                                    <div id="admin_settings">
                                        <div class="addpadf">
                                            <div class="panel-group" id="faqAccordion4b">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordion4b" data-target="#step14b">
                                                        <p class="faqtextbigb"><a href="#step14b" class="ing">Adding information to an Employee's Profile</a></p>
                                                    </div>
                                                    <div id="step14b" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">Once you have obtained a signed SLIP, you may start adding reviews and information to your Employee's Profile. The information is split into subjective (Performance) and objective (Basics & Ethics) sections. These sections should be completed once an Employee has been added, and should be updated on a regular basis. </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordion4b" data-target="#step15b">
                                                        <p class="faqtextbigb"><a href="#step15b" class="ing">Adding the start date of an Employee</a></p>
                                                    </div>
                                                    <div id="step15b" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">In order to add information to an Employee's Profile, you will need to add their start date. The start date is the date upon which the Employee commenced employment with your {{ __('help.organisation') }}.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordion4b" data-target="#step16b">
                                                        <p class="faqtextbigb"><a href="#step16b" class="ing">Adding the end date of an Employee</a></p>
                                                    </div>
                                                    <div id="step16b" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">Once an Employee is no longer with your {{ __('help.organisation') }}, you will need to add their end date. The end date is the date upon which the employment was effectively terminated (by either party). If you do not enter the end date, an additional credit will be used on a monthly basis in respect of this Employee. </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
    <!-- 5 -->
                            <div id="m5" class="tab-pane fade">
                                <div class="col-sm-12" style="background-color: #f4f4f4; padding-top: 20px; padding-bottom: 30px;">
                                    <div id="admin_settings">
                                        <div class="addpadf">
                                            <div class="panel-group" id="faqAccordion5b">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                    data-toggle="collapse" data-parent="#faqAccordion5b"
                                                    data-target="#step17b">
                                                        <p class="faqtextbigb">
                                                            <a href="#step17b" class="ing">Employee Profile sections</a>
                                                        </p>

                                                    </div>
                                                    
                                                    
                                                    <div id="step17b" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">The Employee Profile is split into two sections: Basics & Ethics and Performance. The Basics & Ethics section contains objective and verifiable information relating to an Employee, such as labour dispute referrals, disciplinary measures taken, promotions etc. The Performance section contains subjective ratings of an Employee, and includes a self-rating by the Employee. The Employee may access their Profile, and view the information that has been added by you (and previous Members) in each section respectively.  </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                    data-toggle="collapse" data-parent="#faqAccordion5b"
                                                    data-target="#step18b">
                                                        <p class="faqtextbigb">
                                                            <a href="#step18b" class="ing">Ethics & Basics section</a>
                                                        </p>

                                                    </div>
                                                    
                                                    
                                                    <div id="step18b" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">This section contains information about an Employee that is both objective and verifiable. This information may be challenged by an Employee where they feel it is not factually true. In such a case, you may be required to provide evidence (such as a {{ __('help.ccmaref') }}). This includes information relating to {labour} dispute referrals, dismissals, resignations, promotions, positive performance reviews etc. </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion5b"
                                                        data-target="#step19b">
                                                        <p class="faqtextbigb">
                                                            <a href="#step19b" class="ing">Performance section</a>
                                                        </p>

                                                    </div>
                                                    
                                                    
                                                    <div id="step19b" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">This section contains subjective information relating to an Employee's performance within an {{ __('help.organisation') }}. There are several criteria upon which you will rate each Employee, such as work-ethic, dedication etc. and the Employee will also include a self-rating. This information is available to the Employee, but is not capable of being challenged.  </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
    <!-- 6 -->
                            <div id="m6" class="tab-pane fade">
                                <div class="col-sm-12" style="background-color: #f4f4f4; padding-top: 20px; padding-bottom: 30px;">
                                    <div id="admin_settings">
                                        <div class="addpadf">
                                            <div class="panel-group" id="faqAccordion6b">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion6b"
                                                        data-target="#step20b">
                                                        <p class="faqtextbigb">
                                                            <a href="#step20b" class="ing">Generating a SLIP for candidates</a>
                                                        </p>

                                                    </div>
                                                    <div id="step20b" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">If you wish to view the Profile of a candidate you may hire, you will require a signed SLIP. This is generated by entering their full name, {{ __('help.idnumber') }} and personal email address of the candidate (as with existing Employees). Once generated, the candidate will be notified via email. </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion6b"
                                                        data-target="#step21b">
                                                        <p class="faqtextbigb">
                                                            <a href="#step21b" class="ing">Obtaining consent from candidates</a>
                                                        </p>

                                                    </div>
                                                    <div id="step21b" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">Once you have generated the SLIP, it is important that the candidate signs the form to confirm that they have consented to their Profile being viewed by you. Without a signed SLIP, you are not permitted to access a candidate's Profile. Once you have confirmed receipt of a signed SLIP, you may access the candidate's StaffLife Profile. </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion6b"
                                                        data-target="#step22b">
                                                        <p class="faqtextbigb">
                                                            <a href="#step22b" class="ing">Viewing an individual's Profile</a>
                                                        </p>

                                                    </div>
                                                    <div id="step22b" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">Once you have confirmed that a candidate has signed the SLIP, you may view their Profile. You will be given access to all sections of their Profile, which are not publicly accessible. The Profile is laid out clearly, and you will easily be able to navigate through and interpret the information.  </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion6b"
                                                        data-target="#step23b">
                                                        <p class="faqtextbigb">
                                                            <a href="#step23b" class="ing">Interpreting a candidate's Profile</a>
                                                        </p>
                                                    </div>
                                                <div id="step23b" class="panel-collapse collapse" style="height: 0px;">
                                                    <div class="panel-body">
                                                        <p class="faqtextsml">The Basics & Ethics section contains objective and verifiable information. This information may be accepted as factual, and any information which is factually incorrect may be challenged by the Employee and will be removed by StaffLife in the absence of proof by the Member. The Performance section contains subjective ratings of an Employee, and includes both a rating done by the Member, and by the Employee of themselves. This section should be interpreted bearing in mind that the data contained therein is based on subjective opinions. </p>
                                                    </div>
                                                </div>
                                            </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion6b"
                                                        data-target="#step24b">
                                                        <p class="faqtextbigb">
                                                            <a href="#step24b" class="ing">Successful candidate Profiles</a>
                                                        </p>

                                                    </div>
                                                <div id="step24b" class="panel-collapse collapse" style="height: 0px;">
                                                    <div class="panel-body">
                                                        <p class="faqtextsml">Once a candidate is successful, you will enter a start date for this Employee. This will allow you to enter data on the Employee's Profile on a monthly basis, provided you remain a member of StaffLife. </p>
                                                    </div>
                                                </div>
                                            </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion6b"
                                                        data-target="#step25b">
                                                        <p class="faqtextbigb">
                                                            <a href="#step25b" class="ing">Unsuccessful candidate Profiles</a>
                                                        </p>
                                                    </div>
                                                    
                                                    <div id="step25b" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">A candidate's Profile will remain open for a period of 30 days. In the event that you do not hire the candidate, you will merely not enter a start date for the Employee. No additional action is required. </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
    <!-- 7 -->
                            <div id="m7" class="tab-pane fade">
                                <div class="col-sm-12" style="background-color: #f4f4f4; padding-top: 20px; padding-bottom: 30px;">
                                    <div id="admin_settings">
                                        <div class="addpadf">
                                            <div class="panel-group" id="faqAccordion7b">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion7b"
                                                        data-target="#step26b">
                                                        <p class="faqtextbigb">
                                                            <a href="#step26b" class="ing">Using credits</a>
                                                        </p>

                                                    </div>
                                                    <div id="step26b" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">One credit will be {{ __('help.utilised') }} per Employee per month, as well as an additional credit per candidate search. You can check your credit balance at any time by logging into your Dashboard. </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion7b"
                                                        data-target="#step27b">
                                                        <p class="faqtextbigb">
                                                            <a href="#step27b" class="ing">Viewing credit balance</a>
                                                        </p>

                                                    </div>
                                                    <div id="step27b" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">Your credit balance will be displayed on your Dashboard. </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion7b"
                                                        data-target="#step28b">
                                                        <p class="faqtextbigb">
                                                            <a href="#step28b" class="ing">Additional credits</a>
                                                        </p>

                                                    </div>
                                                    <div id="step28b" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">Should you wish to acquire additional credits, you may do so by <a style="text-decoration: underline;" href="{{ URL::to('login') }}">logging in</a> and selecting the Upgrade option on the left-hand menu. </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
    <!-- 8 -->
                            <div id="m8" class="tab-pane fade">
                                <div class="col-sm-12" style="background-color: #f4f4f4; padding-top: 20px; padding-bottom: 30px;">
                                    <div id="admin_settings">
                                        <div class="addpadf">
                                            <div class="panel-group" id="faqAccordion8b">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion8b"
                                                        data-target="#step29b">
                                                        <p class="faqtextbigb">
                                                            <a href="#step29b" class="ing">Incorrect Username</a>
                                                        </p>
        
                                                    </div>
                                                    <div id="step29b" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">To have your username sent to your personal email address, click <a style="text-decoration: underline;" href="{{ URL::to('forgot-password') }}">Trouble Logging In</a>. Select the Forgot username / password option.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion8b"
                                                        data-target="#step30b">
                                                        <p class="faqtextbigb">
                                                            <a href="#step30b" class="ing">Incorrect Password</a>
                                                        </p>
        
                                                    </div>
                                                    <div id="step30b" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">To have your password sent to your personal email address, click <a style="text-decoration: underline;" href="{{ URL::to('forgot-password') }}">Trouble Logging In</a>. Select the Forgot username / password option.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion8b"
                                                        data-target="#step31b">
                                                        <p class="faqtextbigb">
                                                            <a href="#step31b" class="ing">Forgotten Username / Password</a>
                                                        </p>

                                                    </div>
                                                    <div id="step31b" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">In the login box, click <a style="text-decoration: underline;" href="{{ URL::to('forgot-password') }}">Trouble Logging In</a>. Select the Forgot username / password option. This will allow you to reset your username and/or password.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion8b"
                                                        data-target="#step32b">
                                                            <p class="faqtextbigb">
                                                            <a href="#step32b" class="ing">Other Issues Logging In</a>
                                                        </p>
        
                                                    </div>
                                                    <div id="step32b" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">For any other issues logging in, please <a style="text-decoration: underline;" href="{{ route(session('nav_section').'.contacts', session('custom_lang')) }}">contact us</a>.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>

                <div id="mb" class="tab-pane fade">
                    <div class="container addpadf">

                        <ul class="nav nav-tabs nav-stacked">
                            <li class="active"><a data-toggle="tab" href="#mb1">Setting Up A Profile</a></li>
                            <li><a data-toggle="tab" href="#mb2">Accessing your Profile</a></li>
                            <li><a data-toggle="tab" href="#mb3">Managing your Profile</a></li>
                            <li><a data-toggle="tab" href="#mb4">Controlling access to your Profile</a></li>
                            <li><a data-toggle="tab" href="#mb5">Challenging information</a></li>
                            <li><a data-toggle="tab" href="#mb6">Trouble Logging In</a></li>
                        </ul>

                        <div class="tab-content">
    
                            <div id="mb1" class="tab-pane fade in active">
                                <div class="col-sm-12" style="background-color: #f4f4f4; padding-top: 20px; padding-bottom: 30px;">
                                    <div id="setting_up_a_profile">
                                        <div class="addpadf">
                                            <div class="panel-group" id="faqAccordion9b">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion9b"
                                                        data-target="#step00b">
                                                        <p class="faqtextbigb">
                                                            <a href="#step00b" class="ing">Joining through your member</a>
                                                        </p>
                                                    </div>
                                                    
                                                    <div id="step00b" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">Once your Member becomes a member, he will add your Profile by generating a SLIP, and presenting it to you for signature. By signing, you consent to information being added to your Profile by your Member. Your Profile will be set up using your personal email address, and you will receive monthly updates of the information that is included in your Profile. Any Basics & Ethics information which is not factually correct may be challenged by you, which will require your Member to furnish proof to StaffLife. Whenever a SLIP is generated using your details, you will be notified via email.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion9b"
                                                        data-target="#step01b">
                                                        <p class="faqtextbigb">
                                                            <a href="#step01b" class="ing">Setting up your own Profile</a>
                                                        </p>
                                                    </div>
                                                    
                                                    <div id="step01b" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">You may create your own StaffLife Profile if you prefer. When an existing or prospective Member generates a SLIP using your details, you will be notified via email.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
        
                            <div id="mb2" class="tab-pane fade">
                                <div class="col-sm-12" style="background-color: #f4f4f4; padding-top: 20px; padding-bottom: 30px;">
                                    <div id="accessing_your_profile">
                                        <div class="addpadf">
                                            <div class="panel-group" id="faqAccordion10b">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion10b"
                                                        data-target="#step02b">
                                                        <p class="faqtextbigb">
                                                            <a href="#step02b" class="ing">Logging in</a>
                                                        </p>
                                                    </div>
                                                    
                                                    <div id="step02b" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">To log in, select Login from the home page. For trouble logging in, click here.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion10b"
                                                        data-target="#step03b">
                                                        <p class="faqtextbigb">
                                                            <a href="#step03b" class="ing">Viewing your Profile</a>
                                                        </p>
                                                    </div>
                                                    
                                                    <div id="step03b" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">You can easily view your Profile by logging in, or via the email update sent on a monthly basis.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
        
                            <div id="mb3" class="tab-pane fade">
                                <div class="col-sm-12" style="background-color: #f4f4f4; padding-top: 20px; padding-bottom: 30px;">
                                    <div id="adding_employees">
                                        <div class="addpadf">
                                            <div class="panel-group" id="faqAccordion11b">
                                            
                                            
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion11b"
                                                        data-target="#step04b">
                                                        <p class="faqtextbigb">
                                                            <a href="#step04b" class="ing">Updating your email address</a>
                                                        </p>
                                                    </div>
                                                    <div id="step04b" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">To update your personal email address, log in to your Profile. On the left-hand side, select My Account. This will allow you to update any details relating to your account. 			.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion11b"
                                                        data-target="#step05b">
                                                        <p class="faqtextbigb">
                                                            <a href="#step05b" class="ing">Updating your Profile</a>
                                                        </p>
                                                    </div>
                                                    <div id="step05b" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">You can update your personal details, as well as the Employee part of the Performance section within your Dashboard, once you have logged in.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion11b"
                                                        data-target="#step06b">
                                                        <p class="faqtextbigb">
                                                            <a href="#step06b" class="ing">Using your Profile in a job application</a>
                                                        </p>
                                                    </div>
                                                    <div id="step06b" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">If you would like to use your Profile to support an application, you can send a prospective Member your SL details (full name, {ID number} and personal email address, so that they are able to generate a SLIP for you to sign.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion11b"
                                                        data-target="#step07b">
                                                        <p class="faqtextbigb">
                                                            <a href="#step07b" class="ing">Updating incorrect information</a>
                                                        </p>
                                                    </div>
                                                    <div id="step07b" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">Any factually incorrect information which is included in the Basics & Ethics section of your Profile may be challenged. Once challenged, your Member is required to furnish proof that the information is true. In the event that it is not proven, it will be removed and your Member will be bench-marked on the system.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
        
                            <div id="mb4" class="tab-pane fade">
                                <div class="col-sm-12" style="background-color: #f4f4f4; padding-top: 20px; padding-bottom: 30px;">
                                    <div id="controlling_access_to_your_profile">
                                        <div class="addpadf">
                                        
                                        
                                            <div class="panel-group" id="faqAccordion12b">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion12b"
                                                        data-target="#step08b">
                                                        <p class="faqtextbigb">
                                                            <a href="#step08b" class="ing">Hiding the performance section of your Profile</a>
                                                        </p>
                                                    </div>
                                                    <div id="step08b" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">You can easily hide the Performance section of your Profile, by ticking the Hide this section. Once logged in, you will see the tickbox is located above the Performance section on the upper left-hand side.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion12b"
                                                        data-target="#step09b">
                                                        <p class="faqtextbigb">
                                                            <a href="#step09b" class="ing">Controlling who can access your Profile</a>
                                                        </p>
                                                    </div>
                                                    <div id="step09b" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">A prospective Member may not access your Profile without your consent (a signed SLIP). You will be notified when a SLIP is generated using your details, and where your Profile is accessed. Your Profile is not publicly available, and other Employees are not able to access your Profile.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
        
                            <div id="mb5" class="tab-pane fade">
                                <div class="col-sm-12" style="background-color: #f4f4f4; padding-top: 20px; padding-bottom: 30px;">
                                    <div id="challenging_information">
                                        <div class="addpadf">
                                            <div class="panel-group" id="faqAccordion13b">
                                            
                                            
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion13b"
                                                        data-target="#step101b">
                                                        <p class="faqtextbigb">
                                                            <a href="#step101b" class="ing">Number of challenges permitted</a>
                                                        </p>
                                                    </div>
                                                    <div id="step101b" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">You may challenge information recorded in the Basics & Ethics section of your Profile. You have an unlimited number of challenges, provided that your challenges are successful. If you unsuccessfully challenge information twice, you will not be permitted to challenge any further information for the remainder of the year.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion13b"
                                                        data-target="#step102b">
                                                        <p class="faqtextbigb">
                                                            <a href="#step102b" class="ing">Successful challenges</a>
                                                        </p>
                                                    </div>
                                                    <div id="step102b" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">In the event that your Member is unable to furnish proof of the information challenged, StaffLife will remove the challenged information and benchmark your Member.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion13b"
                                                        data-target="#step103b">
                                                        <p class="faqtextbigb">
                                                            <a href="#step103b" class="ing">Unsuccessful challenges</a>
                                                        </p>
                                                    </div>
                                                    <div id="step103b" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">There are no negative repercussions for challenging information. However, if you unsuccessfully challenge information on your Profile twice, you will be blocked from challenging information for the remainder of the year.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
        
                            <div id="mb6" class="tab-pane fade">
                                <div class="col-sm-12" style="background-color: #f4f4f4; padding-top: 20px; padding-bottom: 30px;">
                                    <div id="login_trouble">
                                        <div class="addpadf">
                                            <div class="panel-group" id="faqAccordion14b">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion14b"
                                                        data-target="#step104b">
                                                        <p class="faqtextbigb">
                                                            <a href="#step104b" class="ing">Incorrect Username</a>
                                                        </p>

                                                    </div>
                                                    <div id="step104b" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">To have your username sent to your personal email address, click Trouble Logging In. Select the Forgot username / password option.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion14b"
                                                        data-target="#step105b">
                                                        <p class="faqtextbigb">
                                                            <a href="#step105b" class="ing">Incorrect Password</a>
                                                        </p>

                                                    </div>
                                                    <div id="step105b" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">To have your password sent to your personal email address, click Trouble Logging In. Select the Forgot username / password option.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion14b"
                                                        data-target="#step106b">
                                                        <p class="faqtextbigb">
                                                            <a href="#step106b" class="ing">Forgotten Username / Password</a>
                                                        </p>

                                                    </div>
                                                    <div id="step106b" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">In the login box, click Trouble Logging In. Select the Forgot username / password option. This will allow you to reset your username and/or password.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading accordion-toggle question-toggle collapsed"
                                                        data-toggle="collapse" data-parent="#faqAccordion14b"
                                                        data-target="#step107b">
                                                        <p class="faqtextbigb">
                                                            <a href="#step107b" class="ing">Other Issues Logging In</a>
                                                        </p>

                                                    </div>
                                                    <div id="step107b" class="panel-collapse collapse" style="height: 0px;">
                                                        <div class="panel-body">
                                                            <p class="faqtextsml">For any other issues logging in, please <a style="text-decoration: underline;" href="{{ route(session('nav_section').'.contacts', session('custom_lang')) }}">contact us</a>.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Mobile version END -->

@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/js/frontend/faq.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/mixitup/jquery.mixitup.js') }}"></script>

    <script>
        $(document).ready(function () {
            @if($nav_section == 'business')
            $('#home').addClass("in active");
            $('#menu1').removeClass("in active");
            $('#employee_tab').removeClass('active');
            $('#employer_tab').addClass('active');
            @else
            $('#home').removeClass("in active");
            $('#menu1').addClass("in active");
            $('#employer_tab').removeClass('active');
            $('#employee_tab').addClass('active');
            @endif

            $(document).on('click', function (event) {
                jQuery(".bold_text").removeClass("bold_text");
                $target = $(event.target);
                $target.addClass('bold_text');
            });
        });
    </script>
    
<!-- Add this and see what happens -->
<script>
function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
@stop