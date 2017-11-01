<?php $og = new OpenGraph(); 
$og->title('Terms & Conditions - StaffLife.com')
        ->image("")
        ->description("All users of this or any other StaffLife website agree that access to and use of this site are subject to these terms and conditions and other applicable law.")
        ->url();
?>
<!DOCTYPE html>
<html lang="en">
<head>
{!! $og->renderTags() !!}
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="All users of this or any other StaffLife website agree that access to and use of this site are subject to these terms and conditions and other applicable law.">
    @include('layouts/csp')
</head>

@extends('layouts/defaultboth')
{{-- Page title --}}
@section('title')
Ts & Cs
@parent
@stop
{{-- page level styles --}}
@section('header_styles')
<!--page level css starts-->
<link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
<link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/tabbular.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/animate/animate.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/jquery.circliful.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/owl_carousel/css/owl.carousel.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/owl_carousel/css/owl.theme.css') }}">
<!--end of page level css-->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/shopping.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/price.css') }}">
<link href="{{ asset('assets/vendors/animate/animate.min.css') }}" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/indexboth.css') }}">
<style>
   li {padding-bottom:5px;
}
   .box_round_symboll {
   font-size: 20px !important; 
   }
   .bg-border2 {
   background: #4FC899;
   border-left: 3px solid#E97451;
   border-right: 3px solid#E97451;
   border-top: 3px solid#E97451;
   border-bottom: 3px solid#E97451;
   padding-top: 20px;
   padding-bottom: 20px;
   width: 100%;
   }
   .purchae-hed2 {
   margin-bottom: 20px;
   margin-left: 15px;
   color: #fff;
   text-transform: none;
   font-size: 28px;
   font-weight: bold;
   }

   body {
    margin-top: -20px !important;
   }
</style>
@stop
{{-- slider --}}
@section('top')

<div class="jumbotext text-center">
  <h1>Terms and Conditions</h1>
</div>

<div class="container" style="padding-bottom:50px;">
   <div class="row" style="padding-top:50px; padding-bottom:30px;">
      <h4 style="text-align:center; color:#4caf50;">PLEASE READ THE FOLLOWING TERMS AND CONDITIONS OF USE CAREFULLY BEFORE USING THIS WEBSITE.</h4>
   </div>
   <div class="row">
      <p style="text-align:center;">These terms and conditions are effective immediately for those registering accounts. All users of this or any other StaffLife website agree that access to and use of this site are subject to the following terms and conditions and other applicable law. Do not access or use the Site if you are unwilling or unable to be bound by the Terms.</p>
   </div>

   <div class="row">
      <div class="col-md-12">
          <h4 style="color:#4caf50;">Copyright</h4>
          <p>The entire content included in this site, including but not limited to text, graphics or code is copyrighted as a collective work under the South African and other copyright laws, and is the property of StaffLife. You may display and, subject to any expressly stated restrictions or limitations relating to specific material, download or print portions of the material from the different areas of the site solely for your own non-commercial use, or to place an order with StaffLife or to purchase StaffLife products.</p>
          <p>Any other use, including but not limited to the reproduction, distribution, display or transmission of the content of this site is strictly prohibited, unless authorized by StaffLife. You further agree not to change or delete any proprietary notices from materials downloaded from the site.</p>
      </div>
   </div>


   <div class="row">
      <div class="col-md-12">
          <h4 style="color:#4caf50;">Trademarks</h4>
              <p>All trademarks, service marks and trade names of StaffLife used in the site are trademarks or registered trademarks of StaffLife.</p>
       </div>
   </div>


   <div class="row">
       <div class="col-md-12">
           <h4 style="color:#4caf50;">Warranty Disclaimer</h4>
           <p>This site and the materials and products on this site are provided "as is" and without warranties of any kind, whether express or implied. To the fullest extent permissible pursuant to applicable law, StaffLife disclaims all warranties, express or implied, including, but not limited to, implied warranties of merchantability and fitness for a particular purpose and non-infringement. StaffLife does not represent or warrant that the functions contained in the site will be uninterrupted or error-free, that the defects will be corrected, or that this site or the server that makes the site available are free of viruses or other harmful components.<br/><br/>StaffLife does not make any warrantees or representations regarding the use of the materials in this site in terms of their correctness, accuracy, adequacy, usefulness, timeliness, reliability or otherwise.</p>
       </div>
   </div>


   <div class="row">
       <div class="col-md-12">
           <h4 style="color:#4caf50;">Limitation of Liability</h4>
           <p>StaffLife shall not be liable for any special or consequential damages that result from the use of, or the inability to use, the materials on this site or the performance of the products, even if StaffLife has been advised of the possibility of such damages.</p>
        </div>
    </div>


    <div class="row">
      <div class="col-md-12">
           <h4 style="color:#4caf50;">Typographical Errors</h4>
         <p>In the event that a product is mistakenly listed on the site at an incorrect price, StaffLife reserves the right to refuse or cancel any orders placed for product listed at the incorrect price. StaffLife reserves the right to refuse or cancel any such orders whether or not the order has been confirmed and your credit card charged. If your credit card has already been charged for the purchase and your order is cancelled, StaffLife shall issue a credit to your credit card account in the amount of the incorrect price.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h4 style="color:#4caf50;">Term Termination</h4>
            <p>These terms and conditions are applicable to you upon your accessing the site and/or completing the registration or shopping process. These terms and conditions, or any part of them, may be terminated by StaffLife without notice at any time, for any reason. The provisions relating to Copyrights, Trademark, Disclaimer, Limitation of Liability, Indemnification and Miscellaneous, shall survive any termination.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h4 style="color:#4caf50;">Notice</h4>
            <p>StaffLife may deliver notice to you by means of e-mail, a general notice on the site, or by other reliable method to the contact information you have provided to StaffLife.</p>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <h4 style="color:#4caf50;">Miscellaneous</h4>
            <p>Your use of this site shall be governed in all respects by the laws of the Republic of South Africa, without regard to choice of law provisions, and not by the 1980 U.N. Convention on contracts for the international sale of goods. You agree that jurisdiction over and venue in any legal proceeding directly or indirectly arising out of or relating to this site (including but not limited to the purchase of StaffLife products) shall be in the Province where StaffLife head offices are located. Any cause of action or claim you may have with respect to the site (including but not limited to the purchase of StaffLife products or services) must be commenced within one (1) year after the claim or cause of action arises.</p>
            <p>StaffLife’s failure to insist upon or enforce strict performance of any provision of these terms and conditions shall not be construed as a waiver of any provision or right. Neither the course of conduct between the parties nor trade practice shall act to modify any of these terms and conditions. StaffLife may assign its rights and duties under this Agreement to any party at any time without notice to you.</p>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <h4 style="color:#4caf50;">Use of Site</h4>
            <p>Harassment in any manner or form on the site, including via e-mail, chat, or by use of obscene or abusive language, is strictly forbidden. Impersonation of others, including a StaffLife or other licensed employee, host, or representative, as well as other members or visitors on the site is prohibited. You may not upload to, distribute, or otherwise publish through the site any content which is libellous, defamatory, obscene, threatening, invasive of privacy or publicity rights, abusive, illegal, or otherwise objectionable which may constitute or encourage a criminal offence, violate the rights of any party or which may otherwise give rise to liability or violate any law. You may not upload commercial content on the site or use the site to solicit others to join or become members of any other commercial online service or other organization.</p>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <h4 style="color:#4caf50;">Participation Disclaimer</h4>
            <p>StaffLife does not and cannot review all communications and materials posted to or created by users accessing the site, and is not in any manner responsible for the content of these communications and materials. You acknowledge that by providing you with the ability to view and distribute user-generated content on the site, StaffLife is merely acting as a passive conduit for such distribution and is not undertaking any obligation or liability relating to any contents or activities on the site.</p>
            <p>However, StaffLife reserves the right to block or remove communications or materials that it determines to be (a) abusive, defamatory, or obscene, (b) fraudulent, deceptive, or misleading, (c) in violation of a copyright, trademark or; other intellectual property right of another or (d) offensive or otherwise unacceptable to StaffLife in its sole discretion.</p>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <h4 style="color:#4caf50;">Indemnification</h4>
            <p>You agree to indemnify, defend, and hold harmless StaffLife, its officers, directors, employees, agents, licensors and suppliers (collectively the "Service Providers") from and against all losses, expenses, damages and costs, including reasonable attorneys' fees, resulting from any violation of these terms and conditions or any activity related to your account (including negligent or wrongful conduct) by you or any other person accessing the site using your Internet account.</p>
            <p>The StaffLife site and all content are provided on an "as is" basis. The contents of the site, such as text, graphics, images, information obtained from StaffLife's licensors, and other material contained on the StaffLife site ("Content") are for informational purposes only and do not constitute advice. The user is encouraged to consult with a professional advisor before acting on any information or content appearing on or transmitted through StaffLife's web site. Nothing on the site shall be construed as an offer by StaffLife to the user, but merely an invitation to do business.</p>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <h4 style="color:#4caf50;">Third-Party Links</h4>
            <p>In an attempt to provide increased value to our visitors, StaffLife may link to sites operated by third parties. However, even if the third party is affiliated with StaffLife, StaffLife has no control over these linked sites, all of which have separate privacy and data collection practices, independent of StaffLife. These linked sites are only for your convenience and therefore you access them at your own risk. Nonetheless, StaffLife seeks to protect the integrity of its web site and the links placed upon it and therefore requests any feedback on not only its own site, but for sites it links to as well (including if a specific link does not work).</p>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <h4 style="color:#4caf50;">User Content</h4>
            <p>You agree that you will not upload or transmit any communications or content of any type to any public areas that infringe or violate any rights of any party. By submitting communications or content to StaffLife, you agree that such submission is non-confidential for all purposes.</p>
            <p>If you make any submission to a public area or if you submit any business information, idea, concept or invention to StaffLife by email, you automatically grant-or warrant that the owner of such content or intellectual property has expressly granted StaffLife a royalty-free, perpetual, irrevocable, world-wide nonexclusive license to use, reproduce, create derivative works from, modify, publish, edit, translate, distribute, perform, and display the communication or content in any media or medium, or any form, format, or forum now known or hereafter developed. If you wish to keep any business information, ideas, concepts or inventions private or proprietary, do not submit them to the site or to StaffLife by email. We try to answer every email in a timely manner, but are not always able to do so.</p>
            <p>You agree to only post or upload Media (like photos, videos or audio) that you have taken yourself or that you have all rights to transmit and license and which do not violate trademark, copyright, privacy or any other rights of any other person. Photos or videos of celebrities and cartoon or comic images are usually copyrighted by the owner.</p>
            <p>By uploading or submitting any media on the StaffLife site, you warrant that you have permission from all persons appearing in your media for you to make this contribution and grant rights described herein. Never post a picture or video of or with someone else unless you have their explicit permission.</p>
            <p>It is strictly prohibited to upload media of any kind that contain expressions of hate, abuse, offensive images or conduct, obscenity, pornography, sexually explicit or any material that could give rise to any civil or criminal liability under applicable law or regulations or that otherwise may be in conflict with these Terms and Conditions or the Privacy Policy.</p>
            <p>You agree that you will not upload any material that contains software viruses or any other computer code, files or programs designed to interrupt, destroy or limit the functionality of any computer software or this web site.</p>
            <p>By uploading any media like a photo or video, (a) you grant StaffLife a perpetual, non-exclusive, worldwide, royalty-free license to use, copy, print, display, reproduce, modify, publish, post, transmit and distribute the media and any material included in the media; and (b) you certify that any person pictured in the submitted media (or, if a minor, his/her parent/legal guardian) authorizes StaffLife to use, copy, print, display, reproduce, modify, publish, post, transmit and distribute the media and any material included in such media; and (c) you agree to indemnify StaffLife and its affiliates, directors, officers and employees and hold them harmless from any and all claims and expenses, including attorneys' fees, arising from the media and/or your failure to comply with these the terms described in this document.</p>
             <p>StaffLife reserves the right to remove any media for any reason, at any time, without prior notice, at our sole discretion.</p>
       </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h4 style="color:#4caf50;">Competitions & Give-aways</h4>
            <p>Unless otherwise stated on a competition page, all competitions rules and conditions below apply:</p>
            <ol type="a">
                <li>All entries are permitted via StaffLife websites or channels only.</li>
                <li>South African residents, over the age of 18 are eligible to enter.</li>
                <li>Each competition states the closing date, prize value and number of winners. Users should check their account for winning notices and have up to 30 days to claim their prize or it may be forfeited.</li>
                <li>Entries are made by registering with accurate personal details and completing the required forms and questions as required.</li>
                <li>One entry per competition allowed per person. Multiple entries by a single person will result in disqualification.</li>
                <li>All entry details, images submitted etc. become StaffLife’s property and may be used by StaffLife as marketing material.</li>
                <li>Winners are determined automatically and randomly.</li>
                <li>Please ensure that all personal information is completed accurately. We may disqualify an entry should any of the information prove incorrect. Furthermore, entrants give StaffLife permission to communicate with them via any channels.</li>
                <li>StaffLife reserves the right to edit any material and information submitted, in addition to extending a competition’s closing date.</li>
                <li>Prizes are not transferable and may not be exchanged for cash or any other prize.</li>
                <li>StaffLife’s decision is final and no correspondence will be entered into.</li>
                <li>No employees and immediate family of StaffLife or the competition’s prize sponsors may enter.</li>
                <li>By entering StaffLife’s competitions, each entrant agrees to abide by all the rules. StaffLife reserves the right to disqualify an entry without notice.</li>
                <li>StaffLife shall not be held responsible for the usability and warranty/guarantee of prizes issued or loss of physical or digital vouchers which have subsequently been used by an unauthorised party. Winners are required to contact the prize sponsors for assistance with this regard.</li>
                <li>Participants enter or take part in competitions and give-aways at their own risk and StaffLife bears no responsibility for any loss, damage or harm suffered as a result of participation.</li>
                <li>StaffLife’s competition rules, terms & conditions and formats may change without notice.</li>
            </ul>
        </div>
    </div>
    

    <div class="row">
        <div class="col-md-12">
            <h4 style="color:#4caf50;">E-mail Disclaimer (as linked from sender)</h4>
            <p>This e-mail and any attachments are proprietary to StaffLife and/or any of its subsidiaries. It is confidential, may be legally privileged and is protected by law. <br/><br/>T
he content of this e-mail message may contain personal views of the author/sender of this communication and may not necessarily reflect the views or policies of StaffLife.<br/><br/>
The person/s or entity/s addressed in this e-mail is/are the intended sole recipient/s. If this e-mail has reached you in error, please:</p>
            <ol>
                <li>Notify the sender of this error and delete this communication immediately;</li>
                <li>Do not read, disclose or use the content of this e-mail in any way whatsoever;</li>
                <li>Do not copy, distribute or take action in reliance of the contents of this information.</li>
            </ol>
            <p>Doing so is strictly prohibited and may be unlawful.</p>
            <p>StaffLife and/or any of its subsidiaries is neither liable for the proper or complete transmission of the information contained in this communication nor for any delays in its receipt.</p>
            <p>Under no circumstances shall StaffLife and/or the author/sender of this communication be liable to any person or entity for any damages whatsoever, whether direct or consequential damages that arise out of this e-mail message. Neither StaffLife nor the author/sender of this e-mail message represent or guarantee the accuracy of this e-mail message and does not accept any liability whatsoever for any damages directly or indirectly arising out of the furnishing to the recipient (whether the intended recipient or not) or the use made by such recipient (whether the intended recipient or not) of the information set out in this communication.</p>
            <p>Details pertaining to the author/sender of this e-mail message or the content of this email or any of its attachments, may not be used, published, copied or disclosed for any purpose whatsoever without the written permission of StaffLife or the author/sender.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h4 style="color:#4caf50;">Consumer Protection Act (CPA)</h4>
            <p>South African CPA laws shall supersede any StaffLife terms and conditions which conflict with the act or any other laws in the Republic of South Africa.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h4 style="color:#4caf50;">StaffLife’s Contact Information</h4>
            <p>Email: info@stafflife.com | Telephone: 011 375 7362</p>
        </div>
    </div>
</div>
<!-- //Container End -->
@stop
{{-- footer scripts --}}
@section('footer_scripts')
<!-- page level js starts-->
<script type="text/javascript" src="{{ asset('assets/js/frontend/jquery.circliful.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendors/wow/js/wow.min.js') }}" ></script>
<script type="text/javascript" src="{{ asset('assets/vendors/owl_carousel/js/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/frontend/carousel.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/frontend/index.js') }}"></script>
<!--page level js ends-->
<script>
   $( document ).ready(function() {
     $("#choose-country2").show();
     $(".hide-home").show();
    });
   
</script>
@stop