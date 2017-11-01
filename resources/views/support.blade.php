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
        /*#dot-nav{    
	right: 10px;
	top: 50%;
	margin-top: -50px;
	height: 100px;
	z-index: 999;
}

#dot-nav ul {
	list-style: none;
	margin:0;
	padding: 0;
}
#dot-nav li {
	position: relative;
	background-color: #bdc3c7;
	border:3px solid #bdc3c7;
	border-radius: 15px 15px 15px 15px;
	cursor: pointer;
	padding: 5px;
	height: 10px;
	margin: 10px 10px 0px 0px;
	width: 10px;
	vertical-align:bottom;
}
#dot-nav li.active, #dot-nav li:hover {
	background-color: #8e44ad;
}

#dot-nav a {
	outline: 0;
	vertical-align:top;
	margin: 0px 0px 0px 25px;
	position: relative;
	top:-5px;
}
.awesome-tooltip + .tooltip > .tooltip-inner {
    background-color: #8e44ad; 
    color: #f5f5f5; 
    border: 1px solid #8e44ad; 
}
.awesome-tooltip + .tooltip.left > .tooltip-arrow{
    top:50%;
    right:0;
    margin-top:-5px;
    border-top:5px solid transparent;
    border-bottom:5px solid transparent;
    border-left:5px solid #8e44ad;
}*/

body {
    margin-top: -20px !important;
}
</style>
@stop

{{-- breadcrumb --}}
@section('top')
    <!--<div class="breadcum">
        <div class="container">
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}"> <i class="livicon icon3 icon4" data-name="home" data-size="18" data-loop="true" data-c="#3d3d3d" data-hc="#3d3d3d"></i>Dashboard
                    </a>
                </li>
                <li class="hidden-xs">
                    <i class="livicon icon3" data-name="angle-double-right" data-size="18" data-loop="true" data-c="#4caf50" data-hc="#4caf50"></i>
                    <a href="#">FAQ</a>
                </li>
            </ol>
            <div class="pull-right">
                <i class="livicon icon3" data-name="question" data-size="20" data-loop="true" data-c="#3d3d3d" data-hc="#3d3d3d"></i> FAQ
            </div>
        </div>
    </div>-->
    @stop


{{-- Page content --}}
@section('content')
    <!-- Container Section Start -->
<div class="jumbotext text-center">
  <h1>Support</h1>
</div>

<div class="row"style="max-width:800px; margin:0 auto; padding-top:50px;">
    <div class="col-sm-3 willem" style="margin-bottom:10px; text-align:center;">
        <a href="#faq"><div style="width: 100%; height: 100%; max-height: 24px;">FAQ</div></a>
    </div>
    <div class="col-sm-3 willem" style="margin-bottom:10px; text-align:center;">
        <a href="#contact"><div style="width: 100%; height: 100%; max-height: 24px;">Contact</div></a>
    </div>
    <div class="col-sm-3 willem" style="margin-bottom:10px; text-align:center;">
        <a href="#joinStaffLife"><div style="width: 100%; height: 100%; max-height: 24px;">Sign Up</div></a>
    </div>
    <div class="col-sm-3 willem" style="margin-bottom:10px; text-align:center;">
        <a href="#branches"><div style="width: 100%; height: 100%; max-height: 24px;">Branches</div></a>
    </div>
  </div>


<!-- <ul class="navb nav-tabsb" style="padding-top:30px;">
    <li class="active"><a href="#faq">FAQ</a></li>
    <li><a href="#contact">Contact</a></li>
    <li><a href="#joinStaffLife">Sign Up</a></li>
    <li><a href="#branches">Branches</a></li>
  </ul>
-->

<!-- FAQ Section Start -->
<div class="container marbottom" style="padding-top:30px !important; padding-bottom:20px;">
<h3 style="text-align:center;" class="homeheadingb">Frequently Asked Questions</h3>

<!--<p class="faqtextsml text-center" style="padding-bottom:30px;">If you have any other questions or suggestions, please contact us using<a href="#form" style="color:#ee6f00;"> one of the methods below</a></p> -->

   <ul class="navb nav-tabsb" style="padding-bottom:10px;">
    <li id="employer_tab" class="active"><a data-toggle="tab" href="#home">Employers</a></li>
    <li id="employee_tab" ><a data-toggle="tab" href="#menu1">Employees</a></li>
  </ul>
    <div class="tab-content" id="faq">
        <div id="home" class="tab-pane fade in active">
              <div class="container addpadf">
            <div class="panel-group" id="faqAccordion">
                <div class="panel panel-default">
                    <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question0">
                        <p class="faqtextbigb">
                            <a href="#question0" class="ing">1. How does it work?</a>
                        </p>

                    </div>
                    <div id="question0" class="panel-collapse collapse" style="height: 0px;">
                        <div class="panel-body">
                            <p class="faqtextsml">The StaffLife system will transform your business, by introducing a true system of accountability, and acting as an invaluable tool when filtering candidates' applications. As a member, you will generate a StaffLife Indemnification and Permission (SLIP) form for each of your employeess. This allows you to update your employees’ profiles regularly, with both positive and negative information.<br/><br/>
The SLIP form will also be signed by candidates, which will allow you to look up their StaffLife profile and identify a pattern of behaviour. Unlike references, which are all glowingly positive, StaffLife offers the first ever objective, unfiltered employee review. Your business will improve rapidly by hiring and retaining only the best candidates.</p>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default ">
                    <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question14">
                        <p class="faqtextbigb">
                            <a href="#question14" class="ing">2. What are the benefits of being a member?</a>
                        </p>

                    </div>
                    <div id="question14" class="panel-collapse collapse" style="height: 0px;">
                        <div class="panel-body">
                            <p class="faqtextsml">StaffLife will make your employees accountable for their actions, and will be invaluable in hiring the best individuals. By having all your employees on the system, you protect yourself and other employers against dishonest conduct and false {CCMA} claims. The system has been designed to provide your company with a detailed professional history and track record of an employee.</p>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default ">
                    <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question1">
                        <p class="faqtextbigb">
                            <a href="#question1" class="ing">3. How do I sign up?</a>
                        </p>

                    </div>
                    <div id="question1" class="panel-collapse collapse" style="height: 0px;">
                        <div class="panel-body">
                            <p class="faqtextsml">Signing up is quick and easy. Start by registering your company <a style="color:#ee6f00" href="{{ route('pricing') }}">here</a>. Once you've completed the steps, you will then be able to register each of your employees and start benefitting from StaffLife.</p>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default ">
                    <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question2">
                         <p class="faqtextbigb">
                            <a href="#question2" class="ing">4. How much does it cost me?</a>
                         </p>

                    </div>
                    <div id="question2" class="panel-collapse collapse" style="height: 0px;">
                        <div class="panel-body">
                            <p class="faqtextsml">We have various membership options, which are summarised on our pricing page which will give you a certain number of credits per month. One credit per employee per month is utilised. Searches (if required) are an additional one credit.</p>
                        </div>
                    </div>
                </div>
        
                <div class="panel panel-default ">
                    <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question3">
                        <p class="faqtextbigb">
                            <a href="#question3" class="ing">5. How does StaffLife improve the performance of my employees?</a>
                        </p>

                    </div>
                    <div id="question3" class="panel-collapse collapse" style="height: 0px;">
                        <div class="panel-body">
                            <p class="faqtextsml">If your employees have signed the Staff Life Indemnification Permission (SLIP) form, they have consented to their profiles being updated by you (as their employer). This means that your employees are unlikely to act maliciously or dishonestly, as they will be accountable for these acts.</p>
                        </div>
                    </div>
                </div>
        
                <div class="panel panel-default ">
                    <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question4">
                        <p class="faqtextbigb">
                            <a href="#question4" class="ing">6. How does StaffLife improve the quality of new hires?</a>
                        </p>

                    </div>
                    <div id="question4" class="panel-collapse collapse" style="height: 0px;">
                        <div class="panel-body">
                            <p class="faqtextsml">StaffLife will prevent bad hires by providing you with access to an employee's complete profile, not just the select few references an employee includes on their {CV}.</p>
                        </div>
                    </div>
                </div>
        
                <div class="panel panel-default ">
                    <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question5">
                         <p class="faqtextbigb">
                            <a href="#question5" class="ing">7. Where does the employee profile data come from?</a>
                        </p>
                    </div>
                    <div id="question5" class="panel-collapse collapse" style="height: 0px;">
                        <div class="panel-body">
                            <p class="faqtextsml">Straight from the horse’s mouth. All information added to an employee’s profile comes from their previous employers during the course of their employment. Unlike {CVs} or LinkedIn profiles, the information is objective and unfiltered. StaffLife uses complex algorithms and systems to analyse employee profiles and assign an overall profile score. We could tell you more about our IP, but we’d have to kill you.</p>
                        </div>
                    </div>
                </div>

<div class="panel panel-default ">
                    <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question15">
                         <p class="faqtextbigb">
                            <a href="#question15" class="ing">8. What information can I upload about my Employees?</a>
                        </p>
                    </div>
                    <div id="question15" class="panel-collapse collapse" style="height: 0px;">
                        <div class="panel-body">
                            <p class="faqtextsml">Once you have logged into your account, you will clearly see the information you are able to add to an employee's profile. This includes details of promotions and positive performance reviews on the one hand, and malicious {CCMA} claims and dishonest conduct on the other hand.</p>
                        </div>
                    </div>
                </div>

<div class="panel panel-default ">
                    <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question16">
                         <p class="faqtextbigb">
                            <a href="#question16" class="ing">9. Do I require consent from my Employees to add information to their profiles?</a>
                        </p>
                    </div>
                    <div id="question16" class="panel-collapse collapse" style="height: 0px;">
                        <div class="panel-body">
                            <p class="faqtextsml">Yes. You will have to generate a StaffLife Indemnification and Permission (SLIP) form for every employee you wish to register. The SLIP form will be generated by you through the system, by entering the employee’s name, ID number and personal email address. It is your duty to have the SLIP signed and added to the employee's file, as it may need to be furnished where an employee disputes having given consent.</p>
                        </div>
                    </div>
                </div>

<div class="panel panel-default ">
                    <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question17">
                         <p class="faqtextbigb">
                            <a href="#question17" class="ing">10. Can an employee amend or make additions to their StaffLife profile?</a>
                        </p>
                    </div>
                    <div id="question17" class="panel-collapse collapse" style="height: 0px;">
                        <div class="panel-body">
                            <p class="faqtextsml">Only employers can make amendments or additions to an employee’s StaffLife profile. An employee is however free to request that their employer make amendments or additions to their profile, and may have incorrect information removed.</p>
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
                    <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordion2" data-target="#question6">
                        <p class="faqtextbigb">
                            <a href="#question6" class="ing">1. How does it work?</a>
                        </p>

                    </div>
                    <div id="question6" class="panel-collapse collapse" style="height: 0px;">
                        <div class="panel-body">
                            <p class="faqtextsml">Your StaffLife profile will be your greatest tool in obtaining your dream job and desired salary. Once you have signed a StaffLife Indemnification and Permission (SLIP) form, your employer will update your profile with information relating to your employment, including positive performance reviews and achievements. On a monthly basis, you will be sent a summary of your profile to your personal email address. Future prospective employers may access your profile only with your consent (through an additional SLIP form).</p>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default ">
                    <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse" data-parent="#faqAccordion2" data-target="#question7">
                        <p class="faqtextbigb">
                            <a href="#question7" class="ing">2. What are the benefits of having a StaffLife profile?</a>
                        </p>

                    </div>
                    <div id="question7" class="panel-collapse collapse" style="height: 0px;">
                        <div class="panel-body">
                            <p class="faqtextsml">For the first time in history, you are able to objectively show prospective employers the value you add to an {organisation},  with the objectivity and credibility lacking in your {CV} and references. This will allow you to separate yourself from other applicants, and get your dream job at the salary you deserve.</p>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default ">
                    <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse" data-parent="#faqAccordion2" data-target="#question8">
                         <p class="faqtextbigb">
                            <a href="#question8" class="ing">3. How do I create my profile?</a>
                         </p>

                    </div>
                    <div id="question8" class="panel-collapse collapse" style="height: 0px;">
                        <div class="panel-body">
                            <p class="faqtextsml">Your employer may register you on the system, or you can sign up and create your own profile.</p>
                        </div>
                    </div>
                </div>
        
                <div class="panel panel-default ">
                    <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse" data-parent="#faqAccordion2" data-target="#question9">
                        <p class="faqtextbigb">
                            <a href="#question9" class="ing">4. How much does it cost me?</a>
                        </p>

                    </div>
                    <div id="question9" class="panel-collapse collapse" style="height: 0px;">
                        <div class="panel-body">
                            <p class="faqtextsml">As an employee, it is completely free. Your employer will cover the costs of all employees.</p>
                        </div>
                    </div>
                </div>
        
                <div class="panel panel-default ">
                    <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse" data-parent="#faqAccordion2" data-target="#question10">
                        <p class="faqtextbigb">
                            <a href="#question10" class="ing">5. How will I know what is on my profile?</a>
                        </p>

                    </div>
                    <div id="question10" class="panel-collapse collapse" style="height: 0px;">
                        <div class="panel-body">
                            <p class="faqtextsml">When your employer registers you, your personal email address will be used. You will be emailed a summary of your profile every month and may challenge any incorrect information.</p>
                        </div>
                    </div>
                </div>

<div class="panel panel-default ">
                    <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse" data-parent="#faqAccordion2" data-target="#question18">
                        <p class="faqtextbigb">
                            <a href="#question18" class="ing">6. Can the information on my profile be changed?</a>
                        </p>

                    </div>
                    <div id="question18" class="panel-collapse collapse" style="height: 0px;">
                        <div class="panel-body">
                            <p class="faqtextsml">All information that is loaded to your StaffLife profile can be edited, amended or removed by your employer. StaffLife will remove any incorrect information added by your employer, but which you have successfully challenged.</p>
                        </div>
                    </div>
                </div>

<div class="panel panel-default ">
                    <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse" data-parent="#faqAccordion2" data-target="#question19">
                        <p class="faqtextbigb">
                            <a href="#question19" class="ing">7. What happens if I change employers?</a>
                        </p>

                    </div>
                    <div id="question19" class="panel-collapse collapse" style="height: 0px;">
                        <div class="panel-body">
                            <p class="faqtextsml">Your profile will remain intact even after you leave an employer that is a StaffLife member. Because your personal email address is used, you will not lose access to your profile. <br/><br/>

Potential employers who are members of StaffLife may look your profile up as part of their recruitment process. However, your new employer will not be able to add to your profile without you signing an additional StaffLife Indemnification and Permission form. </p>
                        </div>
                    </div>
                </div>
        
                <div class="panel panel-default">
                    <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse" data-parent="#faqAccordion2" data-target="#question11">
                         <p class="faqtextbigb">
                            <a href="#question11" class="ing">8. Who can see my profile?</a>
                        </p>
                    </div>
                    <div id="question11" class="panel-collapse collapse" style="height: 0px;">
                        <div class="panel-body">
                            <p class="faqtextsml">Only companies registered on StaffLife can view your profile, if they specifically look up your profile for potential employment. Other employees cannot see your profile.</p>
                        </div>
                    </div>
                </div>
                
                <div class="panel panel-default">
                    <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse" data-parent="#faqAccordion2" data-target="#question12">
                         <p class="faqtextbigb">
                            <a href="#question12" class="ing">9. What if something on my profile is not true?</a>
                        </p>
                    </div>
                    <div id="question12" class="panel-collapse collapse" style="height: 0px;">
                        <div class="panel-body">
                            <p class="faqtextsml">StaffLife only allows objective, factual information to remain on your profile. You may challenge any false information, which will require your Employer to furnish evidentiary proof.</p>
                        </div>
                    </div>
                </div>
                
                <div class="panel panel-default">
                    <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse" data-parent="#faqAccordion2" data-target="#question13">
                         <p class="faqtextbigb">
                            <a href="#question13" class="ing">10. Can my employer post their negative opinion about me?</a>
                        </p>
                    </div>
                    <div id="question13" class="panel-collapse collapse" style="height: 0px;">
                        <div class="panel-body">
                            <p class="faqtextsml">Absolutely not. It is not possible for an employer to indicate that they did not like you, or any other personal opinion they may have about you.</p>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
  </div>
</div>


<!-- Form Section Start -->
<section class="oddrow" id="form">
<div class="container marbottom" id="contact" >
        <div class="row">
<!-- Address Section Start -->
                <div class="col-md-4" id="joinStaffLife" style="margin-top:50px; padding-bottom:30px; background-color:#ffffff;">

<div class="onlybig">

                              <h3 style="text-align:center;" class="homeheadingb">Email:</h3>
                              <h4 style="text-align:center;"><a href="mailto:info@stafflife.com">info@stafflife.com</a></h4>

<hr class="homehrb">
                              <h3 style="text-align:center;" class="homeheadingb">Phone:</h3>
                              <h4 style="text-align:center;">+27 861 476 984</h4>

<hr class="homehrb">
                  <table width="100%">
                        <tr>
                            <td colspan="2">        
                                <div class="text-center">
                                    <a  class="btn successb" href="/pricing"  style="color:#ffffff; margin-top:20px;">JOIN STAFFLIFE TODAY</a>
                                </div>
                            </td>
                        </tr>
                  </table>
                </div>
            </div>
            <!-- //Address Section End -->
            <!-- Contact form Section Start -->
            <div class="col-md-8" style="padding-top:50px; padding-left:30px; padding-right:30px;">
                <!-- <h3 style="text-align:center;padding-top:20px;" class="homeheading">Contact Form</h3> -->
                <!-- Notifications -->
                @include('notifications')

                <form class="contact" action="{{ route('thank-you', session('custom_lang')) }}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="form-group">
                        <input type="text" name="contact-name" class="form-control input-lg" placeholder="Name" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="contact-email" class="form-control input-lg" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <textarea name="contact-msg" class="form-control input-lg no-resize resize_vertical" rows="6" placeholder="Comment" required></textarea>
                    </div>
                    <div class="input-group">
                        <p> By clicking the submit button below you agree to our <a calss="danger" href="{{ route('terms-and-conditions') }}">Ts&Cs</a> </p>
                        <p style="text-align:center;"><button class="btn info text-center" type="submit">SUBMIT</button></p>
                        <!--<button class="btn btn-danger" type="reset">cancel</button>-->
                    </div>
                </form>
            </div>
            <!-- //Conatc Form Section End -->
               
        </div>
    </div>
</section>

<div class="container" style="padding-top:30px; padding-bottom:20px;" id="branches">
  <div class="row">
    <div class="col-sm-6" style="margin-bottom:10px;">
      <div style="background-color:#f4f4f4; background-size:cover; padding-top:20px; padding-bottom:20px; text-align:center;">
        <h4 style="text-align:center;">Johannesburg | South Africa</h4>
        <p style="line-height:20px; font-size:11px; margin-top:10px; text-align:center;">The Place,
1 Sandton Drive, Sandton <br/>
        <img class="alignnone wp-image-5305 size-full" src="https://www.dmm.co.za/wp-content/uploads/2017/03/Very-Small-Pin.png?x64526" height="12px"> <a href="https://www.google.co.za/maps/@-26.1093869,28.0492649,3a,75y,176.77h,96.32t/data=!3m6!1e1!3m4!1soRANW3baJv2_vRLE3XGMVA!2e0!7i13312!8i6656?hl=en" style="color:#666666; text-decoration:underline; font-size:12px;" target="_blank">View Map</a></p>
        <p style="line-height:20px; text-align:center;">0861 GROWTH (476 984) | +27 10 590 3110</p>
      </div>
    </div>
  
  
    <div class="col-sm-6" style="margin-bottom:10px;">
      <div style="background-color:#f4f4f4; padding-top:20px; padding-bottom:20px; text-align:center;">
        <h4 style="text-align:center;">Cape Town | South Africa</h4>
        <p style="line-height:20px; font-size:11px; margin-top:10px; text-align:center;">Convention Tower, Cnr Walter Sisulu &amp; Heerengracht Street <br/>
      <img class="alignnone wp-image-5305 size-full" src="https://www.dmm.co.za/wp-content/uploads/2017/03/Very-Small-Pin.png?x64526" height="12px"> <a href="https://www.google.co.za/maps/@-33.9172835,18.4283806,3a,75y,346.98h,103.95t/data=!3m6!1e1!3m4!1sEKF6TigqvlDEGAc1kw45sg!2e0!7i13312!8i6656?hl=en" style="color:#666666; text-decoration:underline; font-size:12px;" target="_blank">View Map</a></p>
        <p style="line-height:20px; text-align:center;">0861 GROWTH (476 984) | +27 21 403 6363</p>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-6" style="margin-bottom:10px;">
      <div style="background-color:#f4f4f4; padding-top:20px; padding-bottom:20px; text-align:center;">
        <h4 style="text-align:center;">New York | USA</h4>
        <p style="line-height:20px; font-size:11px; margin-top:10px; text-align:center;">230 Park Avenue, Manhattan<br/>
      <img class="alignnone wp-image-5305 size-full" src="https://www.dmm.co.za/wp-content/uploads/2017/03/Very-Small-Pin.png?x64526" height="12px"> 
<a href="https://www.google.co.za/maps/@40.7550586,-73.9757107,3a,75y,201.6h,115.36t/data=!3m6!1e1!3m4!1stYKK00eEXFy2II53nE4pcw!2e0!7i13312!8i6656?hl=en" style="color:#666666; text-decoration:underline; font-size:12px;" target="_blank">View Map</a></p>
        <p style="line-height:20px; text-align:center;">+1 212 551 1419</p>
      </div>
    </div>

    <div class="col-sm-6" style="margin-bottom:10px;">
      <div style="background-color:#f4f4f4; padding-top:20px; padding-bottom:20px; text-align:center;">
        <h4 style="text-align:center;">London | UK</h4>
        <p style="line-height:20px; font-size:11px; margin-top:10px; text-align:center;">48 Warwick Street, Soho <br/>
        <img class="alignnone wp-image-5305 size-full" src="https://www.dmm.co.za/wp-content/uploads/2017/03/Very-Small-Pin.png?x64526" height="12px"> <a href="https://www.google.co.za/maps/@51.5105947,-0.1375157,3a,75y,307.09h,102.05t/data=!3m6!1e1!3m4!1ssFe3lDDjzBO4ESfe23svxw!2e0!7i13312!8i6656?hl=en" style="color:#666666; text-decoration:underline; font-size:12px;" target="_blank">View Map</a></p>
        <p style="line-height:20px; text-align:center; text-align:center;">+44 870 875 1921</p>
      </div>
    </div>
  </div>
    
  <div class="row">
    <div class="col-sm-6" style="margin-bottom:10px;">
      <div style="background-color:#f4f4f4; padding-top:20px; padding-bottom:20px; text-align:center;">
        <h4 style="text-align:center;">Sydney | Australia</h4>
        <p style="line-height:20px; font-size:11px; margin-top:10px; text-align:center;">Circular Quay Centre, AMP Tower, 50 Bridge Street<br/>
    <img class="alignnone wp-image-5305 size-full" src="https://www.dmm.co.za/wp-content/uploads/2017/03/Very-Small-Pin.png?x64526" height="12px"> 
<a href="https://www.google.co.za/maps/@-33.8633615,151.2120271,3a,75y,313.23h,110.25t/data=!3m6!1e1!3m4!1sJz4guTEjL8qPyKiJBG-yFw!2e0!7i13312!8i6656?hl=en" style="color:#666666; text-decoration:underline; font-size:12px;" target="_blank">View Map</a></p>
      <p style="line-height:20px; text-align:center; text-align:center;">+61 2 8216 0848</p>
      </div>
    </div>

    <div class="col-sm-6" style="margin-bottom:10px;">
      <div style="background-color:#f4f4f4; padding-top:20px; padding-bottom:20px; text-align:center;">
        <h4 style="text-align:center;">Moscow | Russia</h4>
        <p style="line-height:20px; font-size:11px; margin-top:10px; text-align:center;">5th floor, 12 Trubnaya Street<br/>
        <img class="alignnone wp-image-5305 size-full" src="https://www.dmm.co.za/wp-content/uploads/2017/03/Very-Small-Pin.png?x64526" height="12px"> 
<a href="https://www.google.co.za/maps/place/Trubnaya+ul.,+12,+Moskva,+Russia,+107045/@55.7687144,37.6244945,3a,75y,175.76h,116.46t/data=!3m6!1e1!3m4!1sujpJM1YgjktDO1-3T46ZLA!2e0!7i13312!8i6656!4m5!3m4!1s0x46b54a69aba319dd:0x65d462040bef68bb!8m2!3d55.768384!4d37.624903" style="color:#666666; text-decoration:underline; font-size:12px;" target="_blank">View Map</a></p>
        <p style="line-height:20px; text-align:center; text-align:center;">+7 (495) 787 2786 | +7 (495) 787 2788</p>
      </div> 
    </div>
  </div>
</div>


<!-- Form Section End -->
<!--<div data-spy="affix" id="dot-nav">
    	<ul>
	      <li class="awesome-tooltip active" title="How does being a member benefit me as an Employer?"><a href="#question0"></a></li>
	      <li class="awesome-tooltip" title="About"><a href="#about"></a></li>
	      <li class="awesome-tooltip" title="Projects"><a href="#projects"></a></li>
	      <li class="awesome-tooltip" title="Contact"><a href="#contact"></a></li>
	    </ul>
	</div>-->
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/js/frontend/faq.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/mixitup/jquery.mixitup.js') }}"></script>

    <script>
       $( document ).ready(function() {
         $("#choose-country2").show();
         $(".hide-home").show();

           @if($nav_section == 'employer')
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




        $(document).ready(function(){
    $('.awesome-tooltip').tooltip({
        placement: 'left'
    });   

    $(window).bind('scroll',function(e){
      dotnavigation();
    });
    
    function dotnavigation(){
             
        var numSections = $('section').length;
        
        $('#dot-nav li a').removeClass('active').parent('li').removeClass('active');     
        $('section').each(function(i,item){
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
          
          if(docTop >= thisTop && (docTop < nextTop)){
            $('#dot-nav li').eq(i).addClass('active');
          }
        });   
    }

    /* get clicks working */
    $('#dot-nav li').click(function(){
      
        var id = $(this).find('a').attr("href"),
          posi,
          ele,
          padding = 0;
      
        ele = $(id);
        posi = ($(ele).offset()||0).top - padding;
      
        $('html, body').animate({scrollTop:posi}, 'slow');
      
        return false;
    });

/* end dot nav */
});


      </script>
@stop
