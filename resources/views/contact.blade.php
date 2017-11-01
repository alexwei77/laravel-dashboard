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
   <h1>Contact</h1>
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
               <img class="alignnone wp-image-5305 size-full" src="https://www.dmm.co.za/wp-content/uploads/2017/03/Very-Small-Pin.png?x64526" height="12px"> <a href="https://www.google.co.za/maps/@-26.1093869,28.0492649,3a,75y,176.77h,96.32t/data=!3m6!1e1!3m4!1soRANW3baJv2_vRLE3XGMVA!2e0!7i13312!8i6656?hl=en" style="color:#666666; text-decoration:underline; font-size:12px;" target="_blank">View Map</a>
            </p>
            <p style="line-height:20px; text-align:center;">0861 GROWTH (476 984) | +27 10 590 3110</p>
         </div>
      </div>
      <div class="col-sm-6" style="margin-bottom:10px;">
         <div style="background-color:#f4f4f4; padding-top:20px; padding-bottom:20px; text-align:center;">
            <h4 style="text-align:center;">Cape Town | South Africa</h4>
            <p style="line-height:20px; font-size:11px; margin-top:10px; text-align:center;">Convention Tower, Cnr Walter Sisulu &amp; Heerengracht Street <br/>
               <img class="alignnone wp-image-5305 size-full" src="https://www.dmm.co.za/wp-content/uploads/2017/03/Very-Small-Pin.png?x64526" height="12px"> <a href="https://www.google.co.za/maps/@-33.9172835,18.4283806,3a,75y,346.98h,103.95t/data=!3m6!1e1!3m4!1sEKF6TigqvlDEGAc1kw45sg!2e0!7i13312!8i6656?hl=en" style="color:#666666; text-decoration:underline; font-size:12px;" target="_blank">View Map</a>
            </p>
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
               <a href="https://www.google.co.za/maps/@40.7550586,-73.9757107,3a,75y,201.6h,115.36t/data=!3m6!1e1!3m4!1stYKK00eEXFy2II53nE4pcw!2e0!7i13312!8i6656?hl=en" style="color:#666666; text-decoration:underline; font-size:12px;" target="_blank">View Map</a>
            </p>
            <p style="line-height:20px; text-align:center;">+1 212 551 1419</p>
         </div>
      </div>
      <div class="col-sm-6" style="margin-bottom:10px;">
         <div style="background-color:#f4f4f4; padding-top:20px; padding-bottom:20px; text-align:center;">
            <h4 style="text-align:center;">London | UK</h4>
            <p style="line-height:20px; font-size:11px; margin-top:10px; text-align:center;">48 Warwick Street, Soho <br/>
               <img class="alignnone wp-image-5305 size-full" src="https://www.dmm.co.za/wp-content/uploads/2017/03/Very-Small-Pin.png?x64526" height="12px"> <a href="https://www.google.co.za/maps/@51.5105947,-0.1375157,3a,75y,307.09h,102.05t/data=!3m6!1e1!3m4!1ssFe3lDDjzBO4ESfe23svxw!2e0!7i13312!8i6656?hl=en" style="color:#666666; text-decoration:underline; font-size:12px;" target="_blank">View Map</a>
            </p>
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
               <a href="https://www.google.co.za/maps/@-33.8633615,151.2120271,3a,75y,313.23h,110.25t/data=!3m6!1e1!3m4!1sJz4guTEjL8qPyKiJBG-yFw!2e0!7i13312!8i6656?hl=en" style="color:#666666; text-decoration:underline; font-size:12px;" target="_blank">View Map</a>
            </p>
            <p style="line-height:20px; text-align:center; text-align:center;">+61 2 8216 0848</p>
         </div>
      </div>
      <div class="col-sm-6" style="margin-bottom:10px;">
         <div style="background-color:#f4f4f4; padding-top:20px; padding-bottom:20px; text-align:center;">
            <h4 style="text-align:center;">Moscow | Russia</h4>
            <p style="line-height:20px; font-size:11px; margin-top:10px; text-align:center;">5th floor, 12 Trubnaya Street<br/>
               <img class="alignnone wp-image-5305 size-full" src="https://www.dmm.co.za/wp-content/uploads/2017/03/Very-Small-Pin.png?x64526" height="12px"> 
               <a href="https://www.google.co.za/maps/place/Trubnaya+ul.,+12,+Moskva,+Russia,+107045/@55.7687144,37.6244945,3a,75y,175.76h,116.46t/data=!3m6!1e1!3m4!1sujpJM1YgjktDO1-3T46ZLA!2e0!7i13312!8i6656!4m5!3m4!1s0x46b54a69aba319dd:0x65d462040bef68bb!8m2!3d55.768384!4d37.624903" style="color:#666666; text-decoration:underline; font-size:12px;" target="_blank">View Map</a>
            </p>
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