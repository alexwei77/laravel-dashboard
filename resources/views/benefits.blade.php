<?php $og = new OpenGraph(); 
$og->title('Benefits - StaffLife.com')
        ->image("")
        ->description("Increase productivity and improve accountability. StaffLife is the world's largest employer-managed advanced database, helping Members avoid undesirable hires.")
        ->url();
?>
<!DOCTYPE html>
<html lang="en">
<head>
{!! $og->renderTags() !!}
  <title>Benefits</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Increase productivity and improve accountability. StaffLife is the world's largest employer-managed advanced database, helping Members avoid undesirable hires.">
  @include('layouts/csp')
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>  
</head>

@extends('layouts/defaultboth')

{{-- Page title --}}
@section('title')
Benefits
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <!--page level css starts-->

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/tabbular.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/animate/animate.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/jquery.circliful.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/price.css') }}">
    <link href="{{ asset('assets/vendors/animate/animate.min.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/indexboth.css') }}">

@stop

<style>
    body {
        margin-top: -20px !important;
  }

    @media screen and (min-width: 1025px) {
        .hmipd1 {
            display: none;
  }
  }

    @media screen and (min-width: 768px) {
        .hmmob {
            display: none;
  }
  }

    @media screen and (max-width: 767px) {
        .hmipd2 {
            display: none;
  }
    }

    @media screen and (min-width: 768px) and (max-width: 1024px) {
        .hmdtmb {
            display: none;
        }
    }

    .col-sm-4 {
        padding: 20px;
        margin: 1%;
        margin-bottom: 0;
        transition: all 0.3s;
    }

    .shadewow:hover {
        -webkit-box-shadow: 0px 0px 25px 0px rgba(173, 173, 173, 0.5);
        -moz-box-shadow: 0px 0px 25px 0px rgba 173, 173, 173, 0.5);
        box-shadow: 0px 0px 25px 0px rgba(173, 173, 173, 0.5);
        transition: all 0.3s;
    }

    @media screen and (min-width: 768px) {
        .col-sm-4 {
            width: 31% !important;
        }
    }

    @media screen and (max-width: 767px) {
        .col-sm-4 {
            margin-bottom: 20px;
        }
    }

  .greenhfour {color:#4caf50 !important;}
  p.centxt {text-align:center !important;}
  .row {display: -webkit-box;display: -webkit-flex;display: -ms-flexbox;display: flex;flex-wrap: wrap;}
  .containerb {width:80% !important;}
</style>



{{-- content --}}
@section('content')

<div class="jumbotext text-center">
  <h1>Benefits</h1>
</div>

<div class="height50"></div>

<div class="container containerb">
    <div class="row text-center row-eq-height">
        <div class="col-sm-12">
            <h3 class="homeheading">Prevent undesirable hires by up to 94%</h3>
            <div class="twentypxspacer"></div>
            <p class="centxt faqtextsml limit1200">StaffLife is a world-first employee data bureau. Gone are the days when employers relied on documents created by the candidates themselves - CVs, resumes, motivation letters or references. Our databases are updated with hundreds of thousands of accurate and reliable records each month. Join as a member and become a valuable and responsible contributor.</p>
        </div>
    </div>
    
    <div class="twentypxspacer"></div>
    
    <!-- New Row -->
    
    <div class="row text-center row-eq-height">
    
    
        <div class="col-sm-4 shadewow greybghome">
            <!-- for Desktop -->
            <img class="hmipd2 img100width" src="{{ asset('assets/images/side3id.jpg') }}" alt="Successful job candidate shaking hands with new employer">
            <!-- for Mobile -->
            <img class="hmmob img100width" src="{{ asset('assets/images/side3im.jpg') }}" alt="Successful job candidate shaking hands with new employer">
            <h4 class="top10 greenhfour">Attract top talent and repel questionable candidates before they are even hired</h4>
            <div class="twentypxspacer"></div>
            <p class="centxt">StaffLife is the world's largest employer-managed advanced database, helping Members to avoid undesirable hires. Our Members who are all verified registered companies, submit data to StaffLife on a regular basis. Before being hired, a candidate becomes aware of the consequences and rewards of being employed by a StaffLife Employer Member. While valuable talent see that as a potential reward, questionable talent will often object to proceeding with the employer to begin with.</p>
        </div>

        <div class="col-sm-4 shadewow greybghome">
            <!-- for Desktop -->
            <img class="hmipd2 img100width" src="{{ asset('assets/images/side2id.jpg') }}" alt="Finding a bad worker with magnifying glass">
            <!-- for Mobile -->
            <img class="hmmob img100width" src="{{ asset('assets/images/side2im.jpg') }}" alt="Finding a bad worker with magnifying glass">
            <h4 class="top10 greenhfour">Negative consequences for bad employees and rewards for good employees</h4>
            <div class="twentypxspacer"></div>
            <p class="centxt">The ability to record employee performance is an extremely powerful tool for any employer. While those employees with poor work ethic, conduct or performance suffer the consequences, employees who apply themselves are rewarded with a positive employment history. Reduce costly corporate abuse by incompetent employees who are not transparent about their professional history.</p>
        </div>
        
        <div class="col-sm-4 shadewow greybghome">
            <!-- for Desktop -->
            <img class="hmipd2 img100width" src="{{ asset('assets/images/side4id.jpg') }}" alt="Productive worker with a variety of electronic devices">
            <!-- for Mobile -->
            <img class="hmmob img100width" src="{{ asset('assets/images/side4im.jpg') }}" alt="Productive worker with a variety of electronic devices">
            <h4 class="top10 greenhfour">Increase productivity by up to 340% - lower absenteeism and other reckless behaviour</h4>
            <div class="twentypxspacer"></div>
            <p class="centxt">Ongoing staff accountability ensures better performance and even better morale. A company with up to 50% of non-performing staff can cost far more than just wasted salaries. It can cause culture damage, poor customer service and even tarnish reputation. Staff accountability therefore safeguards against loss of productivity. Most employees battle with fitting into a company's culture and various aspects of HR, which vastly reduce the potential productivity. Lack of accountability of employees greatly diminishes productivity.</p>
        </div>
    </div>
    <div class="hmipd2 twentypxspacer"></div>
    
    <!-- New Row -->
    
    <div class="row text-center row-eq-height">
            
        <div class="col-sm-4 shadewow greybghome">
            <!-- for Desktop -->
            <img class="hmipd2 img100width" src="{{ asset('assets/images/ben1d.jpg') }}" alt="two employees clowning around at work">
            <!-- for Mobile -->
            <img class="hmmob img100width" src="{{ asset('assets/images/ben1.jpg') }}" alt="two employees clowning around at work">
            <h4 class="top10 greenhfour">Employees are no longer free to behave negligently and without consequence</h4>
            <div class="twentypxspacer"></div>
            <p class="centxt">Employees are no longer able to "job-hop" and perpetually hurt businesses without any consequences. For the first time, continuity in employment history is available across employers. This data is submitted by other employers, who are often fed up with the inability to do anything about malicious or poorly performing employees.</p>
        </div>
           
        <div class="col-sm-4 shadewow greybghome">
            <!-- for Desktop -->
            <img class="hmipd2 img100width" src="{{ asset('assets/images/ben2d.jpg') }}" alt="Man with self improvement award">
            <!-- for Mobile -->
            <img class="hmmob img100width" src="{{ asset('assets/images/ben2.jpg') }}" alt="Man with self improvement award">
            <h4 class="top10 greenhfour">Help employees improve themselves due to a new sense of accountability</h4>
            <div class="twentypxspacer"></div>
            <p class="centxt">Many, if not most people, are able to push themselves further when the stakes are higher. A permanent employment history does just that. Knowing they are able to separate themselves from the rest, by trying harder, with the knowledge that in future, their earnings will rise and better opportunities will follow, will encourage a standard of excellence in each employee. Our comprehensive system is also great for quarterly reviews. Simple tick boxes and buttons enable you to review and manage performance easily.</p>
        </div>
  
        <div class="col-sm-4 shadewow greybghome">
            <!-- for Desktop -->           
            <img class="hmipd2 img100width" src="{{ asset('assets/images/ben3d.jpg') }}" alt="Interviewer waiting for a job applicant">
            <!-- for Mobile -->
            <img class="hmmob img100width" src="{{ asset('assets/images/ben3.jpg') }}" alt="Interviewer waiting for a job applicant">
            <h4 class="top10 greenhfour">Reduce recruits who do not show up, or employees who've resigned without due notice or leave before their contract of employment has terminated</h4>
            <div class="twentypxspacer"></div>
            <p class="centxt">Generally new employees must adhere to a notice period when resigning from a position. Waiting for a new recruit while they are serving notice at their current employer (sometimes for up to 2 or more months) is a major cost in wasted time and money, if the new recruit does not show up. Equally damaging are employees who have resigned without providing notice. Ensuring accountability will ensure that most employees adhere to what was agreed.</p>
        </div>
    </div>
    <div class="hmipd2 twentypxspacer"></div>
    <!-- New Row -->
    
    <div class="row text-center row-eq-height">
    
        <div class="col-sm-4 hmipd2">
        </div>
    
    
        <div class="col-sm-4 shadewow greybghome">
            <!-- for Desktop -->
            <img class="hmipd2 img100width" src="{{ asset('assets/images/ben4d.jpg') }}" alt="Hand selecting a connection on a screen">
            <!-- for Mobile -->
            <img class="hmmob img100width" src="{{ asset('assets/images/ben4.jpg') }}" alt="Hand selecting a connection on a screen">
            <h4 class="top10 greenhfour">Past employers cannot be hidden and references falsified by candidates</h4>
            <div class="twentypxspacer"></div>
            <p class="centxt">As a Member, you will have access to past employers' contact details (when an applicant has signed the consent form at pre-employment phase). References cannot be withheld or falsified. You will be able to assess their true skills and conduct based on verified data provided by past employers and not solely the information provided in the applicant's CV. By distinguishing the good from the bad, you are able to offer higher earnings to those who are an asset to your company and lower earnings to those who are a liability (or prevent them from being hired to begin with).</p>
        </div>
        
        <div class="col-sm-4 hmipd2">
        </div>
        
    </div>
</div>
    
<div class="px30spacer"></div>

<section class="greybghome">
    <div class="container hmdtmb">
        <div class="row addpad">
            <div class="col-sm-12">
                <h3 class="homeheading txtlefthome">Our comprehensive data</h3>
                <hr class="homehr">
            </div>
            <div class="col-sm-6">
                <h4 class="homeheading greenhfour">Ethics & Basics</h4>
                <!-- <hr class="homehr"> -->
                <p class="hometextbig txtlefthome weight500">This is verifiable information which the employee may challenge (up to twice annually unless they prove to be correct). Evidence may be required from either party.</p>
                <div class="gonesmall">
                    <table width="100%">
                        <tr>
                            <td width="50%"><p class="txtlefthome">Remuneration<br/>Employer names dates<br/>Resignations & notice periods served</p>
                            </td>
                            <td width="50%"><p class="txtlefthome">Attendance<br/>Job titles<br/>Employment contract details</p>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="gonebig">
                    <p class="txtlefthome">Remuneration<br/>Employer names dates<br/>Resignations & notice periods served<br/>Attendance<br/>Job titles<br/>Employment contract details</p>
                </div>
      
            </div>
            <div class="col-sm-6">
                <h4 class="homeheading greenhfour">Performance</h4>
                <!-- <hr class="homehr"> -->
                <p class="hometextbig txtlefthome weight500">Member's review - unverifiable subjective opinion. Each Member decides how to submit this data or perceive this data from past employers.</p>
                <div class="gonesmall">
                    <table width="100%">
                        <tr>
                            <td width="50%"><p  class="txtlefthome">Punctuality<br/>Dedication<br/>Work quality</p>
                            </td>
                            <td width="50%"><p  class="txtlefthome">Skills<br/>Productivity<br/>Dozens of other data points</p>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="gonebig">
                    <p class="txtlefthome">Punctuality<br/>Dedication<br/>Work quality<br/>Skills<br/>Productivity<br/>Dozens of other data points</p>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="container hmipd1 hmipd2">
    <div>
        <h3 class="homeheading txtlefthome">Our comprehensive data</h3>
        <hr class="homehr">
    </div>
  <!-- Navigation menu starts -->
    <ul class="nav nav-tabs">
        <li class="active width25">
            <a data-toggle="tab" href="#home2">
                <h4 class="homeheading hometxtcenter greenhfour">Ethics & Basics</h4>
            </a>
        </li>
    
        <li class="width25">
            <a data-toggle="tab" href="#menu5">
                <h4 class="homeheading hometxtcenter greenhfour">Performance</h4>
            </a>
        </li>
    </ul>

<!-- Navigation Menu Ends -->
    <div class="tab-content">
        <div id="home2" class="tab-pane fade in active">
            <h4 class="homeheading top30 greenhfour">Ethics & Basics</h4>
            <!-- <hr class="homehr"> -->
            <p class="hometextbig txtlefthome weight500">This is verifiable information which the employee may challenge (up to twice annually unless they prove to be correct). Evidence may be required from either party.</p>
            <div class="gonesmall">
                <table width="100%">
                    <tr>
                        <td width="50%">
                            <p class="txtlefthome">Remuneration<br/>Employer names dates<br/>Resignations & notice periods served</p>
                        </td>
                        <td width="50%">
                            <p class="txtlefthome">Attendance<br/>Job titles<br/>Employment contract details</p>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="gonebig">
                <p class="txtlefthome">Remuneration<br/>Employer names dates<br/>Resignations & notice periods served<br/>Attendance<br/>Job titles<br/>Employment contract details</p>
            </div>
        </div>
          
        <div id="menu5" class="tab-pane fade">
            <h4 class="homeheading top30 greenhfour" style="padding-top:30px;">Performance</h4>
            <!-- <hr class="homehr"> -->
            <p class="hometextbig txtlefthome weight500">Member's review - unverifiable subjective opinion. Each Member decides how to submit this data or perceive this data from past employers.</p>
            <div class="gonesmall">
                <table width="100%">
                    <tr>
                        <td width="50%">
                            <p class="txtlefthome">Punctuality<br/>Dedication<br/>Work quality</p>
                        </td>
                        <td width="50%">
                            <p class="txtlefthome">Skills<br/>Productivity<br/>Dozens of other data points</p>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="gonebig">
                <p class="txtlefthome">Punctuality<br/>Dedication<br/>Work quality<br/>Skills<br/>Productivity<br/>Dozens of other data points</p>
            </div>
        </div>
    </div>
</div>
</section>

<div>
    <div class="container hmdtmb">
  
        <div class="row t30b20">
            <div class="col-sm-12">
                <h3 class="homeheading txtlefthome">How StaffLife works</h3>
                <hr class="homehr">
            </div>
        </div>
    
        <div class="row">
            <div class="col-sm-3">
                <p class="hometextbig stepgap stepgapb weight400 txthomeleft">Step 1 - Become a StaffLife Member</p>
                <p class="maximagec hometxtcenter"><img src="{{ asset('assets/images/Business-Sign-Up.png') }}" alt="Image of a business building"><p>
                <p class="faqtextsml txthomeleft marbot30">Any registered organisation can join by providing the following:<br/></p>
                <ul class="left10">
                    <li class="linkstyleb">Certificate of incorporation (a government issued document proving you are registered as a business)</li>
                    <li class="linkstyleb">Bill showing your physical address (utility, bank or other known source)</li>
                    <li class="linkstyleb">Agree to our T&Cs, primarily addressing unethical data submission. Approval is usually within 24hrs.</li>
                </ul>
            </div>
      
            <div class="col-sm-3">
                <p class="hometextbig stepgap stepgapb weight400 txtlefthome">Step 2 - Sign up existing staff<br/></p>
                <p class="maximagec hometxtcenter"><img src="{{ asset('assets/images/about7.png') }}" alt="Icon of a woman with a tick mark"><p>
                <p class="faqtextsml txtlefthome marbot30">To sign up an employee, you'll need their name, identity number (social security, ID, etc) and personal email address<br/></p>
                <ul class="left10">
                    <li class="linkstyleb">Their identity number. ID book, social security number, etc.</li>
                    <li class="linkstyleb">Name and personal email address, which will give them access to their Profile</li>
                    <li class="linkstyleb">The StaffLife system will produce a one-page consent form with their details for them to sign.</li>
                </ul>
            </div>
    
            <div class="col-sm-3">
                <p class="hometextbig stepgap stepgapb weight400 txtlefthome">Step 3 - Verify new applicants<br/></p>
                <p class="maximagec hometxtcenter"><img src="{{ asset('assets/images/about8.png') }}" alt="icon of a group of people in a cricle"><p>
                <p class="faqtextsml marbot30 txtlefthome">The process is the same as with existing staff. Ask the candidate to sign the consent form before hiring.<br/></p>
                <ul class="left10">
                    <li class="linkstyleb">The one-page form they sign provides consent for the company to view their profile, and;</li>
                    <li class="linkstyleb">Agreement to adhere to an ethical code of conduct</li>
                    <li class="linkstyleb">If they object, it is still up to the Member to hire the candidate, however, they you will not have access to their Profile</li>
                </ul>
            </div>
      
            <div class="col-sm-3">
                <p class="hometextbig stepgap stepgapb weight400 txtlefthome">Step 4 - Submit data to StaffLife<br/></p>
                <p class="maximagec hometxtcenter"><img src="{{ asset('assets/images/about10.png') }}" alt="Icon of people with a rising graph in fromt of them"><p>
                <p class="faqtextsml txtlefthome marbot30">An employee that is on StaffLife:<br/></p>
                <ul class="left10">
                    <li class="linkstyleb">Has an active Profile and will be notified whenever it's updated by you.</li>
                    <li class="linkstyleb">Will have their data submitted to StaffLife by you upon employment commencement and at termination.</li>
                    <li class="linkstyleb">Will have their Member employer submit performance reviews during employment. The frequency is up to the Member (monthly, quarterly, etc.).</li>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="container hmipd1 hmipd2">
    
        <div class="row t30b20">
            <div class="col-sm-12">
                <h3 class="homeheading txtlefthome">How StaffLife works</h3>
                <hr class="homehr">
            </div>
        </div>

  <!-- Navigation menu starts -->
  <ul class="nav nav-tabs">
    <li class="active width25">
        <a data-toggle="tab" href="#home">
            <p class="hometextbig stepgap stepgapb weight400 txtlefthome">Step 1 - Become a StaffLife Member</p>
            <p class="maximagec hometxtcenter"><img src="{{ asset('assets/images/Business-Sign-Up.png') }}" alt="Image of a business building"><p>
        </a>
    </li>
    
    <li style="width:25%;">
        <a data-toggle="tab" href="#menu1">
            <p class="hometextbig stepgap stepgapb weight400 txtlefthome">Step 2 - Sign up existing staff<br/></p>
            <p class="maximagec hometxtcenter"><img src="{{ asset('assets/images/about7.png') }}" alt="Icon of a woman with a tick mark"></p>
        </a>
    </li>
    
    <li style="width:25%;">
        <a data-toggle="tab" href="#menu2">
            <p class="hometextbig stepgap stepgapb weight400 txtlefthome">Step 3 - Verify new applicants<br/></p>
        <p class="maximagec hometxtcenter"><img src="{{ asset('assets/images/about8.png') }}" alt="icon of a group of people in a cricle"><p>
        </a>
    </li>
    
    <li style="width:25%;">
        <a data-toggle="tab" href="#menu3">
            <p class="hometextbig stepgap stepgapb weight400 txtlefthome">Step 4 - Submit data to StaffLife<br/></p>
        <p class="maximagec hometxtcenter"><img src="{{ asset('assets/images/about10.png') }}" alt="Icon of people with a rising graph in fromt of them"><p>
        </a>
    </li>
  </ul>

<!-- Navigation Menu Ends -->
    <div class="tab-content">
        <div id="home" class="tab-pane fade in active">
            <p class="faqtextsml txtlefthome t30b30">Any registered organisation can join by providing the following:<br/></p>
            <ul class="left10">
                <li class="linkstyleb">Certificate of incorporation (a government issued document proving you are registered as a business)</li>
                <li class="linkstyleb">Bill showing your physical address (utility, bank or other known source)</li>
                <li class="linkstyleb">Agree to our T&Cs, primarily addressing unethical data submission. Approval is usually within 24hrs.</li>
            </ul>
        </div>
          
        <div id="menu1" class="tab-pane fade">
            <p class="faqtextsml  txtlefthome t30b30">To sign up an employee, you'll need their name, identity number (social security, ID, etc) and personal email address<br/></p>
            <ul class="left10">
                <li class="linkstyleb">Their identity number. ID book, social security number, etc.</li>
                <li class="linkstyleb">Name and personal email address, which will give them access to their Profile</li>
                <li class="linkstyleb">The StaffLife system will produce a one-page consent form with their details for them to sign.</li>
            </ul>
        </div>
        <div id="menu2" class="tab-pane fade">
            <p class="faqtextsml  txtlefthome t30b30">The process is the same as with existing staff. Ask the candidate to sign the consent form before hiring.<br/></p>
            <ul class="left10">
                <li class="linkstyleb">The one-page form they sign provides consent for the company to view their profile, and;</li>
                <li class="linkstyleb">Agreement to adhere to an ethical code of conduct</li>
                <li class="linkstyleb">If they object, it is still up to the Member to hire the candidate, however, they you will not have access to their Profile</li>
            </ul>
        </div>
        <div id="menu3" class="tab-pane fade">
            <p class="faqtextsml  txtlefthome t30b30">An employee that is on StaffLife:<br/></p>
        <ul class="left10">
            <li class="linkstyleb">Has an active Profile and will be notified whenever it's updated by you.</li>
            <li class="linkstyleb">Will have their data submitted to StaffLife by you upon employment commencement and at termination.</li>
            <li class="linkstyleb">Will have their Member employer submit performance reviews during employment. The frequency is up to the Member (monthly, quarterly, etc.).</li>
        </ul>
        </div>
    </div>
</div>
    
</div>

<div class="text-center marbottom">
    <div class="twentypxspacer"></div>
    <h3  class="homeheading marbottom">Become a StaffLife Member today, and see the positive impact on your business</h3>
</div>

@stop

{{-- footer scripts --}}
@section('footer_scripts')
    <!-- page level js starts-->
    {{--<script type="text/javascript" src="{{ asset('assets/js/frontend/jquery.circliful.js') }}"></script>--}}
    {{--<script type="text/javascript" src="{{ asset('assets/vendors/wow/js/wow.min.js') }}" ></script>--}}
    {{--<script type="text/javascript" src="{{ asset('assets/js/frontend/index.js') }}"></script>--}}
    <!--page level js ends-->
@stop

