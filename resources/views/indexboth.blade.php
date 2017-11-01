<?php $og = new OpenGraph();
$og->title('Employee Ethics & Performance Bureau - StaffLife.com')
    ->image("")
    ->description("Stop bad hires before they happen and instantly improve employees' conduct and work ethic")
    ->url();

?>
        <!DOCTYPE html>
<html lang="en">
<head>
    {!! $og->renderTags() !!}
    <title>Employee Ethics & Performance Bureau - StaffLife.com</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
          content="Stop bad hires before they happen and instantly improve employees' conduct and work ethic">
    @include('layouts/csp')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
</head>
@extends('layouts/defaultboth')
{{-- Page title --}}
@section('title')
    Home
    @parent
@stop
{{-- page level styles --}}
@section('header_styles')
    <!--page level css starts-->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/indexboth.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/animate/animate.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/jquery.circliful.css') }}">
    <style>
        .homeheadingnewa {
            line-height: 22px;
            max-width: 1499px;
        }

        .homeheadingnewb {
            line-height: 22px;
            max-width: 1499px;
        }

        .text-bold {
            font-weight: bold;
            font-size: 115%;
            color: #4caf50;
        }

        .padding-top-we {
            height: 5px !important;
        }

        @media screen and (min-width: 768px) {
            .mobilepr {
                display: none;
            }
        }

        @media screen and (max-width: 767px) {
            .desktpr {
                display: none;
            }
        }

        @media (min-width: 768px) {
            .modal-dialog {
                width: 760px !important;
            }
        }

        .extra-guarantees {
            text-align: center;
            margin-top: 20px;
        }

        .newbgsec1 {
            background-image: url("{{ asset('assets/images/bgsec1.jpg') }}");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        .newbgsec2 {
            background-image: url("{{ asset('assets/images/bgsec2.jpg') }}");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        .margrightb {
            color: #3b3b3b;
        }
    </style>
@stop
{{-- content --}}
@section('content')
<div class="font-open-sans">
    <div class="newhometop">
        <div>
            <div class="topgap"></div>
            <div class="whiteone">Instantly <span style="color:#4caf50;">improve</span> employee performance and <span
                        style="color:#ee6f00;">reduce</span> bad hires
            </div>
            <div class="whitetwo" style="margin-top:1vw; font-size:30px; line-height: 1;">
                Employee Ethics & Performance History Bureau<br/>
                <p style="font-size:20px; color:#ffffff; text-align:center; line-height:50px;margin-top:15px;">A major global Human
                    Capital disruptor</p>
            </div>
            <div class="text-center">
                <div class="midgap" style="height: 5vw"></div>
                <br/><a class="btn success" style="padding:15px 0 !important;"
                        href="{{ route('/business/subscribe', [session('custom_lang'),'package' => 'standard', 'yearly' => 'monthly']) }}">TRY IT FREE</a>
                <div class="midgap" style="height: 3vw"></div>
                <div class="whitetwo">14-day free trial. No credit card required.<br/>
                    <a href="{{ route('pricing', session('custom_lang')) }}"
                    style="font-size:18px; color:#ffffff; text-decoration:none; line-height:50px;padding-top:10px;">Plans and
                        Pricing</a>
                </div>
                <div class="midgap" style="height: 3vw"></div>
            </div>         
        </div>         
    </div>    
    <div>
        <div class="container text-center">
            <div class="row addpad">
                <div class="col-sm-12">
                    <h3 class="homeheadingb" style="text-align:center;">Ineffective employee vetting and accountability
                        are a major risk to your business</h3>
                    <p style="text-align:center;font-size:17px;padding-top:10px;">Review your employees' conduct and performance - a powerful <span style="color:#4caf50;">reward</span> and
                        <span style="color:#ee6f00;">deterrent</span> solution
                    </p>
                </div>
            </div>
        </div>
        <div class="container text-center">
            <div class="work row">
                <h2 style="text-align:center; padding-bottom:30px;color:black;">Why StaffLife works like no
                    other HR system</h3>
                <div class="col-sm-12">
                    <div class="col-sm-4">
                        <img src="{{ asset('assets/images/1.png') }}">
                        <p style="text-align:center;padding:10px;">StaffLife is the world's first employer<br> driven, employee data bureau.
                            The benefits of a StaffLife Membership<br> are staggering for almost any business with a few
                            employees or more.</p>
                    </div>
                    <div class="col-sm-4">
                        <img src="{{ asset('assets/images/2.png') }}">
                        <p style="text-align:center;padding:10px;">Without a central database, employers have never been able to
                            establish previous employment history, nor hold<br> their employees accountable beyond their current
                            job.</p>
                    </div>
                <div class="col-sm-4">
                        <img src="{{ asset('assets/images/3.png') }}">
                        <p style="text-align:center;padding:10px;">References, CVs and other job-seeker generated documentation
                            are usually unverifiable, inaccurate and misleading.</p>
                        </div>                
                    <div class="px30spacer"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fourth section END -->
    <!--Start of we gurantee minimum of -->
    <div class="mingbg">        
        <div class="guarantee-bar">
            <a style="text-decoration:none;color:white;">Current employees: invaluable ethics, conduct, culture and performance</a>
        </div>
        <!-- 3-col section Start -->
        <div>
            <div class="container text-center">
                <div class="row addpad">
                    <div class="guarantee col-sm-12">
                        <p style="text-align:center;color:#333;padding-top:30px;">Your current employees are given the option to opt into StaffLife.
                            A positive record is an attractive prospect for valuable staff.</p>
                        <p style="text-align:center;color:#333;padding-bottom:30px;">The effect of a negative Profile and reward of a Positive Profile
                            is the ultimate incentive for most employees, motivating them to strive for the best.</p>
                    </div>                    
                    <div class="col-sm-4">                    
                        <div id="myStat3" class="center-block" data-startdegree="0" data-dimension="160" 
                             data-text="65%" data-width="10" data-fontsize="28" data-percent="65"
                             data-fgcolor="#4CAF50" data-bgcolor="#F4A560" style="color:#849284;margin-bottom:30px;"></div>
                        <div class="dttxtpad twentypxspacer"></div>
                        <span style="color:#333;">improved conduct</span>
                        <p style="text-align:center; padding-top:30px;color:#333;">
                            93% of employers report positive results<br> within 90 days and 78% within 30 days
                        </p>
                    </div>
                    <div class="col-sm-4">
                        <div id="myStat4" class="center-block" data-startdegree="0" data-dimension="160"
                             data-text="72%" data-width="10" data-fontsize="28" data-percent="72"
                             data-fgcolor="#4CAF50" data-bgcolor="#F4A560" style="color:#849284;margin-bottom:30px;"></div>
                        <div class="dttxtpad twentypxspacer"></div>
                        <span style="color:#333;">improved performance</span>
                        <p style="text-align:center; padding-top:30px;color:#333;">                            
                            40% lower recruitment and HR costs within a<br> 6 month period
                        </p>
                    </div>
                    <div class="col-sm-4">
                        <div id="myStat5" class="center-block" data-startdegree="0" data-dimension="160"
                             data-text="48%" data-width="10" data-fontsize="28" data-percent="48"
                             data-fgcolor="#4CAF50" data-bgcolor="#F4A560" style="color:#849284;margin-bottom:30px;"></div>
                        <div class="dttxtpad twentypxspacer"></div>
                        <span style="color:#333;">increased talent retention rate</span>
                        <p style="text-align:center; padding-top:30px;color:#333;">                       
                            240% (up to) increased productivity in<br> companies with poor culture and management
                        </p>
                    </div>
                </div> 
                <p class="alone" style="text-align:center;color:#333;">73% opt in to StaffLife, although that varies with staff quality and industry</p>         
                <div class="twentypxspacer"></div>
            </div>
        </div>
    </div>
    <!--end of we guarantee minimum of -->
    <!-- 3-col section END -->
    <!-- Second section Start -->
    <div>
        <div class="line-bar" style="background-color: white !important;">
            <a style="text-decoration:none;color:#ee6f00;">New employees: preventing bad hires before they happen</a>
        </div>
        <div>
            <div class="work container">
                <div class="col-sm-14">
                    <p style="text-align:center;color:#333;">If consumers were given the option of a credit profile, it's unlikely
                        that irresponsible users would opt in, while those who value their credit history would.</p>
                    <p style="text-align:center;color:#333;">Similarly, questionable job applicants who do not want their conduct
                        and performance measured, evaluated or recorded are exposed by the <br>StaffLife system (usually
                        before the interview).</p>
                </div>
            </div>
        </div>
        <!-- Second section END -->
        <!-- Third section Start -->
        <div style="padding:30px 0 18px 0; margin-top:20px;">
            <div class="container  text-center">
                <div class="col-sm-6">                
                    <div id="myStat6" class="center-block" data-startdegree="0" data-dimension="160"
                         data-text="94%" data-width="10" data-fontsize="28" data-percent="94"
                         data-fgcolor="#4CAF50" data-bgcolor="#F4A560" style="margin-bottom:30px;"></div>
                    <div class="dttxtpad twentypxspacer"></div>
                    <span style="color:#333;">improved conduct</span>
                    <p style="text-align:center; padding-top:30px;color:#333;">                            
                        91% of undesirables prevented from joining your organisation
                    </p>
                </div>
                <div class="col-sm-6">
                    <div id="myStat7" class="center-block" data-startdegree="0" data-dimension="160"
                         data-text="91%" data-width="10" data-fontsize="28" data-percent="91"
                         data-fgcolor="#4CAF50" data-bgcolor="#F4A560" style="margin-bottom:30px;"></div>
                    <div class="dttxtpad twentypxspacer"></div>
                    <span style="color:#333;">improved performance</span>
                    <p style="text-align:center; padding-top:30px;color:#333;">                            
                        40% cut in unnecessary interviews
                    </p>
                </div>
            </div>
            <div class="twentypxspacer"></div>
            <div style="height:20px;"></div>
        </div>
    </div>    
    <!-- Third section END -->
    <div>
        <div class="line-bar">
            <a style="text-decoration:none;color:white;">HR success in 3 easy steps</a>
        </div>
        <div>            
            <div class="container text-center" style="margin-top:35px;">                
                <div class="row addpad">
                    <div class="col-sm-4">
                        <img src="{{ asset('assets/images/member.png') }}" class="top3 img100width"
                             alt="icon showing a group of people">
                        <div class="dttxtpad twentypxspacer"></div>
                        <p class="hometxtcenter">Become a StaffLife Member. Any registered<br> business can join within
                            minutes and<br> approval within a few hours.</p>
                    </div>
                    <div class="col-sm-4">
                        <img src="{{ asset('assets/images/hand.png') }}" class="top3 img100width"
                             alt="icon showing scales">
                        <div class="dttxtpad twentypxspacer"></div>
                        <p class="hometxtcenter">Print StaffLife consent forms for existing staff<br> and new applicants to
                            sign. Avoid applicants<br> who refuse.</p>
                    </div>
                    <div class="col-sm-4">
                        <img src="{{ asset('assets/images/data.png') }}" class="top3 img100width"
                             alt="icon showing a document with tick marks">
                        <div class="dttxtpad twentypxspacer"></div>
                        <p class="hometxtcenter">Review your staff monthly, quarterly or at<br> your own intervals.
                            Performance and conduct<br> reviews only take minutes to submit.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- facts section Start -->
    <div class="whitebghome">
        <div class="line-bar" style="background-color:white !important;">
            <a style="text-decoration:none;color:#4CAF4F;">Benefits for everyone</a>
        </div>
        <div class="container text-center">            
            <div class="col-sm-4">
                <h3 class="homeheading hometxtcenter t30b30" style="color:#333;">Your business</h3>
                <ul>
                    <li class="linkstyleb">Use StaffLife as an incentive instead of ineffective monetary rewards
                    </li>
                    <li class="linkstyleb">Higher customer retention rates and improved customer service
                    </li>
                    <li class="linkstyleb">The biggest expense (by a wide margin) for most businesses is human
                        resources.
                    </li>
                    <li class="linkstyleb">Our employee consent form protects your business (not only in terms of
                        StaffLife)
                    </li>
                    <li class="linkstyleb">Better: punctuality, motivation, attitude and employee retention
                    </li>
                    <li class="linkstyleb">Reduce no-shows and insufficient notice periods
                    </li>
                    <li class="linkstyleb">Prevent damaging, malicious public comments by disgruntled employees
                    </li>
                    <li class="linkstyleb">Protection against employees that habitually take legal action against
                        employers
                    </li>
                    <li class="linkstyleb">Lower: absenteeism, aloofness,
                        irresponsible {{ __('stafflife.behaviour') }} and even theft
                    </li>
                </ul>
            </div>            
            <div class="col-sm-4">
                <h3 class="homeheading hometxtcenter t30b30" style="color:#333;">Your HR team</h3>                
                <ul>
                    <li class="linkstyleb">Higher retention rates mean less training and far better culture and team
                        synergies
                    </li>
                    <li class="linkstyleb">Data submissions are a powerful tool to assist HR's employee management
                    </li>
                    <li class="linkstyleb">Simple to use dashboard with tick boxes for reviews and excellent Member
                        support
                    </li>
                    <li class="linkstyleb">Our employee consent form protects your business (not only in terms of
                        StaffLife)
                    </li>
                    <li class="linkstyleb">Assists HR in producing management employee performance reviews (if
                        required)
                    </li>
                    <li class="linkstyleb">Avoid unnecessary, lengthy interviews with candidates who refuse to opt
                        in
                    </li>
                    <li class="linkstyleb">Spend less time on disciplinary actions and improve relations between
                        staff and HR
                    </li>
                    <li class="linkstyleb">Lower HR costs allows to divert budgets into meaningful areas such as
                        team activities
                    </li>
                    <li class="linkstyleb">On average, it costs $40k to replace an employee (US) - reduce
                        recruitment expenses
                    </li>
                </ul>                
            </div>            
            <div class="col-sm-4">
                <h3 class="homeheading hometxtcenter t30b30" style="color:#333;">Your employees</h3>
                <ul>
                    <li class="linkstyleb">Reward good employees with long-lasting positive reviews
                    </li>
                    <li class="linkstyleb">Enable performing individuals to distinguish themselves from others
                    </li>
                    <li class="linkstyleb">Create a transparent environment for employees with direct access to
                        their Profiles
                    </li>
                    <li class="linkstyleb">Better culture and morale makes employees happier at work
                    </li>
                    <li class="linkstyleb">Increased accountability and rewards help employees strive to do their
                        best
                    </li>
                    <li class="linkstyleb">Clear reviews help your staff better understand where they need to
                        improve
                    </li>
                    <li class="linkstyleb">Avoid hiring the wrong employees who may be devastated to lose their job
                    </li>
                    <li class="linkstyleb">Multiple systems protect employees against malicious/inaccurate Member
                        reviews
                    </li>
                </ul>
            </div>            
        </div>
        <div style="height:50px;"></div>
    </div>
    <!-- facts section END -->
    <!-- First section Start -->
    <div>
        <div class="line-bar">
            <a style="text-decoration:none;color:white;">We guarantee results - or we'll pay you up to $35 000</a>
        </div>
        <div style="margin-top:20px;">
            <div class="container">
            <div class="col-sm-5">
                <h3 class="homeheading hometxtcenter t30b30" style="color:#333;">Our Guarantee</h3>
                <p style="text-align:center;">StaffLife is so effective, that we've decided to implement a<br> guarantee
                        unlike anything in human resources before.</p>
                <p style="text-align:center;">Use StaffLife for 6 months, and if you are not absolutely<br> convinced
                    that StaffLife has transformed your business, we will<br> reimburse you triple your fees!**
                </p>              
                <p style="text-align:center">** Subject to the StaffLife guarantee policy. Claims are
                    only<br> accepted between month 6 and 7. Reimbursed Members are<br> barred from joining again.</p><br>
                <p style="text-align: center"><a class="btn success" style="font-size: 16px;width:90%;padding:12px 0 !important;"
                    data-toggle="modal" data-target="#myModal">View Guarantee Policy</a>
                </p><br>
                <p style="text-align: center"><a class="btn success" style="font-size: 16px;width:90%;padding:12px 0 !important;"
                    href="{{ route('pricing', session('custom_lang')) }}">Plans and Pricing</a>
                </p><br>
                <p style="text-align: center"><a class="btn success" style="font-size: 16px;width:90%;padding:12px 0 !important;"
                                                href="{{ route('/business/subscribe', [session('custom_lang'),'package' => 'standard', 'yearly' => 'monthly']) }}">TRY IT FREE</a>
                </p><br>  
                <p style="color:#757b87;text-align:center;">14-day free trial. No credit card required.</p>                 
            </div>        
            <div class="col-sm-7">
                <h3 class="homeheading hometxtcenter t30b30" style="color:#333;">Interesting facts and stats you may not know</h3>
                <ul style="text-decoration:none;">
                    <li class="linkstyleb">53% (78% according to some statistics) of CVs contain false or misleading
                        information
                    </li>
                    <li class="linkstyleb">Most lied about in CVs: qualifications, references, skills and experience
                    </li>
                    <li class="linkstyleb">If you employ 7 people, you are very likely to have at least 1 "bad
                        apple" spoiling the cart
                    </li>
                    <li class="linkstyleb">Unhappy {{ strtolower(__('stafflife.labour')) }} force, absenteeism and
                        incompetence, costs more than $1 trillion a year in<br> the US alone
                    </li>
                    <li class="linkstyleb">Studies have shown that a team performs almost as low as the level of
                        their weakest<br> member
                    </li>
                    <li class="linkstyleb">The biggest expense (by a wide margin) for most businesses is human
                        resources
                    </li>
                    <li class="linkstyleb">The average time spent by recruiters looking at a resume is 5 to 7
                        seconds
                    </li>
                    <li class="linkstyleb">70% of college students surveyed, would lie on a resume to get a job they
                        wanted
                    </li>
                    <li class="linkstyleb">A "bad hire" that leaves within six months, costs an average of $40,000
                        in training, wasted HR time, etc.
                    </li>
                    <li class="linkstyleb">Increasing staff engagement by 10% can increase profits by $2,400 per
                        employee per year
                    </li>
                    <li class="linkstyleb">Weak culture or poorly performing employees, is amongst the top 3 reasons
                        why businesses fail
                    </li>
                    <li class="linkstyleb">85% of companies in the US perform pre-employment checks. Far higher than
                        ever before
                    </li>
                </ul>
            </div>                    
        </div>
        <div style="height:30px;"></div>
    </div>
    <!-- Third section END -->
    <div>  
        <div style="height:25px;"></div>      
        <p class="text-center">Members are free to hire any applicant who refuses to join
            StaffLife, although it is not advised.</p>
        <p class="text-center">*The statistics have been compiled using analysis and
            extrapolation of data provided by Members and Employees as of August 2017.</p>
        <div style="height:25px;"></div>
    </div>
    <!-- facts section END -->
    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="background-color:#f0f0f0; border-radius:10px;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 style="text-align:center;" class="homeheadingb">Guarantee Policy</h3>
                </div>
                <div class="modal-body">
                    <div class="mobilepr">
                        <h4 style="padding-bottom:10px;" class="homeheadingb">Subject to the following terms and
                            conditions, StaffLife will reimburse any Member triple of all paid fees to SL, up to USD35
                            000.</h4>
                        <p>The claim must reach StaffLife in writing (email or via the SL dashboard), between month 6
                            and 7 after the initial payment made to StaffLife. </p>
                        <p>The Member is required to setup at least 25% of employees (active) permitted within their
                            Package (on average over the six month period). </p>
                        <p>Members who claim will no longer be able to participate in any way within the StaffLife
                            system. This is to prevent Members who benefit from StaffLife but abuse our Guarantee
                            Policy. </p>
                        <p>Members who have claimed from StaffLife and attempt to join again using an alias or a
                            different company, will be reported to the local authorities for fraud, and liable for
                            repayment of the full reimbursement received, with interest and adjusted for inflation. </p>
                        <p>Members who are found to abuse the Guarantee Policy, by creating fictitious documentation or
                            accounts, will not be reimbursed and will be reported to the local authorities for
                            fraud.</p>
                        <p>StaffLife reserves the right to ban any Member from the StaffLife system, without
                            notice. </p>
                        <p>No reimbursement shall exceed USD35 000. </p>
                        <p>Processing of claims may take up to 30 days from the date upon which the claim reaches
                            StaffLife. </p>
                        <div style="height:10px;"></div>
                    </div>
                    <div class="desktpr">
                        <h4 style="padding-bottom:10px;" class="homeheadingb">Subject to the following terms and
                            conditions, StaffLife will reimburse any Member triple of all paid fees to SL, up to USD35
                            000.</h4>
                        <p>The claim must reach StaffLife in writing (email or via the SL dashboard), between month 6
                            and 7 after the initial payment made to StaffLife. </p>
                        <p>The Member is required to setup at least 25% of employees (active) permitted within their
                            Package (on average over the six month period). </p>
                        <p>Members who claim will no longer be able to participate in any way within the StaffLife
                            system. This is to prevent Members who benefit from StaffLife but abuse our Guarantee
                            Policy. </p>
                        <p>Members who have claimed from StaffLife and attempt to join again using an alias or a
                            different company, will be reported to the local authorities for fraud, and liable for
                            repayment of the full reimbursement received, with interest and adjusted for inflation. </p>
                        <p>Members who are found to abuse the Guarantee Policy, by creating fictitious documentation or
                            accounts, will not be reimbursed and will be reported to the local authorities for
                            fraud.</p>
                        <p>StaffLife reserves the right to ban any Member from the StaffLife system, without
                            notice. </p>
                        <p>No reimbursement shall exceed USD35 000. </p>
                        <p>Processing of claims may take up to 30 days from the date upon which the claim reaches
                            StaffLife. </p>
                        <div style="height:10px;"></div>
                    </div>
                </div>
                <div class="modal-footer" style="background-color:#f0f0f0; border-radius:10px;">
                    <p style="text-align:center;">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </p>
                </div>
            </div>
        </div>
    </div>
    </div>
</html>
@stop
{{-- footer scripts --}}
@section('footer_scripts')
    <!-- page level js starts-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!--page level js ends-->
    <!-- page level js starts-->
    <script type="text/javascript" src="{{ asset('assets/js/frontend/jquery.circliful.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/wow/js/wow.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/owl_carousel/js/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/frontend/carousel.js') }}"></script>
    <!--page level js ends-->
    <script>
        $("#pricing_burb").hide();

        // skills sliders
        $(document).ready(function () {
            new WOW().init();
            $('#myStat3').circliful();
            $('#myStat4').circliful();
            $('#myStat5').circliful();
            $('#myStat6').circliful();
            $('#myStat7').circliful();
            $('#myStat8').circliful();
            //accordians tab panels toggle buttons
            $('.collapse').on('shown.bs.collapse', function () {
                $(this).parent().find(".glyphicon-plus").removeClass("glyphicon-plus").addClass("glyphicon-minus");
            }).on('hidden.bs.collapse', function () {
                $(this).parent().find(".glyphicon-minus").removeClass("glyphicon-minus").addClass("glyphicon-plus");
            });
        });

    </script>
@stop