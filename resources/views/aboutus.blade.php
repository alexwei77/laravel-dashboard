<?php $og = new OpenGraph();
$og->title('About-Us - StaffLife.com')
    ->image("")
    ->description("A world-first Employee Ethics & Performance Data Bureau, StaffLife prevents you from hiring the wrong people, and improves the efficiency of current employees.")
    ->url();
?>
        <!DOCTYPE html>
<html lang="en">
<head>
    {!! $og->renderTags() !!}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
          content="A world-first Employee Ethics & Performance Data Bureau, StaffLife prevents you from hiring the wrong people, and improves the efficiency of current employees.">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    @include('layouts/csp')
</head>

@extends('layouts/defaultboth')

{{-- Page title --}}
@section('title')
    About us
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <!--page level css starts-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/indexboth.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/aboutus.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/animate/animate.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/owl_carousel/css/owl.carousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/owl_carousel/css/owl.theme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/devicon/devicon.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/devicon/devicon-colors.css') }}">
    <!--end of page level css-->
@stop

<style>

    p.faqtextsml {
        color: #000000;
    }

    body {
        margin-top: -20px !important;
    }

    @media screen and (min-width: 768px) and (max-width: 1024px) {
        .mobdesk {
            display: none;
        }
    }

    @media screen and (max-width: 1024px) {
        .mobdesk2 {
            display: none;
        }
    }

    @media screen and (max-width: 767px) {
        .ipd1 {
            display: none;
        }
    }

    @media screen and (min-width: 1025px) {
        .ipd2 {
            display: none;
        }
    }
</style>

{{-- Page content --}}
@section('content')
    <!-- Container Section Start -->
    <div class="font-open-sans">
        <div class="jumbotext text-center">
            <h1>About</h1>
        </div>

        <div>
            <div class="container mobdesk">
                <div class="row" style="padding-top:20px;">
                    <div class="col-sm-6">
                        <h3 class="homeheading martop" style="margin-top:30px;">Changing the Employment Relationship,
                            Forever.</h3>
                        <hr class="homehr">
                        <p class="faqtextsml" style="padding-bottom:20px; text-align:left; color:#000000;">One of the
                            biggest obstacles a business faces is employing the wrong individuals, and lack of employee
                            accountability within the workplace. Toxic employees can cost a business a fortune in salaries,
                            opportunity costs and to add insult to injury,
                            false {{ __('stafflife.labourdisputereferralform') }} claims.<br/><br/>

                            Not only can these individuals wreak havoc on your business, but you may have just unknowingly
                            hired one of them. Employees are free to remove positions from their CVs and LinkedIn profiles,
                            with absolutely no repercussions. Until now. <br/><br/>

                            StaffLife will prevent hiring the wrong people, and will improve the overall efficiency and
                            productivity of your existing employees. Join today, and transform your business.</p>
                    </div>
                    <div class="col-sm-6">
                        <div class="mobdesk2">
                            <img src="{{ asset('assets/images/about1.jpg') }}" class="maximageb hideonmobi"
                                style="max-width:100%;" alt="Tablet and phone with StaffLife images">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="text-center">
                            <a class="btn successb"
                            href="{{ route('/business/subscribe', [session('custom_lang'),'package' => 'standard', 'yearly' => 'monthly']) }}"
                            style="color:#ffffff;margin-bottom:20px;">START MY FREE TRIAL</a>
                            <p class="hometextbiga">14-day free trial. No credit card required.</p>
                            <p class="hometextbigb"><a class="makeorange"
                                                    href="{{ route('pricing', session('custom_lang')) }}">See Plans and
                                    Pricing</a></p>
                            <div style="height:20px;"></div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="container ipd1 ipd2">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="homeheading martop" style="margin-top:30px;">Changing the Employment Relationship,
                            Forever.</h3>
                        <hr class="homehr">
                        <p class="faqtextsml" style="padding-bottom:20px; text-align:left; color:#000000;">One of the
                            biggest obstacles a business faces is employing the wrong individuals, and lack of employee
                            accountability within the workplace. Toxic employees can cost a business a fortune in salaries,
                            opportunity costs and to add insult to injury,
                            false {{ __('stafflife.labourdisputereferralform') }} claims.<br/><br/>

                            Not only can these individuals wreak havoc on your business, but you may have just unknowingly
                            hired one of them. Employees are free to remove positions from their CVs and LinkedIn profiles,
                            with absolutely no repercussions. Until now. <br/><br/>

                            StaffLife will prevent hiring the wrong people, and will improve the overall efficiency and
                            productivity of your existing employees. Join today, and transform your business.</p>
                        <div class="text-center" style="margin-top:30px;">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="text-center">
                            <a class="btn successb" href="{{ route('pricing', session('custom_lang')) }}"
                            style="color:#ffffff;margin-bottom:20px;">START MY FREE TRIAL</a>
                            <p class="hometextbiga">14-day free trial. No credit card required.</p>
                            <p class="hometextbigb"><a class="makeorange"
                                                    href="{{ route('pricing', session('custom_lang')) }}">See Plans and
                                    Pricing</a></p>
                            <div style="height:20px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div style="background-color:#f4f4f4;">
            <div class="container mobdesk" style="padding-top:40px;">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mobdesk">
                            <img src="{{ asset('assets/images/about2.jpg') }}" class="maximageb"
                                style="max-width:100%; padding-top:40px !important;"
                                alt="Man working on ideas on a laptop">
                        </div>
                        <div class="ipd1 ipd2">
                            <img src="{{ asset('assets/images/about2i.jpg') }}" class="maximageb"
                                style="max-width:100%; padding-top:40px !important;"
                                alt="Man working on ideas on a laptop">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <h3 class="homeheading martop">About Us.</h3>
                        <hr class="homehr">
                        <p class="faqtextsml" style="padding-bottom:20px; text-align:left; color:#000000;">Talk about our
                            experience in one of the world's global leaders in risk-management - CGS (Cheque Guarantee
                            Services). It has taken nearly 5 years of research and development to create StaffLife. The
                            reason this kind of model has never been started before is because of 6 major issues, which
                            until now were not overcome. While we cannot divulge our IP, algorithms and data management
                            systems, here are some of the challenges that StaffLife has resolved:<br/><br/>
                            Fairness: the business environment has always been in favour of the employee by providing no
                            continuity between employers (stealing from one employers simply meant you moved on to the
                            next). A major challenge was to create an ethical, fair system whereby employers would not be
                            able to take advantage of the system by falsely blacklisting employees. Our solution was to
                            provide mechanisms to enable employees to challenge information in a simple and reliable manner
                            (among many other solutions in place to ensure absolute fairness).</p>
                    </div>
                </div>
            </div>

            <div class="container ipd1 ipd2">
                <div class="row">
                    <div class="col-sm-12">
                        <img src="{{ asset('assets/images/about4.jpg') }}" class="maximageb"
                            style="max-width:100%; padding-top:50px !important;" alt="Man working on ideas on a laptop">
                    </div>
                    <div class="col-sm-12">
                        <h3 class="homeheading martop">About Us.</h3>
                        <hr class="homehr">
                        <p class="faqtextsml" style="padding-bottom:20px; text-align:left; color:#000000;">Talk about our
                            experience in one of the world's global leaders in risk-management - CGS (Cheque Guarantee
                            Services). It has taken nearly 5 years of research and development to create StaffLife. The
                            reason this kind of model has never been started before is because of 6 major issues, which
                            until now were not overcome. While we cannot divulge our IP, algorithms and data management
                            systems, here are some of the challenges that StaffLife has resolved:<br/><br/>
                            Fairness: the business environment has always been in favour of the employee by providing no
                            continuity between employers (stealing from one employers simply meant you moved on to the
                            next). A major challenge was to create an ethical, fair system whereby employers would not be
                            able to take advantage of the system by falsely blacklisting employees. Our solution was to
                            provide mechanisms to enable employees to challenge information in a simple and reliable manner
                            (among many other solutions in place to ensure absolute fairness).</p>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="container mobdesk" style="padding-top:40px;">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="homeheading martop">Story.</h3>
                        <hr class="homehr">
                        <p class="faqtextsml" style="padding-bottom:20px; text-align:left; color:#000000;">Dr Mark Taitz
                            founded StaffLife after more than 20 years of growing start-ups and established businesses
                            across Africa, Europe and North America. With decades of risk-management experience and hiring
                            of thousands of candidates across multiple continents, Mark has used his insights and experience
                            in creating a world-first Employee Ethics & Performance Data Bureau.<br/><br/>
                            It was while working with various enterprises that Mark identified the need for an advanced
                            system that empowered employers to steer clear of toxic, low performing employees, and attract
                            recruits who would benefit their business.<br/><br/>
                            It has taken nearly 5 years of development to build StaffLife. From advanced databases and
                            protection mechanisms, to mammoth challenges that required complex solutions. Dozens of
                            dedicated minds and countless hours of creativity and problem solving has led to the creation of
                            the world's first Employee History Data Bureau.
                        </p>
                    </div>
                    <div class="col-sm-6">
                        <div>
                            <img src="{{ asset('assets/images/about3.jpg') }}" class="maximageb" style="max-width:100%;"
                                alt="Picture of an open laptop">
                        </div>
                    </div>
                </div>
            </div>

            <div class="container ipd1 ipd2">
                <div class="row">
                    <div class="col-sm-12">
                        <div>
                            <img src="{{ asset('assets/images/about5.jpg') }}" class="maximageb" style="max-width:100%;"
                                alt="Picture of an open laptop">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <h3 class="homeheading martop">Story.</h3>
                        <hr class="homehr">
                        <p class="faqtextsml" style="padding-bottom:20px; text-align:left; color:#000000;">Dr Mark Taitz
                            founded StaffLife after more than 20 years of growing start-ups and established businesses
                            across Africa, Europe and North America. With decades of risk-management experience and hiring
                            of thousands of candidates across multiple continents, Mark has used his insights and experience
                            in creating a world-first Employee Ethics & Performance Data Bureau.<br/><br/>
                            It was while working with various enterprises that Mark identified the need for an advanced
                            system that empowered employers to steer clear of toxic, low performing employees, and attract
                            recruits who would benefit their business.<br/><br/>
                            It has taken nearly 5 years of development to build StaffLife. From advanced databases and
                            protection mechanisms, to mammoth challenges that required complex solutions. Dozens of
                            dedicated minds and countless hours of creativity and problem solving has led to the creation of
                            the world's first Employee History Data Bureau.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div style="background-color:#f4f4f4;">
            <!-- Tabs Navigation Start -->
            <div class="container addpad" style="padding-top:30px !important;">
                <ul class="navb nav-tabsb paddt" style="margin-top:30px;">
                    <li class="active"><a data-toggle="tab" href="#home">Employer Benefits</a></li>
                    <li><a data-toggle="tab" href="#menu1">Employee Benefits</a></li>
                </ul>

                <!-- Tabs Navigation End -->

                <!-- Both Tabs Content Start -->

                <div class="tab-content">

                    <!-- Tab 1 Content Start -->

                    <div id="home" class="tab-pane fade in active">
                        <div class="container addpadf">
                            <div class="row" style="margin-bottom:30px;">
                                <div class="col-sm-4">
                                    <p class="faqtextbig text-center">Employee Accountability</p>
                                    <p class="maximagec"><img src="{{ asset('assets/images/about1.png') }}"
                                                            alt="Icon of a woman with an hourglass">
                                    <p>
                                    <p class="faqtextsml text-center">For the first time, employees will not be able to hide
                                        their past malicious behaviour from employers. Your employees will perform at an
                                        optimal level, knowing they are building up their StaffLife profile.</p>
                                    <hr class="mobilehr">
                                </div>
                                <div class="col-sm-4">
                                    <p class="faqtextbig text-center">Avoid bad hires</p>
                                    <p class="maximagec"><img src="{{ asset('assets/images/about2.png') }}"
                                                            alt="Icon of a man with a minus sign">
                                    <p>
                                    <p class="faqtextsml text-center">Hiring the wrong individual can cost a business a
                                        fortune in salaries, and the opportunity cost of not being able to properly vet
                                        candidates. StaffLife eliminates this problem.</p>
                                    <hr class="mobilehr">
                                </div>
                                <div class="col-sm-4">
                                    <p class="faqtextbig text-center">Avoid
                                        the {{ __('stafflife.labourdisputereferralform') }}</p>
                                    <p class="maximagec"><img src="{{ asset('assets/images/about3.png') }}"
                                                            alt="icon of shaking hands">
                                    <p>
                                    <p class="faqtextsml text-center">Many employees maliciously take their employers to
                                        the {{ __('stafflife.labourdisputereferralform') }} with no foundation, knowing that
                                        future employers will not know about this. With StaffLife, information on
                                        foundationless and frivolous cases will be available to you when hiring a
                                        candidate.</p>
                                    <hr class="mobilehr">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <p class="faqtextbig text-center">Save Operational Costs</p>
                                    <p class="maximagec"><img src="{{ asset('assets/images/about4.png') }}"
                                                            alt="Icon of a hand holding a dollar sign">
                                    <p>
                                    <p class="faqtextsml text-center">With employees working harder and more efficiently,
                                        your business will run on a smaller, more effective staff compliment. This reduces
                                        costs, which increases profits.</p>
                                    <hr class="mobilehr">
                                </div>
                                <div class="col-sm-4">
                                    <p class="faqtextbig text-center">Find the best talent</p>
                                    <p class="maximagec"><img src="{{ asset('assets/images/about5.png') }}"
                                                            alt="Icon of a graduation hat">
                                    <p>
                                    <p class="faqtextsml text-center">By having reliable and factual information about an
                                        employee from previous employers, you can identify and employ the top individuals in
                                        your industry.</p>
                                    <hr class="mobilehr">
                                </div>
                                <div class="col-sm-4">
                                    <p class="faqtextbig text-center">Reduce staff turnover</p>
                                    <p class="maximagec"><img src="{{ asset('assets/images/about6.png') }}"
                                                            alt="Icon of two people swapping">
                                    <p>
                                    <p class="faqtextsml text-center">By avoiding the wrong hires and increasing
                                        productivity, staff turnover will drop significantly. Not only will you avoid hiring
                                        the wrong individuals, but your existing employees will perform at a higher
                                        level.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 1 Content End -->

                    <!-- Tab 2 Content Start -->

                    <div id="menu1" class="tab-pane fade">
                        <div class="container addpadf">
                            <div class="row">
                                <div class="col-sm-4">
                                    <p class="faqtextbig text-center">Get your dream job</p>
                                    <p class="maximagec"><img src="{{ asset('assets/images/about7.png') }}"
                                                            alt="Icon of a woman with a tick mark">
                                    <p>
                                    <p class="faqtextsml text-center">Future employers will have access to your excellent
                                        employment history, and will favour your application over other applications.</p>
                                    <hr class="mobilehr">
                                </div>
                                <div class="col-sm-4">
                                    <p class="faqtextbig text-center">Get the salary you deserve</p>
                                    <p class="maximagec"><img src="{{ asset('assets/images/about4.png') }}"
                                                            alt="Icon of a hand holding a dollar sign">
                                    <p>
                                    <p class="faqtextsml text-center">By eliminating poor-performing and malicious employees
                                        from the pool of candidates, you will be offered a higher salary for your
                                        position!</p>
                                    <hr class="mobilehr">
                                </div>
                                <div class="col-sm-4">
                                    <p class="faqtextbig text-center">Give Reliable References</p>
                                    <p class="maximagec"><img src="{{ asset('assets/images/about8.png') }}"
                                                            alt="Icon of people surrounded by a circle">
                                    <p>
                                    <p class="faqtextsml text-center">Prospective employers will for the first time in
                                        history trust the references on your StaffLife profile, making it much easier for
                                        you to obtain the position you want.</p>
                                    <hr class="mobilehr">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <p class="faqtextbig text-center">Get Promoted Sooner</p>
                                    <p class="maximagec"><img src="{{ asset('assets/images/about9.png') }}"
                                                            alt="Icon of a man with a plus sign">
                                    <p>
                                    <p class="faqtextsml text-center">With your StaffLife profile being updated regularly,
                                        your employer will clearly see how your performance exceeds that of your
                                        colleagues', making your path to a promotion that much shorter.</p>
                                    <hr class="mobilehr">
                                </div>
                                <div class="col-sm-4">
                                    <p class="faqtextbig text-center">Build a powerful CV</p>
                                    <p class="maximagec"><img src="{{ asset('assets/images/about10.png') }}"
                                                            alt="Icon of people with a rising graph in from of them">
                                    <p>
                                    <p class="faqtextsml text-center">CVs are notoriously unreliable, and positive
                                        applications are often overlooked and not trusted by companies. With StaffLife,
                                        positive reviews from past employers will be instantly relied upon when selecting
                                        the best applicant. Strong candidates will easily beat their competition.</p>
                                </div>
                                <div class="col-sm-4">
                                    <p class="faqtextbig text-center">Get more out of your colleagues</p>
                                    <p class="maximagec"><img src="{{ asset('assets/images/about11.png') }}"
                                                            alt="Icon of three people standing together">
                                    <p>
                                    <p class="faqtextsml text-center">Gone are the days of having to carry your colleagues'
                                        workloads to meet deadlines. With all employees in
                                        the {{ __('stafflife.organization') }} on StaffLife, other members of the team will
                                        pull their weight, meaning you get to focus more on your own work.</p>
                                    <hr class="mobilehr">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Tab 2 Content End -->
            </div>

        </div>
    </div>

</html>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <!-- page level js starts-->
    <script type="text/javascript" src="{{ asset('assets/vendors/owl_carousel/js/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/wow/js/wow.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/frontend/carousel.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/frontend/aboutus.js') }}"></script>
    <!--page level js ends-->

@stop
