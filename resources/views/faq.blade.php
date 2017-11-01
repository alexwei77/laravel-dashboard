<?php $og = new OpenGraph(); 
$og->title('FAQ - StaffLife.com')
        ->image("")
        ->description("Browse our frequently asked questions if you are looking for more information on why StaffLife is a must for any business that is serious about getting ahead.")
        ->url();
?>
<!DOCTYPE html>
<html lang="en">
<head>
{!! $og->renderTags() !!}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
          content="Browse our frequently asked questions if you are looking for more information on why StaffLife is a must for any business that is serious about getting ahead.">
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
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/faq.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/indexboth.css') }}">
    <!--end of page level css-->
    <style>

        body {
            margin-top: -20px !important;
        }
    </style>
@stop

{{-- Page content --}}
@section('content')
    <!-- Container Section Start -->
    <div class="font-open-sans">
        <div class="jumbotext text-center">
            <h1>Frequently Asked Questions</h1>
        </div>

        <!-- FAQ Section Start -->
        <div class="container marbottom" style="padding-top:30px !important; padding-bottom:20px;">

            <ul class="navb nav-tabsb" style="padding-bottom:10px;">
                <li id="employer_tab" class="active"><a data-toggle="tab" href="#home">Employers</a></li>
                <li id="employee_tab"><a data-toggle="tab" href="#menu1">Employees</a></li>
            </ul>
            <div class="tab-content" id="faq">
                <div id="home" class="tab-pane fade in active">
                    <div class="container addpadf">
                        <div class="panel-group" id="faqAccordion">
                            <div class="panel panel-default">
                                <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse"
                                    data-parent="#faqAccordion" data-target="#question0">
                                    <p class="faqtextbigb">
                                        <a href="#question0" class="ing">1. How does it work?</a>
                                    </p>

                                </div>
                                <div id="question0" class="panel-collapse collapse" style="height: 0px;">
                                    <div class="panel-body">
                                        <p class="faqtextsml">The StaffLife system will transform your business, by
                                            introducing a true system of accountability, and acting as an invaluable tool
                                            when filtering candidates' applications. As a member, you will generate a
                                            StaffLife Indemnification and Permission (SLIP) form for each of your
                                            employees. This allows you to update your employees’ profiles regularly, with
                                            both positive and negative information.<br/><br/>
                                            The SLIP form will also be signed by candidates, which will allow you to look up
                                            their StaffLife profile and identify a pattern of behaviour. Unlike references,
                                            which are all glowingly positive, StaffLife offers the first ever objective,
                                            unfiltered employee review. Your business will improve rapidly by hiring and
                                            retaining only the best candidates.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default ">
                                <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse"
                                    data-parent="#faqAccordion" data-target="#question14">
                                    <p class="faqtextbigb">
                                        <a href="#question14" class="ing">2. How does StaffLife benefit me as an
                                            employer?</a>
                                    </p>

                                </div>
                                <div id="question14" class="panel-collapse collapse" style="height: 0px;">
                                    <div class="panel-body">
                                        <p class="faqtextsml">StaffLife has been designed to provide your company with a
                                            detailed professional history and track record of an employee. This allows you
                                            to protect your company by hiring the right people. Good employees will reap the
                                            rewards of a consistently clean track record, and ineffable employees will be
                                            prompted to take steps to improve. This drive for transparency between employer
                                            and employee is what will revolutionise the global hiring and employment
                                            industry.

                                        <!-- StaffLife will make your employees accountable for their
                                            actions, and will be invaluable in hiring the best individuals. By having all
                                            your employees on the system, you protect yourself and other employers against
                                            dishonest conduct and false {{ __('stafflife.labourregulatorbody') }} claims. The system has been designed to
                                            provide your company with a detailed professional history and track record of an
                                            employee. --></p>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default ">
                                <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse"
                                    data-parent="#faqAccordion" data-target="#question1">
                                    <p class="faqtextbigb">
                                        <a href="#question1" class="ing">3. How do I sign up?</a>
                                    </p>

                                </div>
                                <div id="question1" class="panel-collapse collapse" style="height: 0px;">
                                    <div class="panel-body">
                                        <p class="faqtextsml">Signing up is quick and easy. Start by registering your
                                            company <a style="color:#ee6f00" href="{{ route('/business/subscribe', [session('custom_lang'),'package' => 'standard', 'yearly' => 'monthly']) }}">here</a>. Once
                                            you've registered, you will then be able to add each of your employees and start
                                            benefiting from StaffLife..</p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default ">
                                <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse"
                                    data-parent="#faqAccordion" data-target="#question2">
                                    <p class="faqtextbigb">
                                        <a href="#question2" class="ing">4. How much does it cost me?</a>
                                    </p>

                                </div>
                                <div id="question2" class="panel-collapse collapse" style="height: 0px;">
                                    <div class="panel-body">
                                        <p class="faqtextsml">We have various membership packages (please see our <a
                                                    href="{{ route('pricing', session('custom_lang')) }}">pricing</a>
                                            page) which will give you a certain number of credits per month. One credit per
                                            employee per month is utilised. Searches (if required) are an additional one
                                            credit.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default ">
                                <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse"
                                    data-parent="#faqAccordion" data-target="#question3">
                                    <p class="faqtextbigb">
                                        <a href="#question3" class="ing">5. How does StaffLife improve the performance of my
                                            employees?</a>
                                    </p>

                                </div>
                                <div id="question3" class="panel-collapse collapse" style="height: 0px;">
                                    <div class="panel-body">
                                        <p class="faqtextsml">If your employees have signed the Staff Life Indemnification
                                            Permission (SLIP) form, they have consented to their profiles being updated by
                                            you (as their employer). This means that your employees are unlikely to act
                                            maliciously or dishonestly, as they will be accountable for these acts.
                                            Employees who apply themselves are ultimately rewarded with a positive
                                            employment history..</p>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default ">
                                <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse"
                                    data-parent="#faqAccordion" data-target="#question23">
                                    <p class="faqtextbigb">
                                        <a href="#question23" class="ing">6. How does StaffLife benefit me as an
                                            employer?</a>
                                    </p>

                                </div>
                                <div id="question23" class="panel-collapse collapse" style="height: 0px;">
                                    <div class="panel-body">
                                        <p class="faqtextsml">StaffLife has been designed to provide your company with a
                                            detailed professional history and track record of an employee. This allows you
                                            to protect your company by hiring the right people. Good employees will reap the
                                            rewards of consistently clean track record, and ineffable employees will be
                                            prompted to take steps to improve. This drive for transparency between employer
                                            and employee is what will revolutionise the global hiring and employment
                                            industry.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default ">
                                <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse"
                                    data-parent="#faqAccordion" data-target="#question4">
                                    <p class="faqtextbigb">
                                        <a href="#question4" class="ing">7. How does StaffLife improve the quality of new
                                            hires?</a>
                                    </p>

                                </div>
                                <div id="question4" class="panel-collapse collapse" style="height: 0px;">
                                    <div class="panel-body">
                                        <p class="faqtextsml">StaffLife will prevent bad hires by providing you with access
                                            to an employee's complete profile, not just the select few references an
                                            employee includes on their CV.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default ">
                                <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse"
                                    data-parent="#faqAccordion" data-target="#question5">
                                    <p class="faqtextbigb">
                                        <a href="#question5" class="ing">8. Where does the employee profile data come
                                            from?</a>
                                    </p>
                                </div>
                                <div id="question5" class="panel-collapse collapse" style="height: 0px;">
                                    <div class="panel-body">
                                        <p class="faqtextsml">Straight from the horse’s mouth. All information added to an
                                            employee’s profile comes from their previous employers during the course of
                                            their employment. Unlike CVs or LinkedIn profiles, the information is objective
                                            and unfiltered. StaffLife uses complex algorithms and systems to analyse
                                            employee profiles and assign an overall profile score. We could tell you more
                                            about our IP, but we’d have to kill you.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default ">
                                <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse"
                                    data-parent="#faqAccordion" data-target="#question15">
                                    <p class="faqtextbigb">
                                        <a href="#question15" class="ing">9. What information can I upload about my
                                            Employees?</a>
                                    </p>
                                </div>
                                <div id="question15" class="panel-collapse collapse" style="height: 0px;">
                                    <div class="panel-body">
                                        <p class="faqtextsml">Once you have logged into your account, you will clearly see
                                            the information you are able to add to an employee's profile. This includes
                                            details of promotions and positive performance reviews on the one hand, and
                                            malicious {{ __('stafflife.labourregulatorbody') }} claims and dishonest conduct
                                            on the other hand.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default ">
                                <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse"
                                    data-parent="#faqAccordion" data-target="#question16">
                                    <p class="faqtextbigb">
                                        <a href="#question16" class="ing">10. Do I require consent from my Employees to add
                                            information to their profiles?</a>
                                    </p>
                                </div>
                                <div id="question16" class="panel-collapse collapse" style="height: 0px;">
                                    <div class="panel-body">
                                        <p class="faqtextsml">Yes. You will have to generate a StaffLife Indemnification and
                                            Permission (SLIP) form for every employee you wish to register. The SLIP form
                                            will be generated by you through the system, by entering the employee’s name, ID
                                            number and personal email address. It is your duty to have the SLIP signed and
                                            added to the employee's file, as it may need to be furnished where an employee
                                            disputes having given consent.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default ">
                                <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse"
                                    data-parent="#faqAccordion" data-target="#question17">
                                    <p class="faqtextbigb">
                                        <a href="#question17" class="ing">11. Can an employee amend or make additions to
                                            their StaffLife profile?</a>
                                    </p>
                                </div>
                                <div id="question17" class="panel-collapse collapse" style="height: 0px;">
                                    <div class="panel-body">
                                        <p class="faqtextsml">Only employers can make amendments or additions to an
                                            employee’s StaffLife profile. An employee is however free to request that their
                                            employer make amendments or additions to their profile, and may have incorrect
                                            information removed.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="menu1" class="tab-pane fade">
                    <div class="container addpadf">
                        <div class="panel-group" id="faqAccordion2">
                            <div class="panel panel-default ">
                                <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse"
                                    data-parent="#faqAccordion2" data-target="#question6">
                                    <p class="faqtextbigb">
                                        <a href="#question6" class="ing">1. How does it work?</a>
                                    </p>

                                </div>
                                <div id="question6" class="panel-collapse collapse" style="height: 0px;">
                                    <div class="panel-body">
                                        <p class="faqtextsml">Your StaffLife profile will be your greatest tool in obtaining
                                            your dream job and desired salary. Once you have signed a StaffLife
                                            Indemnification and Permission (SLIP) form, your employer will update your
                                            profile with information relating to your employment, including positive
                                            performance reviews and achievements. On a monthly basis, you will be sent a
                                            summary of your profile to your personal email address. Future prospective
                                            employers may access your profile only with your consent (through an additional
                                            SLIP form).</p>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default ">
                                <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse"
                                    data-parent="#faqAccordion2" data-target="#question7">
                                    <p class="faqtextbigb">
                                        <a href="#question7" class="ing">2. What are the benefits of having a StaffLife
                                            profile?</a>
                                    </p>

                                </div>
                                <div id="question7" class="panel-collapse collapse" style="height: 0px;">
                                    <div class="panel-body">
                                        <p class="faqtextsml">For the first time in history, you are able to objectively
                                            show prospective employers the value you add to
                                            an {{ __('stafflife.organization') }}, with the objectivity and credibility
                                            lacking in your CV and references. This will allow you to separate yourself
                                            from other applicants, and get your dream job at the salary you deserve.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default ">
                                <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse"
                                    data-parent="#faqAccordion2" data-target="#question8">
                                    <p class="faqtextbigb">
                                        <a href="#question8" class="ing">3. How do I create my profile?</a>
                                    </p>

                                </div>
                                <div id="question8" class="panel-collapse collapse" style="height: 0px;">
                                    <div class="panel-body">
                                        <p class="faqtextsml">Your employer may register you on the system, or you can sign
                                            up and create your own profile.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default ">
                                <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse"
                                    data-parent="#faqAccordion2" data-target="#question9">
                                    <p class="faqtextbigb">
                                        <a href="#question9" class="ing">4. How much does it cost me?</a>
                                    </p>

                                </div>
                                <div id="question9" class="panel-collapse collapse" style="height: 0px;">
                                    <div class="panel-body">
                                        <p class="faqtextsml">As an employee, it is completely free. Your employer will
                                            cover the costs of all employees.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default ">
                                <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse"
                                    data-parent="#faqAccordion2" data-target="#question10">
                                    <p class="faqtextbigb">
                                        <a href="#question10" class="ing">5. How will I know what is on my profile?</a>
                                    </p>

                                </div>
                                <div id="question10" class="panel-collapse collapse" style="height: 0px;">
                                    <div class="panel-body">
                                        <p class="faqtextsml">When your employer registers you, your personal email address
                                            will be used. You will be emailed a summary of your profile every month and may
                                            challenge any incorrect information.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default ">
                                <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse"
                                    data-parent="#faqAccordion2" data-target="#question18">
                                    <p class="faqtextbigb">
                                        <a href="#question18" class="ing">6. Can the information on my profile be
                                            changed?</a>
                                    </p>

                                </div>
                                <div id="question18" class="panel-collapse collapse" style="height: 0px;">
                                    <div class="panel-body">
                                        <p class="faqtextsml">All information that is loaded to your StaffLife profile can
                                            be edited, amended or removed by your employer. StaffLife will remove any
                                            incorrect information added by your employer, provided such information has been
                                            successfully challenged.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default ">
                                <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse"
                                    data-parent="#faqAccordion2" data-target="#question19">
                                    <p class="faqtextbigb">
                                        <a href="#question19" class="ing">7. What happens if I change employers?</a>
                                    </p>

                                </div>
                                <div id="question19" class="panel-collapse collapse" style="height: 0px;">
                                    <div class="panel-body">
                                        <p class="faqtextsml">Your profile will remain intact even after you leave an
                                            employer that is a StaffLife member. Because your personal email address is
                                            used, you will not lose access to your profile. <br/><br/>

                                            Potential employers who are members of StaffLife may look up your profile as
                                            part of their recruitment process. However, your new employer will not be able
                                            to add to your profile without you signing an additional StaffLife
                                            Indemnification and Permission form. </p>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse"
                                    data-parent="#faqAccordion2" data-target="#question11">
                                    <p class="faqtextbigb">
                                        <a href="#question11" class="ing">8. Who can see my profile?</a>
                                    </p>
                                </div>
                                <div id="question11" class="panel-collapse collapse" style="height: 0px;">
                                    <div class="panel-body">
                                        <p class="faqtextsml">Only companies registered on StaffLife can view your profile. Other employees cannot see your profile.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse"
                                    data-parent="#faqAccordion2" data-target="#question12">
                                    <p class="faqtextbigb">
                                        <a href="#question12" class="ing">9. What if something on my profile is not
                                            true?</a>
                                    </p>
                                </div>
                                <div id="question12" class="panel-collapse collapse" style="height: 0px;">
                                    <div class="panel-body">
                                        <p class="faqtextsml">StaffLife only allows objective, factual information to remain
                                            on your profile. You may challenge any false information, which will require
                                            your Employer to furnish evidentiary proof.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse"
                                    data-parent="#faqAccordion2" data-target="#question13">
                                    <p class="faqtextbigb">
                                        <a href="#question13" class="ing">10. Can my employer post their negative opinion
                                            about me?</a>
                                    </p>
                                </div>
                                <div id="question13" class="panel-collapse collapse" style="height: 0px;">
                                    <div class="panel-body">
                                        <p class="faqtextsml">Absolutely not. It is not possible for an employer to indicate
                                            that they did not like you, or any other personal opinion they may have about
                                            you.</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/js/frontend/faq.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/mixitup/jquery.mixitup.js') }}"></script>

    <script>
        $(".greyfoot, .bortopfoot").hide();
        $(document).ready(function () {
            $("#choose-country2").show();
            $(".hide-home").show();

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

        });

        $(document).ready(function () {
            $('.awesome-tooltip').tooltip({
                placement: 'left'
            });

            $(window).bind('scroll', function (e) {
                dotnavigation();
            });

            function dotnavigation() {

                var numSections = $('section').length;

                $('#dot-nav li a').removeClass('active').parent('li').removeClass('active');
                $('section').each(function (i, item) {
                    var ele = $(item), nextTop;

                    // console.log(ele.next().html());

                    if (typeof ele.next().offset() != "undefined") {
                        nextTop = ele.next().offset().top;
                    }
                    else {
                        nextTop = $(document).height();
                    }

                    if (ele.offset() !== null) {
                        thisTop = ele.offset().top - ((nextTop - ele.offset().top) / numSections);
                    }
                    else {
                        thisTop = 0;
                    }

                    var docTop = $(document).scrollTop();

                    if (docTop >= thisTop && (docTop < nextTop)) {
                        $('#dot-nav li').eq(i).addClass('active');
                    }
                });
            }

            /* get clicks working */
            $('#dot-nav li').click(function () {

                var id = $(this).find('a').attr("href"),
                    posi,
                    ele,
                    padding = 0;

                ele = $(id);
                posi = ($(ele).offset() || 0).top - padding;

                $('html, body').animate({scrollTop: posi}, 'slow');

                return false;
            });

            /* end dot nav */
        });
    </script>
@stop
