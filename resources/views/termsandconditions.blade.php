<!DOCTYPE html>
<html lang="en">
   <head>
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
   <div class="jumbotext text-center">
      <h1>Terms and Conditions</h1>
   </div>
   <!-- FAQ Section Start -->
   <div class="container marbottom" style="padding-top:30px !important; padding-bottom:20px;">
      <ul class="navb nav-tabsb" style="padding-bottom:10px;">
         <li id="employer_tab" class="active"><a data-toggle="tab" href="#home">Employers</a></li>
         <li id="employee_tab"><a data-toggle="tab" href="#menu1">Employees</a></li>
      </ul>
      <br>
      <div class="tab-content" id="faq">
         <div id="home" class="tab-pane fade in active">
            <h1 style="text-align:center;">Member Terms and Conditions</h1>
            <h4 style="text-align:center; color:#4caf50;">PLEASE NOTE: These terms and conditions apply to all Employers that are Members of StaffLife. Any participation in this service will constitute acceptance of this agreement.</h4>
            <div class="row">
               <p>These terms and conditions are effective immediately for those registering accounts. All users of this or any other StaffLife (SL) website agree that access to and use of this site are subject to the following terms and conditions and other applicable law. Do not access or use the Site if you are unwilling or unable to be bound by the Terms.</p>
               <h3>Using StaffLife</h3>
               <h4>House Rule</h4>
               <p>You represent and warrant that you will use SL solely for lawful purposes in a manner consistent with these Terms as well as any applicable laws, regulations, or other legally enforceable obligations (including contractual obligations) you may have towards us and any third parties. You are solely responsible for any and all Content that is posted through your account on SL ("Your Content"). You agree that by submitting Your Content to SL, you have reviewed and understood our Terms and Conditions. You understand that you may expose yourself to liability if Your Content or other use of SL violates applicable law or any third-party right.</p>
               <h4>Eligibility to become a Member of SL</h4>
               <p>In order to become a Member of SL, you must be a registered company, and must submit one of the following documents in order to verify your account:</p>
               <li>{{ __('stafflife.companyregistrationdoc') }}</li>
               <li>Invoice clearly indicating legal entity details</li>
               <li>{{ __('stafflife.utilitybill') }} </li>
               <p>Individuals and Employees are not permitted to register Member accounts, except where done so on behalf of an Employer, with their express consent and/or instruction. </p>
               <h4>Your SL Account</h4>
               <p>In order for you to create a SL account, we require that you provide a valid email address and set up a password. The email you use must be one where we can reach you. In the event we cannot correspond with you via this email address, your submitted content may be rejected and your account may be disabled. As an Employer creating an account, you are required to submit your {{ __('stafflife.companyregistrationdoc') }}, an Invoice or a {{ __('stafflife.utilitybill') }}. You are entirely responsible for maintaining the confidentiality of your password. You agree to notify us immediately if you suspect any {{ strtolower(__('stafflife.unauthorized')) }} use of your account or access to your password. You are solely responsible for any and all use of your account. Accounts and Passwords are subject to cancellation or suspension by SL at any time. </p>
               <h4>Credit Usage</h4>
               <p>You will have a certain number of credits per month, based on your subscription package. One credit is {{ strtolower(__('stafflife.utilize')) }}d per employee loaded under your account per month, as well as one additional credit per search done on a Candidate’s Profile. </p>
               <h4>Social Media Login</h4>
               <p>You may be able to register an account and subsequently access SL through a social networking site, such as Facebook or Google+ ("Social Networking Site"). If you access SL through a Social Networking Site you agree that we may access, make available through SL, and store (if applicable) any information, data, text, messages, tags, and/or other materials that you have provided to and stored and made accessible in your Social Networking Site account so that it is available on and through SL via your account and your Profile page. Subject to the privacy settings that you have set with the Social Networking Site account you use to access SL, personally identifiable information that you post to that Social Networking Site may be displayed on SL. Please note: your relationship with your Social Networking Sites is governed solely by your agreement with those Social Networking Sites and we disclaim any liability for personally identifiable information that may be provided to us by a Social Networking Site in violation of the privacy settings that you have set with that Social Networking Site account. </p>
               <h4>Indemnification </h4>
               <p>By using SL, you indemnify SL, its Employees, associates and any other related party from liability which results directly or indirectly from any information which is added to SL, or through the use of SL in general. You are personally liable for any false, misleading or fake information which is added by any person through your account. </p>
               <h4>Refunds </h4>
               <p>Banned or suspended Members are not entitled to any refund. Where a Member’s account is not approved, a refund will be provided unless the non-approval is due to verification documents having not been submitted within 30 days of creation of the account.</p>
               <h4>Payment & Account Suspension</h4>
               <p>You are liable for payment of all amounts due in terms of your subscription package, irrespective of whether such amounts are to be pre- or post-paid. Accounts that are more than 30 days in arrears will be suspended. Such suspension in no way terminates the Membership, and you will be liable for payment of the full subscription fees for the full subscription period. </p>
               <h4>Confidentiality</h4>
               <p>You are required to keep confidential all Members’ account details, as well as all Employee profile data. Such data may not be shared, distributed or published. Non-compliance with this clause may result in a damages claim being instituted against the Member Employer in breach hereof. </p>
               <h3>Employee Profiles</h3>
               <h4>Obtaining Employee and Candidate Consent</h4>
               <p>In order to add information to Employees’ Profiles or to do a search on a Candidate , it is required that you generate a SL Indemnification and Permission (SLIP) Form and <b>have it signed</b> by each individual. By entering the Name, {{ strtolower(__('stafflife.idnumber')) }} and personal email address of an individual, a unique SLIP form will be generated. It is <b>your duty</b> to ensure that the SLIP form is signed, and that a copy is kept in an Employee’s file. You are not permitted to add information to an Employee’s Profile or look up the Profile of a Candidate  without a <b>signed</b> SLIP, and attempting to do so will notify the Employee/Candidate , and may result in action being taken against you. </p>
               <h4>Entering information onto an Employee’s Profile</h4>
               <p>Provided you have a signed SLIP and have sufficient credits remaining on your account, you may post content to your Employees’ Profiles. By confirming that an Employee has consented to having their profile viewed or updated, you are warranting that you have obtained a SLIP signed by the employee whose profile you are looking up. Loading information to an Employee’s Profile is optional, but recommended. SL advises against selectively loading data (i.e. only loading negative information). An Employee may access their Profile, and will be aware of the information that you, as their Employer, have added to their Profile. Employees are entitled to challenge any information in the Ethics & Basics section. Posting any data without a signed SLIP may result in an Employee taking action against you.</p>
               <h4>Information added to an Employee’s Profile </h4>
               <p>You are not permitted to change information which has been loaded to an Employee’s Profile.  Where information is loaded incorrectly about an Employee, the Employee is entitled to challenge such information. Where you are unable to furnish SL with evidentiary proof to the contrary, the information will be removed. This will have a bearing on the trustworthiness of future data you have entered into the system, and the SL algorithms will adjust the weighting and relevance of your future Employee reviews.</p>
               <h4>Posting false information </h4>
               <p>By using SL, you agree to only post information about an Employee that is, to the best of your knowledge and belief, both true and correct. You are not permitted to knowingly post information which is untrue, and doing so may result in an Employee taking action against you and/or your account being suspended or removed. The posting of any malicious and/or false information may result in criminal liability, and a lifetime ban from SL. Banned Members will not be entitled to any refunds.</p>
               <h4>Proof of information</h4>
               <p>Where an Employee has challenged information that you as the Employer Member have added to their Profile, you are required to furnish evidentiary proof within 30 days of being notified of such a challenge. If you are able to prove the challenged information, an unsuccessful challenge will be noted against the Employee’s Profile. If you are unable to prove the challenged information, the information will be removed from the Employee’s Profile, the trustworthiness of future data entered into the system will be diminished, and the SL algorithms will adjust the weighting and relevance of your future reviews. SL retains a record of the number of successful challenges made by your Employees, and other Members may be shown this information.</p>
               <h4>Profiles of connected persons </h4>
               <p>You are not permitted to load information and/or Profiles of friends, family and/or other related persons. The use of SL is strictly limited to employment relationships. Failure to adhere to the clause may result in the removal of the Profile of the connected persons, and/or temporary or permanent banning from SL. Banned Members will <b>not</b> be entitled to any refunds.</p>
               <h4>Candidate Profiles</h4>
               <p>Employer reviews and other employment-related information pertaining to Employees are made available to you through SL ("Content"), provided written consent is obtained from the Employee to which the information relates. Because we do not control such Content, you understand and agree that: <br>
                  1. we are not responsible for, and do not endorse, any such Content, including but not limited to any information relating to legal or other disciplinary measures taken by or against an Employee;<br>
                  2. we make no guarantees about the accuracy, currency, suitability, reliability or quality of the information in such Content; and <br>
                  3. we assume no responsibility for unintended, objectionable, inaccurate, misleading, or unlawful Content made available by Employers who are Members of SL.<br>
                  We allow Members to add content to the Profiles of their Employees, subject to having an Employee consent (through the SLIP form). 
               </p>
               <h4>Use and Interpretation of Candidate Profiles</h4>
               <p>The Ethics and Basics section of a Candidate’s Profile is objective and verifiable information which is updated by that Candidate's current and/or previous Employers who are/were Members of SL. This information is challengeable by the Employee, and is removed where found to be untrue. The Performance section of a Candidate’s Profile is subjective information which may be hidden at the election of the Employee. Where an Employee has hidden the Performance section, this will be indicated on their Profile.</p>
               <p>You are <b>not permitted</b> to share or send Employee and/or Candidate Profile data to any person outside of your {{ __('stafflife.organization') }}. Failure to adhere to this clause may result in temporary or permanent banning from SL. Banned Members will <b>not</b> be entitled to any refunds. </p>
               <h3>Other terms of use</h3>
               <h4>Data Storage</h4>
               <p>By using this website, you understand and accept that the data submitted to SL will be stored by SL.</p>
               <h4>Data Loss</h4>
               <p>SL shall in no way be responsible for any data loss, whether direct or indirect, which occurs through the use in any way of SL. </p>
               <h4>Removal of Data</h4>
               <p>SL reserves the right to remove, in part or in whole, any information submitted to SL. </p>
               <h4>Changes to Pricing</h4>
               <p>Pricing may change subject to a 30 day notice period.</p>
               <h4>Termination</h4>
               <p>Upon termination, you are required to destroy all SLIPs and inform all Employees that have been added under your account that your {{ __('stafflife.organization') }} is no longer a Member. SL will email all Employees on the system under your account to inform them of termination. SL shall in no way be responsible for any consequence which may result, directly or indirectly, from termination of your account. This clause shall apply in the event of a temporary or permanent ban from SL.</p>
               <h4>Undertaking by Employer</h4>
               <p>By signing up with SL, you agree that you will not:<br>
                  1. Impersonate another Employer, or his or her email address, or misrepresent your current or former affiliation with an Employer;<br>
                  2. Create user accounts under false or fraudulent {{ __('stafflife.pretences') }}; create or use an account for anyone other than your {{ __('stafflife.organization') }};<br>
                  3. Post Content to an Employee’s Profile with obtaining a signed SLIP form;<br>
                  4. Accessing a Candidate's Profile without obtaining a signed SLIP form;<br>
                  5. Violate these Terms, the terms of your agreements with us, explicit restrictions set forth in our Community Guidelines, or any applicable law, rule or regulation;
                  Post Content that is defamatory, {{ __('stafflife.libelous') }}, or fraudulent; that you know to be false or misleading; or that does not reflect your honest opinion and experience;<br>
                  6. Act in a manner that is threatening, racist or bigoted, or is otherwise objectionable (as determined by SL);<br>
                  7. Promote, endorse or further illegal activities;<br>
                  8. Disclose information in violation of any legally enforceable confidentiality, non-disclosure or other contractual restrictions or rights of any third party, including any current or former Employers or potential Employers;<br>
                  9. Violate the privacy, publicity, copyright, patent, trademark, trade secret, or other intellectual property or proprietary rights of SL or any third-party;<br>
                  10. Add any content or data which is pornographic or sexually explicit in nature, or engage in the exploitation of persons in a sexual or violent manner;<br>
                  11. List any Employees who are minors;<br>
                  12. Except as expressly approved by us, use SL for commercial activities and/or promotions such as contests, sweepstakes, barter, pyramid schemes, advertising, affiliate links, and other forms of solicitation;<br>
                  13. Imply a SL endorsement or partnership of any kind without our express written permission;<br>
                  14. Introduce software or automated agents to SL, or access SL so as to produce multiple accounts, generate automated messages, or to scrape, strip or mine data from SL without our express written permission;<br>
                  15. “Frame” or “mirror” or otherwise incorporate part of SL into any website, or “deep-link” to any portion of SL without our express written permission.<br>
                  16. Copy, modify or create derivative works of SL (including SL Content) without our express written permission;<br>
                  17. Copy or use the information, content, or data on SL in connection with a competitive service (as determined by SL);<br>
                  18. Sell, resell, rent, lease, loan, trade or otherwise {{ __('stafflife.monetise') }} access to SL or any SL Content without our express written permission;<br>
                  19. Interfere with, disrupt, modify, reverse engineer, or decompile any data or functionality of SL; <br>
                  20. Interfere with, disrupt, or create an undue burden on SL or the networks or services connected to SL;<br>
                  21. Introduce any viruses, Trojan horses, worms, time bombs, cancelbots, corrupted files, or similar software to SL; <br>
                  22. Attempt to circumvent any security feature of SL; or<br>
                  23. Expose us or our users to any harm or liability.
               <h4>Cancellation</h4>
               <p>You are permitted to cancel your subscription at any time. Cancellation may be done through the account portal. In the event of cancellation, no amount paid shall be refunded.</p>
               <h4>Links to Third-Party Websites</h4>
               <p>SL may contain links to third-party websites placed by us as a service to those interested in this information, or posted by other users. Your use of all such links to third-party websites is at your own risk. We do not monitor or have any control over, and make no claim or representation regarding third-party websites. To the extent such links are provided by us, they are provided only as a convenience, and a link to a third-party website does not imply our endorsement, adoption or sponsorship of, or affiliation with, such third-party website. When you leave SL, our terms and policies do not govern your use of third-party websites.</p>
               <h4>Other</h4>
               <p>Except as specifically stated in another agreement we have with you, these Terms constitute the entire agreement between you and us regarding the use of SL and these Terms supersede all prior proposals, negotiations, agreements, and understandings concerning the subject matter of these Terms. Our terms and conditions will change from time to time, and you will be notified of such changes. </p>
               <h3>Intellectual Property</h3>
               <h4>Copyright</h4>
               <p>The entire content included in this site, including but not limited to text, graphics or code is copyrighted as a collective work under the South African and other copyright laws, and is the property of SL. You may display and, subject to any expressly stated restrictions or limitations relating to specific material, download or print portions of the material from the different areas of the site solely for your own non-commercial use, or to place an order with SL or to purchase SL products.
                  Any other use, including but not limited to the reproduction, distribution, display or transmission of the content of this site is strictly prohibited, unless {{ strtolower(__('stafflife.authorized')) }} by SL. You further agree not to change or delete any proprietary notices from materials downloaded from the site.
               </p>
               <h4>Trademarks</h4>
               <p>All trademarks, service marks and trade names of SL used in the site are trademarks or registered trademarks of SL.</p>
               <h4>Replication of the SL Indemnification and Permission (SLIP) Form</h4>
               <p>Replication of the SLIP form constitutes an intellectual property infringement, and will result in legal action being taken against the Member company. </p>
               <h3>General</h3>
               <h4>Warranty Disclaimer</h4>
               <p>This site and the materials and products on this site are provided "as is" and without warranties of any kind, whether express or implied. To the fullest extent permissible pursuant to applicable law, SL disclaims all warranties, express or implied, including, but not limited to, implied warranties of merchantability and fitness for a particular purpose and non-infringement. SL does not represent or warrant that the functions contained in the site will be uninterrupted or error-free, that the defects will be corrected, or that this site or the server that makes the site available are free of viruses or other harmful components.
                  SL does not make any warranties or representations regarding the use of the materials in this site in terms of their correctness, accuracy, adequacy, usefulness, timeliness, reliability or otherwise.
               </p>
               <h4>Limitation of Liability</h4>
               <p>SL shall not be liable for any special or consequential damages that result from the use of, or the inability to use, the materials on this site or the performance of the products, even if SL has been advised of the possibility of such damages.</p>
               <h4>Typographical Errors</h4>
               <p>In the event that a product is mistakenly listed on the site at an incorrect price, SL reserves the right to refuse or cancel any orders placed for product listed at the incorrect price. SL reserves the right to refuse or cancel any such orders whether or not the order has been confirmed and your credit card charged. If your credit card has already been charged for the purchase and your order is cancelled, SL shall issue a credit to your credit card account in the amount of the incorrect price.</p>
               <h4>Term; Termination</h4>
               <p>These terms and conditions are applicable to you upon your accessing the site and/or completing the registration or shopping process. These terms and conditions, or any part of them, may be terminated by SL without notice at any time, for any reason. The provisions relating to Copyrights, Trademark, Disclaimer, Limitation of Liability, Indemnification and Miscellaneous, shall survive any termination.</p>
               <h4>Notice</h4>
               <p>SL may deliver notice to you by means of e-mail, a general notice on the site, or by other reliable method to the contact information you have provided to SL.</p>
               <h4>Miscellaneous</h4>
               <p>Your use of this site shall be governed in all respects by the laws of the Republic of South Africa, without regard to choice of law provisions, and not by the 1980 U.N. Convention on contracts for the international sale of goods. You agree that jurisdiction over and venue in any legal proceeding directly or indirectly arising out of or relating to this site (including but not limited to the purchase of SL products) shall be in the Province where SL head offices are located. Any cause of action or claim you may have with respect to the site (including but not limited to the purchase of SL products or services) must be commenced within one (1) year after the claim or cause of action arises.
                  SL’s failure to insist upon or enforce strict performance of any provision of these terms and conditions shall not be construed as a waiver of any provision or right. Neither the course of conduct between the parties nor trade {{ __('stafflife.practice') }} shall act to modify any of these terms and conditions. SL may assign its rights and duties under this Agreement to any party at any time without notice to you.
               </p>
               <h4>Use of Site</h4>
               <p>Harassment in any manner or form on the site, including via e-mail, chat, or by use of obscene or abusive language, is strictly forbidden. Impersonation of others, including a SL or other {{ __('stafflife.licence') }}dEmployee, host, or representative, as well as other Members or visitors on the site is prohibited. You may not upload to, distribute, or otherwise publish through the site any content which is {{ __('stafflife.libelous') }}, defamatory, obscene, threatening, invasive of privacy or publicity rights, abusive, illegal, or otherwise objectionable which may constitute or encourage a criminal {{ __('stafflife.offence') }}, violate the rights of any party or which may otherwise give rise to liability or violate any law. You may not upload commercial content on the site or use the site to solicit others to join or become Members of any other commercial online service or other {{ __('stafflife.organization') }}.</p>
               <h4>Participation Disclaimer</h4>
               <p>SL does not and cannot review all communications and materials posted to or created by users accessing the site, and is not in any manner responsible for the content of these communications and materials. You acknowledge that by providing you with the ability to view and distribute user-generated content on the site, SL is merely acting as a passive conduit for such distribution and is not undertaking any obligation or liability relating to any contents or activities on the site.<br>
                  However, SL reserves the right to block or remove communications or materials that it determines to be (a) abusive, defamatory, or obscene, (b) fraudulent, deceptive, or misleading, (c) in violation of a copyright, trademark or; other intellectual property right of another or (d) offensive or otherwise unacceptable to SL in its sole discretion.
               </p>
               <h4>Indemnification</h4>
               <p>You agree to indemnify, defend, and hold harmless SL, its officers, directors, Employees, agents, licensors and suppliers (collectively the "Service Providers") from and against all losses, expenses, damages and costs, including reasonable attorneys' fees, resulting from any violation of these terms and conditions or any activity related to your account (including negligent or wrongful conduct) by you or any other person accessing the site using your Internet account.
                  The SL site and all content are provided on an "as is" basis. The contents of the site, such as text, graphics, images, information obtained from SL's licensors, and other material contained on the SL site ("Content") are for informational purposes only and do not constitute advice. The user is encouraged to consult with a professional advisor before acting on any information or content appearing on or transmitted through SL's web site. Nothing on the site shall be construed as an offer by SL to the user, but merely an invitation to do business.
               </p>
               <h4>Third-Party Links</h4>
               <p>In an attempt to provide increased value to our visitors, SL may link to sites operated by third parties. However, even if the third party is affiliated with SL, SL has no control over these linked sites, all of which have separate privacy and data collection practices, independent of SL. These linked sites are only for your convenience and therefore you access them at your own risk. Nonetheless, SL seeks to protect the integrity of its web site and the links placed upon it and therefore requests any feedback on not only its own site, but for sites it links to as well (including if a specific link does not work).</p>
               <h4>User Content</h4>
               <p>You agree that you will not upload or transmit any communications or content of any type to any public areas that infringe or violate any rights of any party. By submitting communications or content to SL, you agree that such submission is non-confidential for all purposes.</p>
               <p>If you make any submission to a public area or if you submit any business information, idea, concept or invention to SL by email, you automatically grant-or warrant that the owner of such content or intellectual property has expressly granted SL a royalty-free, perpetual, irrevocable, world-wide nonexclusive {{ __('stafflife.licence') }} to use, reproduce, create derivative works from, modify, publish, edit, translate, distribute, perform, and display the communication or content in any media or medium, or any form, format, or forum now known or hereafter developed. If you wish to keep any business information, ideas, concepts or inventions private or proprietary, do not submit them to the site or to SL by email. We try to answer every email in a timely manner, but are not always able to do so.</p>
               <p>You agree to only post or upload Media (like photos, videos or audio) that you have taken yourself or that you have all rights to transmit and {{ __('stafflife.licence') }} and which do not violate trademark, copyright, privacy or any other rights of any other person. Photos or videos of celebrities and cartoon or comic images are usually copyrighted by the owner.
                  By uploading or submitting any media on the SL site, you warrant that you have permission from all persons appearing in your media for you to make this contribution and grant rights described herein. Never post a picture or video of or with someone else unless you have their explicit permission.
               </p>
               <p>It is strictly prohibited to upload media of any kind that contain expressions of hate, abuse, offensive images or conduct, obscenity, pornography, sexually explicit or any material that could give rise to any civil or criminal liability under applicable law or regulations or that otherwise may be in conflict with these Terms and Conditions or the Privacy Policy.
                  You agree that you will not upload any material that contains software viruses or any other computer code, files or programs designed to interrupt, destroy or limit the functionality of any computer software or this web site.
               </p>
               <p>By uploading any media like a photo or video, (a) you grant SL a perpetual, non-exclusive, worldwide, royalty-free {{ __('stafflife.licence') }} to use, copy, print, display, reproduce, modify, publish, post, transmit and distribute the media and any material included in the media; and (b) you certify that any person pictured in the submitted media (or, if a minor, his/her parent/legal guardian) {{ strtolower(__('stafflife.authorize')) }}s SL to use, copy, print, display, reproduce, modify, publish, post, transmit and distribute the media and any material included in such media; and (c) you agree to indemnify SL and its affiliates, directors, officers and Employees and hold them harmless from any and all claims and expenses, including attorneys' fees, arising from the media and/or your failure to comply with these the terms described in this document.</p>
               <p>SL reserves the right to remove any media for any reason, at any time, without prior notice, at our sole discretion.</p>
               <h4>Removal of Content</h4>
               <p>While SL has no obligation to do so, SL reserves the right to review and delete (or modify) any Content that we believe, in our sole discretion, violates these Terms or other applicable policies posted on SL (including our Community Guidelines), or that we deem, in our sole discretion, inappropriate. If you see any Content on SL that you believe violates our policies, you may report that Content by clicking on an applicable link adjacent to that Content (e.g. links titled: "Inappropriate" or "Flag Review") or by contacting us here. Once notified, we will review the Content and consider whether to remove or modify it. Please note: Our interpretation of our policies and the decision whether or not to edit or remove Content is within our sole discretion. You understand and agree that if we choose not to remove or edit Content that you find objectionable, that decision will not constitute a violation of these Terms or any agreement we have with you. For more information please see our Legal FAQs.</p>
               <p>Copyright Policy. Please see our Copyright Complaint Policy for information about copyright and trademark disputes.</p>
               <p>Other Enforcement Actions. While we have no obligation to do so, we reserve the right to investigate and take appropriate action in our sole discretion against you if you violate these Terms, including without limitation: removing Content from SL (or modifying it); suspending your rights to use SL; terminating your Membership and account; reporting you to law enforcement, regulatory authorities, or administrative bodies; and taking legal action against you.</p>
               <p>Defending Our Users. While we have no obligation to do so, we reserve the right, to the fullest extent permitted by applicable law, to take appropriate action to protect the anonymity of our users against the enforcement of subpoenas or other information requests that seek a user's electronic address or identifying information.</p>
               <h4>Rights to Your Content</h4>
               <p>We do not claim ownership in any Content that you submit to SL, but to be able to legally provide SL to our users, we have to have certain rights to use such Content in connection with SL, as set forth below. By submitting any Content to SL, you hereby grant to us an unrestricted, irrevocable, perpetual, non-exclusive, fully-paid and royalty-free, {{ __('stafflife.licence') }} (with the right to sublicence through unlimited levels of sublicences) to use, copy, perform, display, create derivative works of, adapt and distribute such Content in any and all media (now known or later developed) throughout the world. To the greatest extent permitted by applicable law, you hereby expressly waive any and all of your moral rights applicable to SL's exercise of the foregoing {{ __('stafflife.licence') }}. No compensation will be paid with respect to the Content that you post through SL. You should only submit Content to SL that you are comfortable sharing with others under the terms and conditions of these Terms.</p>
               <h4>Rights to SL Content</h4>
               <p>SL contains Content provided by us and our licensors. We and our licensors (including other users) own and retain all proprietary (including all intellectual property) rights in the Content we each provide and SL owns and retains all property rights in SL. If you are a user, we hereby grant you a limited, revocable, non-sublicensable {{ __('stafflife.licence') }} under the intellectual property rights licensable by us to download, view, copy and print Content from SL solely for your personal use in connection with using SL. Except as provided in the foregoing, you agree not to: (1) reproduce, modify, publish, transmit, distribute, publicly perform or display, sell, adapt or create derivative works based on SL or the Content (excluding Your Content); or (2) rent, lease, loan, or sell access to SL. SL ® is a registered trademark of SL, Inc. The trademarks, logos and service marks ("Marks") displayed on SL are our property or the property of third parties. You are not permitted to use these Marks without our prior written consent or the consent of the third party that owns the Mark.</p>
               <h4>Indemnity</h4>
               <p>You agree to defend, indemnify, and hold us and our subsidiaries and our and their respective officers, directors, board Members, board advisors, Employees, partners, agents successors and assigns (collectively, the "SL Group") harmless from any loss, liability, claim, or demand, including reasonable attorneys’ fees, made by any third party due to or otherwise arising from your use of SL, including due to or arising from your breach of any provision of these Terms.</p>
               <h4>Disclaimers and Limitation on Liability</h4>
               <p>The disclaimers and limitations on liability in this section apply to the maximum extent allowable under applicable law. Nothing in this section is intended to limit any rights you have which may not be lawfully limited.</p>
               <p>You are solely responsible for your interactions with advertisers and other users and we are not responsible for the activities, omissions, or other conduct, whether online or offline, of any advertiser or user of SL. We are not responsible for any incorrect, inaccurate, or unlawful Content (including any information in Profiles) posted on SL, whether caused by users or by any of the equipment or programming associated with or {{ strtolower(__('stafflife.utilize')) }}d in SL. We assume no responsibility for any error, omission, interruption, deletion, defect, delay in operation or transmission, communications line failure, theft or destruction or {{ strtolower(__('stafflife.unauthorized')) }}d access to, or alteration of, any communication with advertisers or other users. We are not responsible for any problems or technical malfunction of any hardware and software due to technical problems on the Internet or on SL or combination thereof, including any injury or damage to users or to any person's computer related to or resulting from participation or downloading materials in connection with SL. Under no circumstances shall we be responsible for any loss or damage resulting from use of SL or from any Content posted on SL or transmitted to users, or any interactions between users of SL, whether online or offline.</p>
               <p>SL is provided "as-is" and as available. We expressly disclaim any warranties and conditions of any kind, whether express or implied, including the warranties or conditions of merchantability, fitness for a particular purpose, title, quiet enjoyment, accuracy, or non-infringement. We make no warranty that: (1) SL will meet your requirements; (2) SL will be available on an uninterrupted, timely, secure, or error-free basis; or (3) the results that may be obtained from the use of SL will be accurate or reliable.</p>
               <p>You hereby release the SL Group from any and all claims, demands, and losses, damages, rights, claims, and actions of any kind that are either directly or indirectly related to or arises from: (1) any interactions with other users of SL, or (2) your participation in any of our offline events.</p>
               <p>IN NO EVENT SHALL THE SL GROUP BE LIABLE TO YOU OR ANY THIRD PARTY FOR ANY LOST PROFIT OR ANY INDIRECT, CONSEQUENTIAL, EXEMPLARY, INCIDENTAL, SPECIAL, OR PUNITIVE DAMAGES ARISING FROM YOUR USE OF SL, EVEN IF WE HAVE BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES. NOTWITHSTANDING ANYTHING TO THE CONTRARY CONTAINED HEREIN, WHERE PERMITTED BY APPLICABLE LAW, YOU AGREE THAT THE SL GROUP’S LIABILITY TO YOU FOR ANY DAMAGES ARISING FROM OR RELATED TO YOUR USE OF SL (FOR ANY CAUSE WHATSOEVER AND REGARDLESS OF THE FORM OF THE ACTION), WILL AT ALL TIMES BE LIMITED TO ONE HUNDRED U.S. DOLLARS ($100).</p>
               <p>You acknowledge that you are familiar with the provisions of Section 1542 of the California Civil Code, which provides as follows: "A GENERAL RELEASE DOES NOT EXTEND TO CLAIMS WHICH THE CREDITOR DOES NOT KNOW OR SUSPECT TO EXIST IN HIS OR HER {{strtoupper( __('stafflife.favour')) }} AT THE TIME OF EXECUTING THE RELEASE, WHICH IF KNOWN BY HIM OR HER MUST HAVE MATERIALLY AFFECTED HIS OR HER SETTLEMENT WITH THE DEBTOR." You hereby expressly waive and relinquish all rights and benefits under Section 1542 of the California Civil Code and any law or legal principle of similar effect in any jurisdiction with respect to the releases and/or discharges granted herein, including but not limited to the releases and/or discharges of unknown claims.</p>
               <h4>Termination</h4>
               <p>These Terms remain in effect while you use SL and, for registered users, as long as your account remains open. You may delete your account at any time. We may suspend or terminate your account or your access to parts of SL, without notice to you, if we believe that you have violated these Terms. All provisions of these Terms shall survive termination or expiration of these Terms except those granting access to or use of SL. We will have no liability whatsoever to you for any termination of your account or related deletion of your information.</p>
               <h4>Changes to Terms</h4>
               <p>We may revise these Terms from time by posting an updated version on SL and you agree that the revised Terms will be effective thirty (30) days after the change is posted. Your continued use of SL is subject to the most current effective version of these Terms.</p>
               <h4>Third-Party Discovery</h4>
               <p>You agree to waive your right to file a pre-suit discovery proceeding seeking a user's identifying information from SL. If you intend to propound discovery seeking a user's identifying information, you agree to do so pursuant to a valid California subpoena, properly issued in connection with an active lawsuit and properly served on our registered agent in California at SL, Inc., c/o CT Corporation, 818 W Seventh Street, Los Angeles, CA 90017. You further agree that discovery proceedings arising from such subpoenas shall be brought and resolved exclusively in the state courts located within Marin County, California or the federal courts in the Northern District of California, as appropriate, and you agree to submit to the personal jurisdiction of each of these courts for such discovery proceedings.</p>
               <h4>Other</h4>
               <p>Except as specifically stated in another agreement we have with you, these Terms constitute the entire agreement between you and us regarding the use of SL and these Terms supersede all prior proposals, negotiations, agreements, and understandings concerning the subject matter of these Terms. You represent and warrant that no person has made any promise, representation, or warranty, whether express or implied, not contained herein to induce you to enter into this agreement. Our failure to exercise or enforce any right or provision of the Terms shall not operate as a waiver of such right or provision. If any provision of the Terms is found to be unenforceable or invalid, then only that provision shall be modified to reflect the parties' intention or eliminated to the minimum extent necessary so that the Terms shall otherwise remain in full force and effect and enforceable. To the extent allowed by law, the English version of this Agreement is binding and the translations are provided for convenience only. The Terms, and any rights or obligations hereunder, are not assignable, transferable or sublicensable by you except with SL's prior written consent, but may be assigned or transferred by us without restriction. Any attempted assignment by you shall violate these Terms and be void. The section titles in the Terms are for convenience only and have no legal or contractual effect; as used in the Terms, the word "including" means "including but not limited to." Our terms and conditions will change from time to time, and you will be notified of such changes. </p>
            </div>
         </div>
         <div id="menu1" class="tab-pane fade">
            <h1 style="text-align:center;">User Terms and Conditions</h1>
            <h4 style="text-align:center; color:#4caf50;">PLEASE NOTE: These terms and conditions apply to all Users of StaffLife (Employees and Candidates). Any participation in this service will constitute acceptance of this agreement.</h4>
            <div class="row">
               <p>These terms and conditions are effective immediately for those registering accounts. All users of this or any other StaffLife (SL) website agree that access to and use of this site are subject to the following terms and conditions and other applicable law. Do not access or use the Site if you are unwilling or unable to be bound by the Terms.</p>
               <h3>Using StaffLife (SL)</h3>
               <h4>Indemnification</h4>
               <p>By agreeing to our terms and conditions, you understand that SL is a platform which is used to facilitate the submission of employment related information by a Member. SL is not involved in the hiring process of any Member, and cannot be held liable for any issues which may stem from the use of the platform by any Employer or Employee, whether directly or indirectly. Furthermore, you indemnify SL against any direct or indirect consequences which may result from having a SL Profile.</p>
               <h4>Creation of a SL account</h4>
               <p>You may create a Profile for yourself which future Employers may add to their accounts, or an account can be created for you by your Employer, provided your Employer is a Member and has obtained a signed SL Indemnification and Permission (SLIP). </p>
               <h4>Profile Email Address</h4>
               <p>You are responsible for ensuring that your personal email address remains up to date, and understand that such email address is monitored for StaffLife emails and updates.</p>
               <h4>Signing the SL Indemnification and Permission (SLIP) Form</h4>
               <p>In order for your Employer to add information to your SL Profile, or for a prospective Employer to view your SL Profile, such Member is required to generate a SLIP using your personal details, which is to be signed <b>before</b> creating, adding information to and/or accessing your Profile. When a SLIP is generated for you, you will be notified on the personal email address submitted to SL. By signing the SLIP, you indemnify both SL and the Member in whose details the SLIP is signed against any loss suffered directly or indirectly from the use of SL. </p>
               <h4>Accessing Profile information</h4>
               <p>A prospective Employer who is a Member of SL may only access your information by obtaining a signed SLIP. You are notified by email where a SLIP is generated, and are required to notify SL where a Member has created, added information to and/or looked up your Profile without first obtaining a signed SLIP. Only Members that you have expressly consented to doing so may access your Profile, however SL reserves the right to display/disclose your Profile. </p>
               <h4>Challenging information entered by Employers</h4>
               <p>Where an Employer adds information to the Ethics & Basics section of your SL Profile, you are entitled to challenge such information where it is not factually correct. You are notified by email of all changes to your SL Profile, and must challenge information within 30 days of being added to your Profile. Where a Member is unable to furnish evidentiary proof of challenged information, such information will be removed and the event will be recorded against the account of the Employer, which may hamper their future credibility on the system. Where a Member is able to furnish proof, your Profile will indicate that information was unsuccessfully challenged. Where information is unsuccessfully challenged twice in one year, you are not permitted to challenge any further information until the following year.</p>
               <h4>Falsifying Employer Profiles</h4>
               <p>You may not create an account on behalf of an Employer for any purpose whatsoever, without the consent of your Employer. To do so may constitute fraud, and will results in criminal action being taken against you. </p>
               <h4>False Performance Reviews</h4>
               <p>You cannot create false reviews for yourself. To do so may constitute fraud, and will results in criminal action being taken against you. </p>
               <h4>Updating of StaffLife Profiles</h4>
               <p>Your profile may be updated by an Employer that has obtained a signed SLIP from you. StaffLife reserves the right to {{ strtolower(__('stafflife.authorize')) }} the updating of StaffLife records without a signed SLIP, subject to written authorisation by a manager at StaffLife. </p>
               <h3>Storage of Data and Personal Information</h3>
               <h4>Data Storage </h4>
               <p>By using this website, you understand and accept that the data submitted to SL will be stored by SL. Once you have consented to information being added to your Profile by a Member, you understand and accept that this information will be added to and stored on your profile. Once you have consented to another Member accessing your profile, such member will have access to such information for a period of 30 days in the event that you are not added as an Employee under that Member’s account, or for the duration of employment should you be added as an Employee under that Member’s account. </p>
               <h4>Permission To Use Your Personal Information</h4>
               <p>By agreeing to the terms of this information form, I hereby voluntarily authorise SL to process my personal information (including my name, {{ strtolower(__('stafflife.idnumber')) }} physical address, telephone numbers and other information submitted to SL by any Member employer). Processing shall include the receipt, recording, organising, collation, storage, updating or modification, retrieval, alteration, consultation, use; dissemination by means of transmission, distribution or making available in any other form; or merging, linking, as well as blocking, degradation, erasure of destruction of information. This consent is effective immediately.
                  I furthermore take note that by creating a Profile and/or signing a SLIP, supplying SL with the above-mentioned information I consent to use of my information in accordance with the SL model.
               </p>
               <h4>Your Right In Terms Of This Consent</h4>
               <p>You have the right to grant/refuse consent to any Member to add information to your profile. Without consent being granted through a SLIP, a Member is not permitted to add information to your Profile. You have the right to know what information is being kept, how that information is being used and when SL will disclose that information. This information is contained both in these Terms and Conditions, as well as in our Privacy Policy.<br>
                  You have the right to correct your personal details, such as your name, {{ strtolower(__('stafflife.idnumber')) }} and personal email address. You may amend these details by logging in to your SL Profile. 
               </p>
               <h4>Consent To Receive Marketing Information</h4>
               <p>By agreeing to the terms of this consent form and by ticking this box, I expressly consent to the processing of my information for marketing purposes and know and understand that by agreeing to same that I may receive marketing materials in the form of SMS’s, emails and the like from SL.</p>
               <h3>Other Terms of Use</h3>
               <h4>Undertaking by Employee</h4>
               <p>By using SL, signing a SLIP and/or creating a SL Profile, you agree that you will not:<br>
                  1.  Impersonate an Employer, or his or her email address, or misrepresent your current or former affiliation with such Employer;<br>
                  2.  Create user accounts under false or fraudulent {{ __('stafflife.pretences') }}; create or use an account for anyone other than yourself;<br>
                  3.  Post Content to an Employee’s Profile as an Employer, without express consent from said Employer;<br>
                  4.  Accessing another Employee’s Profile without express consent from the Employer Member whose account is used to access the Employee’s Profile;<br>
                  5.  Violate these Terms, the terms of your agreements with us, explicit restrictions set forth in our Community Guidelines, or any applicable law, rule or regulation;<br>
                  6.  Post Content that is defamatory, {{ __('stafflife.libelous') }}, or fraudulent; that you know to be false or misleading; or that does not reflect your honest opinion and experience;<br>
                  7.  Act in a manner that is threatening, racist or bigoted, or is otherwise objectionable (as determined by SL);<br>
                  8.  Promote, endorse or further illegal activities;<br>
                  9.  Disclose information in violation of any legally enforceable confidentiality, non-disclosure or other contractual restrictions or rights of any third party, including any current or former Employers or potential Employers;<br>
                  10. Violate the privacy, publicity, copyright, patent, trademark, trade secret, or other intellectual property or proprietary rights of SL or any third-party;<br>
                  11. Add any content or data which is pornographic or sexually explicit in nature, or engage in the exploitation of persons in a sexual or violent manner; <br>
                  12. Except as expressly approved by us, use SL for commercial activities and/or promotions such as contests, sweepstakes, barter, pyramid schemes, advertising, affiliate links, and other forms of solicitation;<br>
                  13. Imply a SL endorsement or partnership of any kind without our express written permission;<br>
                  14. Introduce software or automated agents to SL, or access SL so as to produce multiple accounts, generate automated messages, or to scrape, strip or mine data from SL without our express written permission;<br>
                  15. “Frame” or “mirror” or otherwise incorporate part of SL into any website, or “deep-link” to any portion of SL without our express written permission.<br>
                  16. Copy, modify or create derivative works of SL (including SL Content) without our express written permission;<br>
                  17. Copy or use the information, content, or data on SL in connection with a competitive service (as determined by SL);<br>
                  18. Sell, resell, rent, lease, loan, trade or otherwise {{ __('stafflife.monetise') }} access to SL or any SL Content without our express written permission;<br>
                  19. Interfere with, disrupt, modify, reverse engineer, or decompile any data or functionality of SL;<br>
                  20. Interfere with, disrupt, or create an undue burden on SL or the networks or services connected to SL;<br>
                  21. Introduce any viruses, Trojan horses, worms, time bombs, cancelbots, corrupted files, or similar software to SL;<br>
                  22. Attempt to circumvent any security feature of SL; or<br>
                  23. Expose us or our users to any harm or liability.
               </p>
               <h4>Links to Third-Party Websites</h4>
               <p>SL may contain links to third-party websites placed by us as a service to those interested in this information, or posted by other users. Your use of all such links to third-party websites is at your own risk. We do not monitor or have any control over, and make no claim or representation regarding third-party websites. To the extent such links are provided by us, they are provided only as a convenience, and a link to a third-party website does not imply our endorsement, adoption or sponsorship of, or affiliation with, such third-party website. When you leave SL, our terms and policies do not govern your use of third-party websites.</p>
               <h4>Other</h4>
               <p>Except as specifically stated in another agreement we have with you, these Terms constitute the entire agreement between you and us regarding the use of SL and these Terms supersede all prior proposals, negotiations, agreements, and understandings concerning the subject matter of these Terms. Our terms and conditions will change from time to time, and you will be notified of such changes. </p>
               <p>PLEASE READ THE FOLLOWING TERMS AND CONDITIONS OF USE CAREFULLY BEFORE USING THIS WEBSITE.</p>
               <h3>Intellectual Property</h3>
               <h4>Copyright</h4>
               <p>The entire content included in this site, including but not limited to text, graphics or code is copyrighted as a collective work under the South African and other copyright laws, and is the property of SL. You may display and, subject to any expressly stated restrictions or limitations relating to specific material, download or print portions of the material from the different areas of the site solely for your own non-commercial use, or to place an order with SL or to purchase SL products.</p>
               <p>Any other use, including but not limited to the reproduction, distribution, display or transmission of the content of this site is strictly prohibited, unless {{ strtolower(__('stafflife.authorized')) }} by SL. You further agree not to change or delete any proprietary notices from materials downloaded from the site.</p>
               <h4>Trademarks</h4>
               <p>All trademarks, service marks and trade names of SL used in the site are trademarks or registered trademarks of SL.</p>
               <h4>Replication of the SL Indemnification and Permission (SLIP) Form</h4>
               <p>Replication of the SLIP form constitutes an intellectual property infringement, and will result in legal action being taken against the Member company. </p>
               <h3>General</h3>
               <h4>Warranty Disclaimer</h4>
               <p>This site and the materials and products on this site are provided "as is" and without warranties of any kind, whether express or implied. To the fullest extent permissible pursuant to applicable law, SL disclaims all warranties, express or implied, including, but not limited to, implied warranties of merchantability and fitness for a particular purpose and non-infringement. SL does not represent or warrant that the functions contained in the site will be uninterrupted or error-free, that the defects will be corrected, or that this site or the server that makes the site available are free of viruses or other harmful components.
                  SL does not make any warranties or representations regarding the use of the materials in this site in terms of their correctness, accuracy, adequacy, usefulness, timeliness, reliability or otherwise.
               </p>
               <h4>Limitation of Liability</h4>
               <p>SL shall not be liable for any special or consequential damages that result from the use of, or the inability to use, the materials on this site or the performance of the products, even if SL has been advised of the possibility of such damages.</p>
               <h4>Typographical Errors</h4>
               <p>In the event that a product is mistakenly listed on the site at an incorrect price, SL reserves the right to refuse or cancel any orders placed for product listed at the incorrect price. SL reserves the right to refuse or cancel any such orders whether or not the order has been confirmed and your credit card charged. If your credit card has already been charged for the purchase and your order is cancelled, SL shall issue a credit to your credit card account in the amount of the incorrect price.</p>
               <h4>Term; Termination</h4>
               <p>These terms and conditions are applicable to you upon your accessing the site and/or completing the registration or shopping process. These terms and conditions, or any part of them, may be terminated by SL without notice at any time, for any reason. The provisions relating to Copyrights, Trademark, Disclaimer, Limitation of Liability, Indemnification and Miscellaneous, shall survive any termination.</p>
               <h4>Notice</h4>
               <p>SL may deliver notice to you by means of e-mail, a general notice on the site, or by other reliable method to the contact information you have provided to SL.</p>
               <h4>Miscellaneous</h4>
               <p>Your use of this site shall be governed in all respects by the laws of the Republic of South Africa, without regard to choice of law provisions, and not by the 1980 U.N. Convention on contracts for the international sale of goods. You agree that jurisdiction over and venue in any legal proceeding directly or indirectly arising out of or relating to this site (including but not limited to the purchase of SL products) shall be in the Province where SL head offices are located. Any cause of action or claim you may have with respect to the site (including but not limited to the purchase of SL products or services) must be commenced within one (1) year after the claim or cause of action arises.</p>
               <p>SL’s failure to insist upon or enforce strict performance of any provision of these terms and conditions shall not be construed as a waiver of any provision or right. Neither the course of conduct between the parties nor trade {{ __('stafflife.practice') }} shall act to modify any of these terms and conditions. SL may assign its rights and duties under this Agreement to any party at any time without notice to you.</p>
               <h4>Use of Site</h4>
               <p>Harassment in any manner or form on the site, including via e-mail, chat, or by use of obscene or abusive language, is strictly forbidden. Impersonation of others, including a SL or other {{ __('stafflife.licence') }}dEmployee, host, or representative, as well as other Members or visitors on the site is prohibited. You may not upload to, distribute, or otherwise publish through the site any content which is {{ __('stafflife.libelous') }}, defamatory, obscene, threatening, invasive of privacy or publicity rights, abusive, illegal, or otherwise objectionable which may constitute or encourage a criminal {{ __('stafflife.offence') }}, violate the rights of any party or which may otherwise give rise to liability or violate any law. You may not upload commercial content on the site or use the site to solicit others to join or become Members of any other commercial online service or other {{ __('stafflife.organization') }}.</p>
               <h4>Participation Disclaimer</h4>
               <p>SL does not and cannot review all communications and materials posted to or created by users accessing the site, and is not in any manner responsible for the content of these communications and materials. You acknowledge that by providing you with the ability to view and distribute user-generated content on the site, SL is merely acting as a passive conduit for such distribution and is not undertaking any obligation or liability relating to any contents or activities on the site.</p>
               <p>However, SL reserves the right to block or remove communications or materials that it determines to be (a) abusive, defamatory, or obscene, (b) fraudulent, deceptive, or misleading, (c) in violation of a copyright, trademark or; other intellectual property right of another or (d) offensive or otherwise unacceptable to SL in its sole discretion.</p>
               <h4>Indemnification</h4>
               <p>You agree to indemnify, defend, and hold harmless SL, its officers, directors, Employees, agents, licensors and suppliers (collectively the "Service Providers") from and against all losses, expenses, damages and costs, including reasonable attorneys' fees, resulting from any violation of these terms and conditions or any activity related to your account (including negligent or wrongful conduct) by you or any other person accessing the site using your Internet account.</p>
               <p>The SL site and all content are provided on an "as is" basis. The contents of the site, such as text, graphics, images, information obtained from SL's licensors, and other material contained on the SL site ("Content") are for informational purposes only and do not constitute advice. The user is encouraged to consult with a professional advisor before acting on any information or content appearing on or transmitted through SL's web site. Nothing on the site shall be construed as an offer by SL to the user, but merely an invitation to do business.</p>
               <h4>Third-Party Links</h4>
               <p>In an attempt to provide increased value to our visitors, SL may link to sites operated by third parties. However, even if the third party is affiliated with SL, SL has no control over these linked sites, all of which have separate privacy and data collection practices, independent of SL. These linked sites are only for your convenience and therefore you access them at your own risk. Nonetheless, SL seeks to protect the integrity of its web site and the links placed upon it and therefore requests any feedback on not only its own site, but for sites it links to as well (including if a specific link does not work).</p>
               <h4>User Content</h4>
               <p>You agree that you will not upload or transmit any communications or content of any type to any public areas that infringe or violate any rights of any party. By submitting communications or content to SL, you agree that such submission is non-confidential for all purposes.</p>
               <p>If you make any submission to a public area or if you submit any business information, idea, concept or invention to SL by email, you automatically grant-or warrant that the owner of such content or intellectual property has expressly granted SL a royalty-free, perpetual, irrevocable, world-wide nonexclusive {{ __('stafflife.licence') }} to use, reproduce, create derivative works from, modify, publish, edit, translate, distribute, perform, and display the communication or content in any media or medium, or any form, format, or forum now known or hereafter developed. If you wish to keep any business information, ideas, concepts or inventions private or proprietary, do not submit them to the site or to SL by email. We try to answer every email in a timely manner, but are not always able to do so.</p>
               <p>You agree to only post or upload Media (like photos, videos or audio) that you have taken yourself or that you have all rights to transmit and {{ __('stafflife.licence') }} and which do not violate trademark, copyright, privacy or any other rights of any other person. Photos or videos of celebrities and cartoon or comic images are usually copyrighted by the owner.</p>
               <p>By uploading or submitting any media on the SL site, you warrant that you have permission from all persons appearing in your media for you to make this contribution and grant rights described herein. Never post a picture or video of or with someone else unless you have their explicit permission.</p>
               <p>It is strictly prohibited to upload media of any kind that contain expressions of hate, abuse, offensive images or conduct, obscenity, pornography, sexually explicit or any material that could give rise to any civil or criminal liability under applicable law or regulations or that otherwise may be in conflict with these Terms and Conditions or the Privacy Policy.</p>
               <p>You agree that you will not upload any material that contains software viruses or any other computer code, files or programs designed to interrupt, destroy or limit the functionality of any computer software or this web site.</p>
               <p>By uploading any media like a photo or video, (a) you grant SL a perpetual, non-exclusive, worldwide, royalty-free {{ __('stafflife.licence') }} to use, copy, print, display, reproduce, modify, publish, post, transmit and distribute the media and any material included in the media; and (b) you certify that any person pictured in the submitted media (or, if a minor, his/her parent/legal guardian) {{ strtolower(__('stafflife.authorize')) }}s SL to use, copy, print, display, reproduce, modify, publish, post, transmit and distribute the media and any material included in such media; and (c) you agree to indemnify SL and its affiliates, directors, officers and Employees and hold them harmless from any and all claims and expenses, including attorneys' fees, arising from the media and/or your failure to comply with these the terms described in this document.</p>
               <p>SL reserves the right to remove any media for any reason, at any time, without prior notice, at our sole discretion.</p>
               <h4>Removal of Content</h4>
               <p>While SL has no obligation to do so, SL reserves the right to review and delete (or modify) any Content that we believe, in our sole discretion, violates these Terms or other applicable policies posted on SL (including our Community Guidelines), or that we deem, in our sole discretion, inappropriate. If you see any Content on SL that you believe violates our policies, you may report that Content by clicking on an applicable link adjacent to that Content (e.g. links titled: "Inappropriate" or "Flag Review") or by contacting us here. Once notified, we will review the Content and consider whether to remove or modify it. Please note: Our interpretation of our policies and the decision whether or not to edit or remove Content is within our sole discretion. You understand and agree that if we choose not to remove or edit Content that you find objectionable, that decision will not constitute a violation of these Terms or any agreement we have with you. For more information please see our Legal FAQs.</p>
               <p>Copyright Policy. Please see our Copyright Complaint Policy for information about copyright and trademark disputes.</p>
               <p>Other Enforcement Actions. While we have no obligation to do so, we reserve the right to investigate and take appropriate action in our sole discretion against you if you violate these Terms, including without limitation: removing Content from SL (or modifying it); suspending your rights to use SL; terminating your Membership and account; reporting you to law enforcement, regulatory authorities, or administrative bodies; and taking legal action against you.</p>
               <p>Defending Our Users. While we have no obligation to do so, we reserve the right, to the fullest extent permitted by applicable law, to take appropriate action to protect the anonymity of our users against the enforcement of subpoenas or other information requests that seek a user's electronic address or identifying information.</p>
               <h4>Rights to Your Content</h4>
               <p>We do not claim ownership in any Content that you submit to SL, but to be able to legally provide SL to our users, we have to have certain rights to use such Content in connection with SL, as set forth below. By submitting any Content to SL, you hereby grant to us an unrestricted, irrevocable, perpetual, non-exclusive, fully-paid and royalty-free, {{ __('stafflife.licence') }} (with the right to sublicence through unlimited levels of sublicences) to use, copy, perform, display, create derivative works of, adapt and distribute such Content in any and all media (now known or later developed) throughout the world. To the greatest extent permitted by applicable law, you hereby expressly waive any and all of your moral rights applicable to SL's exercise of the foregoing {{ __('stafflife.licence') }}. No compensation will be paid with respect to the Content that you post through SL. You should only submit Content to SL that you are comfortable sharing with others under the terms and conditions of these Terms.</p>
               <h4>Rights to SL Content</h4>
               <p>SL contains Content provided by us and our licensors. We and our licensors (including other users) own and retain all proprietary (including all intellectual property) rights in the Content we each provide and SL owns and retains all property rights in SL. If you are a user, we hereby grant you a limited, revocable, non-sublicensable {{ __('stafflife.licence') }} under the intellectual property rights licensable by us to download, view, copy and print Content from SL solely for your personal use in connection with using SL. Except as provided in the foregoing, you agree not to: (1) reproduce, modify, publish, transmit, distribute, publicly perform or display, sell, adapt or create derivative works based on SL or the Content (excluding Your Content); or (2) rent, lease, loan, or sell access to SL. SL ® is a registered trademark of SL, Inc. The trademarks, logos and service marks ("Marks") displayed on SL are our property or the property of third parties. You are not permitted to use these Marks without our prior written consent or the consent of the third party that owns the Mark.</p>
               <h4>Indemnity</h4>
               <p>You agree to defend, indemnify, and hold us and our subsidiaries and our and their respective officers, directors, board Members, board advisors, Employees, partners, agents successors and assigns (collectively, the "SL Group") harmless from any loss, liability, claim, or demand, including reasonable attorneys’ fees, made by any third party due to or otherwise arising from your use of SL, including due to or arising from your breach of any provision of these Terms.</p>
               <h4>Disclaimers and Limitation on Liability</h4>
               <p>The disclaimers and limitations on liability in this section apply to the maximum extent allowable under applicable law. Nothing in this section is intended to limit any rights you have which may not be lawfully limited.</p>
               <p>You are solely responsible for your interactions with advertisers and other users and we are not responsible for the activities, omissions, or other conduct, whether online or offline, of any advertiser or user of SL. We are not responsible for any incorrect, inaccurate, or unlawful Content (including any information in Profiles) posted on SL, whether caused by users or by any of the equipment or programming associated with or {{ strtolower(__('stafflife.utilize')) }}d in SL. We assume no responsibility for any error, omission, interruption, deletion, defect, delay in operation or transmission, communications line failure, theft or destruction or {{ strtolower(__('stafflife.unauthorized')) }}d access to, or alteration of, any communication with advertisers or other users. We are not responsible for any problems or technical malfunction of any hardware and software due to technical problems on the Internet or on SL or combination thereof, including any injury or damage to users or to any person's computer related to or resulting from participation or downloading materials in connection with SL. Under no circumstances shall we be responsible for any loss or damage resulting from use of SL or from any Content posted on SL or transmitted to users, or any interactions between users of SL, whether online or offline.</p>
               <p>SL is provided "as-is" and as available. We expressly disclaim any warranties and conditions of any kind, whether express or implied, including the warranties or conditions of merchantability, fitness for a particular purpose, title, quiet enjoyment, accuracy, or non-infringement. We make no warranty that: (1) SL will meet your requirements; (2) SL will be available on an uninterrupted, timely, secure, or error-free basis; or (3) the results that may be obtained from the use of SL will be accurate or reliable.</p>
               <p>You hereby release the SL Group from any and all claims, demands, and losses, damages, rights, claims, and actions of any kind that are either directly or indirectly related to or arises from: (1) any interactions with other users of SL, or (2) your participation in any of our offline events.</p>
               <p>IN NO EVENT SHALL THE SL GROUP BE LIABLE TO YOU OR ANY THIRD PARTY FOR ANY LOST PROFIT OR ANY INDIRECT, CONSEQUENTIAL, EXEMPLARY, INCIDENTAL, SPECIAL, OR PUNITIVE DAMAGES ARISING FROM YOUR USE OF SL, EVEN IF WE HAVE BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES. NOTWITHSTANDING ANYTHING TO THE CONTRARY CONTAINED HEREIN, WHERE PERMITTED BY APPLICABLE LAW, YOU AGREE THAT THE SL GROUP’S LIABILITY TO YOU FOR ANY DAMAGES ARISING FROM OR RELATED TO YOUR USE OF SL (FOR ANY CAUSE WHATSOEVER AND REGARDLESS OF THE FORM OF THE ACTION), WILL AT ALL TIMES BE LIMITED TO ONE HUNDRED U.S. DOLLARS ($100).</p>
               <p>You acknowledge that you are familiar with the provisions of Section 1542 of the California Civil Code, which provides as follows: "A GENERAL RELEASE DOES NOT EXTEND TO CLAIMS WHICH THE CREDITOR DOES NOT KNOW OR SUSPECT TO EXIST IN HIS OR HER {{strtoupper( __('stafflife.favour')) }} AT THE TIME OF EXECUTING THE RELEASE, WHICH IF KNOWN BY HIM OR HER MUST HAVE MATERIALLY AFFECTED HIS OR HER SETTLEMENT WITH THE DEBTOR." You hereby expressly waive and relinquish all rights and benefits under Section 1542 of the California Civil Code and any law or legal principle of similar effect in any jurisdiction with respect to the releases and/or discharges granted herein, including but not limited to the releases and/or discharges of unknown claims.</p>
               <h4>Termination</h4>
               <p>These Terms remain in effect while you use SL and, for registered users, as long as your account remains open. You may delete your account at any time. We may suspend or terminate your account or your access to parts of SL, without notice to you, if we believe that you have violated these Terms. All provisions of these Terms shall survive termination or expiration of these Terms except those granting access to or use of SL. We will have no liability whatsoever to you for any termination of your account or related deletion of your information.</p>
               <h4>Changes to Terms</h4>
               <p>We may revise these Terms from time by posting an updated version on SL and you agree that the revised Terms will be effective thirty (30) days after the change is posted. Your continued use of SL is subject to the most current effective version of these Terms.</p>
               <h4>Third-Party Discovery</h4>
               <p>You agree to waive your right to file a pre-suit discovery proceeding seeking a user's identifying information from SL. If you intend to propound discovery seeking a user's identifying information, you agree to do so pursuant to a valid California subpoena, properly issued in connection with an active lawsuit and properly served on our registered agent in California at SL, Inc., c/o CT Corporation, 818 W Seventh Street, Los Angeles, CA 90017. You further agree that discovery proceedings arising from such subpoenas shall be brought and resolved exclusively in the state courts located within Marin County, California or the federal courts in the Northern District of California, as appropriate, and you agree to submit to the personal jurisdiction of each of these courts for such discovery proceedings.</p>
               <h4>Other</h4>
               <p>Except as specifically stated in another agreement we have with you, these Terms constitute the entire agreement between you and us regarding the use of SL and these Terms supersede all prior proposals, negotiations, agreements, and understandings concerning the subject matter of these Terms. You represent and warrant that no person has made any promise, representation, or warranty, whether express or implied, not contained herein to induce you to enter into this agreement. Our failure to exercise or enforce any right or provision of the Terms shall not operate as a waiver of such right or provision. If any provision of the Terms is found to be unenforceable or invalid, then only that provision shall be modified to reflect the parties' intention or eliminated to the minimum extent necessary so that the Terms shall otherwise remain in full force and effect and enforceable. To the extent allowed by law, the English version of this Agreement is binding and the translations are provided for convenience only. The Terms, and any rights or obligations hereunder, are not assignable, transferable or sublicensable by you except with SL's prior written consent, but may be assigned or transferred by us without restriction. Any attempted assignment by you shall violate these Terms and be void. The section titles in the Terms are for convenience only and have no legal or contractual effect; as used in the Terms, the word "including" means "including but not limited to." Our terms and conditions will change from time to time, and you will be notified of such changes. </p>
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
      
          console.log('nav_section is <?php echo $nav_section; ?>');
      
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