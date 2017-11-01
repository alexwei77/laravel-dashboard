<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="A CV is known to be less than credible. A StaffLife profile is built with reviews by your current and historical employers, giving it unparalleled credibility.">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
  @include('layouts/csp')
</head>

@extends('layouts/defaultboth')

{{-- Page title --}}
@section('title')
Employees
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <!--page level css starts-->
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/aboutus.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/indexboth.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/animate/animate.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/owl_carousel/css/owl.carousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/owl_carousel/css/owl.theme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/devicon/devicon.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/devicon/devicon-colors.css') }}">
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/employees.css') }}"> -->
    <!--end of page level css-->

@stop
<style>
.maximage {
    max-width:100%;
    
}

footer {
    background-color: #e8e8e8 !important;
    border-top: 2px solid #dbdbdb;
}

body {
    margin-top: -20px !important;
}

.affix {
    position: sticky !important;
}

#choose-country2 {
    margin-top: -2px !important;
    background-color: #ffffff !important;
    border: 0;
    font-size: 14px !important;
    color: #666666 !important;
    text-decoration:underline;
}

#choose-country2:hover {
    margin-top: -2px !important;
    background-color: #ffffff !important;
    border: 0;
    font-size: 14px !important;
    color: #666666 !important;
    text-decoration:underline;
}

 @media screen and (max-width:767px) {
     #choose-country2 {
         margin-top: 3px !important;
         margin-left: 3% !important;
         background-color: #ffffff !important;
         border: 0;
         font-size: 14px;
         color: #666666 !important;
         text-decoration: underline;
         padding: 10px 5px;

    }
}

.btn {
    border: none !important;
    padding: 12px 25px 12px 25px !important;
    cursor: pointer !important;
    border-radius: 0 !important;
    font-size: 17px !important;
    color: #666666 !important;
}

@media screen and (max-width:1024px) {
    .deskimg {
        display:none !important;
    }
}

@media screen and (min-width:1025px) and (max-width:1200px) {
    .paddingpro {
        padding-top:50px;
    }
}

@media screen and (max-width:767px) {
    .ipadimg1 {
        display:none !important;
    }
}

@media screen and (min-width:1025px) {
    .ipadimg2 {
        display:none !important;
    }
}

@media screen and (min-width:768px) {
    .mobimg {
        display:none !important;
    }    
}

@media screen and (min-width:768px) and (max-width:1024px) {
    .mobdesk2 {
        display: none;
    }
}

</style>

{{-- Page content --}}
@section('content')
    <!-- Container Section Start -->
<div class="font-open-sans">  
    <div class="jumbotext text-center">
    <h1>Employees</h1>
    </div>
    
    <div>
        <div class="container addpad" style="padding-top:20px;">
            <div class="row mobdesk2">            
                <div class="col-sm-6">
                    <h3 class="homeheading" style="text-align:left;">Are you great at what you do?<br>The time has come to even things out.</h3>
                    <hr class="homehr">
                    <p class="hometextbig" style="text-align:left;">For the first time in history, ethical, hard working individuals can reap their rewards and even out the game.<br/></p>
                    <p class="faqtextsml" style="text-align:left;">Supply and demand - until now, employers to a large degree, have had a nearly impossible task of separating the great from the bad, leaving to a higher supply of a work force which isn't really there. By reducing the number of available individuals within a sector, automatically, the salaries of the desired individuals rises while the poor performers drops.<br/></p>

                    <p class="faqtextsml" style="text-align:left;">See the guy next to you at the office? Is he habitually late, looking for a "better" job, works less and wants more? Perhaps he doesn't really want to be at work to begin with? Realise, that he is affecting your income and growth opportunities in many ways.</p>
                </div>
                <div class="col-sm-6 text-center addpadc">
                    <div class="deskimg" style="height:65px;"></div>
                    <div class="deskimg">
                        <img src="{{ asset('assets/images/emp2.jpg') }}" class="maximage" alt="Man working on a sheet with pie charts and graphs">
                    </div>
                    <div class="mobimg">
                        <img src="{{ asset('assets/images/emp2.jpg') }}" class="maximage" alt="Man working on a sheet with pie charts and graphs">
                    </div>
                </div>
            </div>
            
            <div class="row ipadimg1 ipadimg2">            
                <div class="col-sm-12">
                    <h3 class="homeheading" style="text-align:left;">Are you great at what you do? The time has come to even things out.</h3>
                    <hr class="homehr">
                    <p class="hometextbig" style="text-align:left;">For the first time in history, ethical, hard working individuals can reap their rewards and even out the game.<br/></p>
                    <p class="faqtextsml" style="text-align:left;">Supply and demand - until now, employers to a large degree, have had a nearly impossible task of separating the great from the bad, leaving to a higher supply of a work force which isn't really there. By reducing the number of available individuals within a sector, automatically, the salaries of the desired individuals rises while the poor performers drops.<br/></p>

                    <p class="faqtextsml" style="text-align:left;">See the guy next to you at the office? Is he habitually late, looking for a "better" job, works less and wants more? Perhaps he doesn't really want to be at work to begin with? Realise, that he is affecting your income and growth opportunities in many ways.</p>
                </div>
                <div class="col-sm-12 text-center addpadc">
                    <div>
                        <img src="{{ asset('assets/images/emp2i.jpg') }}" class="maximage" alt="Man working on a sheet with pie charts and graphs" style="padding-bottom:20px; padding-top:20px;">
                    </div>
                </div>
            </div>  
            
            
        </div>
    </div>

    <div class="oddrow">
        <div class="container addpad pad" style="padding:70px 0 55px 0;">
            <div class="row mobdesk2">
            
                <div class="col-sm-6 text-center addpad">
                    <div class="deskimg">
                        <img src="{{ asset('assets/images/emp3.jpg') }}" class="maximage paddingpro" alt="open notebook with a laptop in the background">
                    </div>
                </div>
                
                <div class="col-sm-6">
                    <h3 class="homeheading">StaffLife - a great motivator</h3>
                    <hr class="homehr">
                    <p class="hometextbig" style="text-align:left;">Accountability is key, not just for businesses, but employees too.<br/></p>
                    <p class="faqtextsml" style="text-align:left;">Individuals who are now forced to pay closer attention to their work ethics (due to potential negative consequences), benefit greatly from StaffLife's systems. Gone are the days where employees simply packed up and took an advantage of their new employer or habitual abuse of {{ __('employees.labour') }} laws.</p>
                </div>
            </div>
            
            <div class="row ipadimg1 ipadimg2">
                <div class="col-sm-12">
                    <div class="ipadimg1 ipadimg2" style="height:20px;"></div>
                    <h3 class="homeheading">StaffLife - a great motivator</h3>
                    <hr class="homehr">
                    <p class="hometextbig" style="text-align:left;">Accountability is key, not just for businesses, but employees too.<br/></p>
                    <p class="faqtextsml" style="text-align:left;">Individuals who are now forced to pay closer attention to their work ethics (due to potential negative consequences), benefit greatly from StaffLife's systems. Gone are the days where employees simply packed up and took an advantage of their new employer or habitual abuse of {{ __('employees.labour') }} laws.</p>
                </div>
                <div class="col-sm-12">
                    <img src="{{ asset('assets/images/emp3i.jpg') }}" class="maximage paddingpro" alt="open notebook with a laptop in the background" style="padding:20px;">
                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="container">
            <div class="row mobdesk2">
                <div class="deskimg" style="height:30px;"></div>
                <div class="col-sm-6">
                    <div class="ipadimg1 ipadimg2" style="height:20px;"></div>
                    <h3 class="homeheading">Build a reputable profile on StaffLife and beat your competition</h3>
                    <hr class="homehr">
                    <p class="hometextbig" style="text-align:left;">Whether you join StaffLife by directly creating a profile or through a potential employer, gives you the opportunity to develop a strong record - backed up by your employers. </p>
                    <p class="faqtextsml" style="text-align:left;">Whereby a CV is known to be less than credible, a profile on StaffLife, is built primarily with reviews by your current and historical employers - giving it unparalleled credibility. HR will likely pick a StaffLife member with a credible record over a prospect who only has a CV and questionable references to offer.</p>
                </div>
                <div class="col-sm-6">
                    <div class="deskimg" style="height:20px;"></div>
                    <div class="deskimg">
                        <img src="{{ asset('assets/images/emp1.jpg') }}" style="padding:30px 0 80px 0;" class="maximage" alt="two men about to shake hands">
                    </div>
                    <div class="mobimg">
                        <img src="{{ asset('assets/images/emp1.jpg') }}" style="padding-top:20px;" class="maximage" alt="two men about to shake hands">
                    </div>
                </div>
            </div>
            
            <div class="row ipadimg1 ipadimg2">
                <div class="col-sm-12">
                    <div class="ipadimg1 ipadimg2" style="height:20px;"></div>
                    <h3 class="homeheading">Build a reputable profile on StaffLife and beat your competition</h3>
                    <hr class="homehr">
                    <p class="hometextbig" style="text-align:left;">Whether you join StaffLife by directly creating a profile or through a potential employer, gives you the opportunity to develop a strong record - backed up by your employers. </p>
                    <p class="faqtextsml" style="text-align:left;">Whereby a CV is known to be less than credible, a profile on StaffLife, is built primarily with reviews by your current and historical employers - giving it unparalleled credibility. HR will likely pick a StaffLife member with a credible record over a prospect who only has a CV and questionable references to offer.</p>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="ipadimg1 ipadimg2">
                    <img src="{{ asset('assets/images/emp1i.jpg') }}" style="padding-top:20px; padding-bottom:20px;" class="maximage" alt="two men about to shake hands">
                </div>
            </div>
        </div>
    </div>

    <div class="oddrow">
    <div class="container">
    
        <div class="row" style="padding-top:30px; padding-bottom:20px;">
        <div class="col-sm-12">
            <h3 class="homeheading" style="text-align:center;">Safe and easy to manage</h3>
            <hr style="width:20%; border-top: 1px solid #c6c6c6;">
        </div>
        </div>
        
        <div class="row">
        
        <div class="col-sm-3">
            <p class="hometextbig" style="text-align:left;">Step 1 - Join StaffLife</p>
            <p class="maximagec"><img src="{{ asset('assets/images/icon1.png') }}" alt="Icon of a man with a plus sign"><p>
            <p class="faqtextsml" style="text-align:left; margin-bottom:30px;">Create your own profile on StaffLife. You can either do that yourself, or confirm your profile which your existing or prospective employer created for you (when you signed the SLIP form).</p>
        </div>
        
        <div class="col-sm-3">
            <p class="hometextbig" style="text-align:left;">Step 2 - Ask Your Employer</p>
            <p class="maximagec"><img src="{{  asset('assets/images/icon2.png') }}" alt="icon of a man with a speech bubble"><p>
            <p class="faqtextsml" style="text-align:left; margin-bottom:30px;">Ask your HR department to update information about you. They will need to join as a member on StaffLife before they are able to contribute any data (if they are not already).</p>
        </div>
        
        <div class="col-sm-3">
            <p class="hometextbig" style="text-align:left;">Step 3 - Monitor Your Profile</p>
            <p class="maximagec"><img src="{{ asset('assets/images/icon3.png') }}" alt="Icon of people with a rising graph in front of them"><p>
            <p class="faqtextsml" style="text-align:left; margin-bottom:30px;">StaffLife will email you monthly, with information about your profile, any record changes, and tips on how to make the most out of your StaffLife account.</p>
        </div>
        
        <div class="col-sm-3">
            <p class="hometextbig" style="text-align:left;">Step 4 - Reap Your Benefits</p>
            <p class="maximagec"><img src="{{  asset('assets/images/icon4.png') }}" alt="Icon of a hand holding a dollar sign"><p>
            <p class="faqtextsml" style="text-align:left; margin-bottom:30px;">Once your StaffLife profile is complete, you will be able to get your dream job and earn the salary you deserve.</p>
        </div>
        
        </div>
    </div>
    
    </div>
<div>
    
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <!-- page level js starts-->
    <script type="text/javascript" src="{{ asset('assets/vendors/owl_carousel/js/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/wow/js/wow.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/frontend/carousel.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/frontend/aboutus.js') }}"></script>
    <script type="text/javascript">
        $(".greyfoot, .bortopfoot").hide();
    </script>
@stop

