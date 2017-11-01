@extends('layouts/defaultboth')

{{-- Page title --}}
@section('title')
    Privacy Policy
    @parent
@stop

<?php $og = new OpenGraph(); 
$og->title('Privacy Policy - StaffLife.com')
        ->image("")
        ->description("All users of this or any other StaffLife website agree that access to and use of this site are subject to this privacy policy and other applicable law.")
        ->url();
?>

<head>
{!! $og->renderTags() !!}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
</head>

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

        ul {list-style-type: disc;}
    </style>
@stop

<?php
if (Session::has('custom_lang')) {
    $locale = Session::get('custom_lang');
} else {
    $locale = 'za';
}

switch ($locale) {
    case 'za':
        $call_centre = '+27 86 147 6984';
        $country = 'The Republic Of South Africa';
        $citizenry = 'South African';
        break;
    case 'us':
        $call_centre = '+1 212 551 1419';
        $country = 'The United States Of America';
        $citizenry = 'American';
        break;
    case 'gb':
    case 'uk':
        $call_centre = '+44 870 875 1921';
        $country = 'Great Britain';
        $citizenry = 'British';
        break;
    case 'au':
        $call_centre = '+61 2 8216 0848';
        $country = 'Australia';
        $citizenry = 'Australian';
        break;
    case 'ca':
        $call_centre = '+1 212 551 1419';
        $country = 'Canada';
        $citizenry = 'Canadian';
        break;
    case 'ie':
        $call_centre = '+44 870 875 1921';
        $country = 'Ireland';
        $citizenry = 'Irish';
        break;
    case 'nz':
        $call_centre = '+61 2 8216 0848';
        $country = 'New Zealand';
        $citizenry = 'New Zealand';
        break;
    default:
        $call_centre = '+1 212 551 1419';
        $country = 'The Republic Of South Africa';
        $citizenry = 'South African';
}
?>

{{-- Page content --}}
@section('content')
    <!-- Container Section Start -->
    <div class="jumbotext text-center">
        <h1>Privacy Policy</h1>
    </div>

    <!-- FAQ Section Start -->
    <div class="container marbottom" style="padding-top:30px !important; padding-bottom:20px;">
        <div class="tab-content" id="privacy">
            <div style="font-weight: bold">PLEASE READ THE FOLLOWING TERMS AND CONDITIONS OF USE CAREFULLY BEFORE USING THIS WEBSITE.
            </div>
            <p>We understand that your privacy while using our Site is important, especially when conducting business or providing sensitive personal information. This notice will govern our Privacy Policy for users of this or any other StaffLife (SL) website, whether or not a transaction of any sort is conducted while visiting.</p>
            <p>These terms and conditions are effective immediately for those registering accounts. All users of this or any other StaffLife (SL) website agree that access to and use of this site are subject to the following terms and conditions and other applicable law. Do not access or use the Site if you are unwilling or unable to be bound by the Terms.</p>

            <h3 style="color: #4caf50;">Online Privacy Statement
            </h3>
            <br/>
            <p>
               SL believes that privacy is important to the success and use of the Internet. This statement sets forth SL’s policy and describes the practices that we will follow with respect to the privacy of the information of users of this site. Should you have any questions about this policy or our practices, please send an email to info@StaffLife.com.<br>
            </p>
            <p>You can also call us at {{ $call_centre }}.</p>
<h3 style="color: #4caf50;">What Personal Information We Collect
            </h3>
            <br/>
            <em>Your Personal Information</em>
            <br/>
            The information we learn from customers helps us to personalise and continually improve our customer service, while developing ways to improve your experience at SL. The following is some of the information we gather about our users.
            <br/><br/>
            <em>Information You Provide Us</em>
            <br/>
            When you complete a Customer Profile or other form online or communicate with us via e-mail, letter, fax or phone, we receive and store the information you've provided. This information is your basic details, including: name, addresses, phone, fax and mobile phone numbers, e-mail address, interests and business information (if applicable). We use this information that you provide for such purposes as responding to your requests, communicating with you and {{ __('stafflife.customizing') }} future services for you.
            <br/>
            SL collects your personal information online when you voluntarily provide it to us. If you choose to register online, we ask you to provide limited personal information and information relating to a Member/Employer. We also collect information that will allow you to establish a username and password if you would like to do that.
            <br/><br/>
            <em>Third Party Vendors</em>
            <br/>
            In addition to collecting your information, we may have third party vendors who will also collect your information in order to provide the products and/or services you've requested (e.g. credit card companies or banks, fulfilment companies, call {{strtolower( __('stafflife.centre')) }}s, suppliers, affiliates and marketing companies). In general, these companies are intermediaries acting solely to provide services related to your request. Most of these vendors have their own privacy policy to protect your information, and have access to personal information needed to perform their functions on behalf of SL, but may not use the same for other purposes.
            <br/><br/>
            <em>Information From Other Sources</em>
            <br/>
            We might receive information about you from other sources and add it to our account information. Examples may include, but not be limited to, updated delivery and address information from our carriers or other third parties, which we use to correct our records and deliver your next purchase or communication more easily; account information, purchase or redemption information, and page-view information from some merchants with which we operate co-branded businesses or for which we provide technical, fulfilment, advertising, or other services; search term and search result information from searches conducted through the Web search features offered by certain {{strtolower( __('stafflife.organisations')) }}; search results and links, including paid listings (such as Sponsored Links); and credit history information from credit bureaus, which we use to help prevent and detect fraud and to offer certain credit or financial services to some customers, and information from data providers.
            <br/><br/>
            <h3 style="color: #4caf50;">Cookie Placement
            </h3>
            <br/>
            Certain SL websites, like many other commercial sites, may use a standard technology called "cookies" to collect information about how our site is used. Cookies were designed to help a website operator determine that a particular user had visited the site previously and thus save and remember any preferences that may have been set. We may use cookies to keep track of information about your current web browsing session which will be discarded as soon as you log out or close your web browser. This information also allows us to statistically monitor how many people are using our site and for what purpose. We may also make use of “persistent or memory based” cookies, which remain on your computer’s hard drive until you delete them. An example of our use of these cookies is to pre-populate forms you complete on our website based on information you have previously provided to us. Although you have the ability to modify your browser to either accept all cookies, notify you when a cookie is sent, or reject all cookies, it may not be possible to {{strtolower( __('stafflife.utilize')) }} our services if you reject cookies.
            <br/>
            SL uses the services of Google Analytics, and may use other similar services, to collect and {{ __('stafflife.analyze') }} statistical data about visitors to our website. We also use Google advertising services, and may use other similar services, to arrange for you to see SL advertisements when you visit certain third party websites. These analytic and advertising services do not collect personally identifiable information. You may elect to opt out of the use of non-personally identifiable data by Google Analytics by downloading and installing an add-on to your web browser found <a href="https://tools.google.com/dlpage/gaoptout">here</a>. You may find out more about how Google Analytics collects and processes data by visiting “How Google uses data when you use our partners’ sites or apps,” found <a href="https://adssettings.google.com/u/0/authenticated">here</a>. For additional information about opting out of interest-based advertising, please visit this <a href="http://optout.networkadvertising.org/#!/">page</a>.
            <br/><br/>
            <h3 style="color: #4caf50;">How to Review and Change Your Personal Information
            </h3>
            <br/>
            If you register for a SL account, you may review and change your personal information by logging in, then clicking “Manage My Account”.
            <br/><br/>
            <h3 style="color: #4caf50;">How We Use Personal Information That We Collect Online
            </h3>
            <br/>
            Information collected by SL is used in accordance with the purpose of the website. Under no circumstances will we ever give away or sell your personal information to anyone else for any reason whatsoever, without prior written approval from yourself. Any information we gain through our use of customer polls, surveys, cookies, session tracking or anything else, is used internally and for the sole purpose of providing you better service. If you are on our mailing list and you ask us to remove you, we will do so immediately and will not attempt to on sell your information. As we do with our own, we respect your privacy.
Information about our customers is an important part of our business, and we are not in the business of selling it to other companies. We share customer information only as described in this statement and with subsidiaries of SL with controls that are either subject to this Privacy Notice or follow the {{strtolower( __('stafflife.practice')) }}at least as protective as that described in this Notice.
            <br/><br/>
            <h3 style="color: #4caf50;">Internal Uses
            </h3>
            <br/>
            SL reserves the right to use data collected and/or submitted for marketing, research, strategy and other related purposes. We may use the information we collect:<br/><br/>
            <ul>
                <li>to provide you with {{ __('stafflife.personalized') }} content and services;</li>
                <li>to moderate and display the employer reviews and other Profile data submitted for the benefit of our other users;
                </li>
                <li>to{{ __('stafflife.customize') }} and improve the features, performance, and support of the site;
                </li>
                <li>to show you relevant information, if you connect to SL through a Social Networking Site, from your Social Networking Site friends and connections, and to allow you to SL information with them;
                </li>
                <li>to provide relevant advertising, including interest-based advertising from us and third parties, which may mean that we share non-personally identifiable information, such as your job title, to third-party advertisers;
                </li>
                <li>to provide recruiting services to employers;</li>
                <li>for internal operations, including troubleshooting, data analysis, testing, research, and service improvement;
                </li>
                <li>to communicate with you regarding our services;</li>
                <li>to {{ __('stafflife.analyze') }} use of SL and improve SL;</li>
                <li>to create aggregate and statistical data that does not identify you individually and that we can {{ __('stafflife.commercialize') }};
                </li>
                <li>for other purposes that you separately {{ __('stafflife.authorize') }} as you interact with SL.</li>
            </ul>
            <br/><br/>
            <h3 style="color: #4caf50;">Disclosure of Personal Information to Third Parties
            </h3>
            <br/>
            We will not disclose any personal information to any third party, unless (1) you have {{ __('stafflife.authorize') }} us to do so; (2) we are legally required to do so, for example, in response to a subpoena, court order or other legal process and/or, (3) it is necessary to protect our property rights related to this website. We also may share aggregate, non-personal information about website usage with unaffiliated third parties. This aggregate information does not contain any personal information about our users.
            <br/><br/>
            <h3 style="color: #4caf50;">How Can You Help Protect Your information?
            </h3>
            <br/>
            If you are using a SL website for which you registered and choose a password, we recommend that you do not divulge your password to anyone. We will never ask you for your password in an unsolicited phone call or in an unsolicited email. Also remember to sign out of the SL website and close your browser window when you have finished your work. This is to ensure that others cannot access your personal information and correspondence if others have access to your computer.
            <br/><br/>
            <h3 style="color: #4caf50;">How We Protect Information Online
            </h3>
            <br/>
            We exercise great care to protect your personal information. This includes, among other things, using industry standard techniques such as firewalls, encryption, and intrusion detection. As a result, while we strive to protect your personal information, we cannot ensure or warrant the security of any information you transmit to us or receive from us. This is especially true for information you transmit to us via email since we have no way of protecting that information until it reaches us since email does not have the security features that are built into our websites. We review our security arrangements from time to time as we deem appropriate.
            <br/><br/>
            <h3 style="color: #4caf50;">How Secure is the Information About Me?
            </h3>
            <br/>
            All of our employees and partners are familiar with our security policy and practices. Your personal information is only accessible to a limited number of qualified people who are given a password in order to gain access to the information. We audit our security systems and processes on a regular basis. Sensitive information, such as credit card numbers or social security numbers, is protected by encryption protocols, in place to protect information sent over the Internet.
            <br/>
            While we take commercially reasonable measures to maintain a secure site, electronic communications and databases are subject to errors, tampering and break-ins, and we cannot guarantee or warrant that such events will not take place and we will not be liable for any such occurrences. You will find that almost all Internet e-commerce providers make this same claim, especially if they use privacy policy templates such as this one to make known their company or {{ __('stafflife.organization') }} privacy policies.<br/>
            Where possible, we reveal only the last five digits of your credit card numbers when confirming an order. Of course, we transmit the entire credit card number to the appropriate credit card company during order processing. Protect against {{ __('stafflife.unauthorized') }} access to your password and to your computer by signing off when you finish using a computer.
            <br/><br/>
            <h3 style="color: #4caf50;">What Choices Do I Have?
            </h3>
            <br/>
            You can add or update certain information on your SL account at any time. If you do not want to receive e-mails or other mail from us, simply click the Preferences link at the footer of any email sent by SL and you will be removed from our mailing list. To remove other personal information from SL, please contact our offices. Please note that you cannot opt-out of communication pertaining to services such as subscription confirmation, payment reminders, challenges by employees etc. on SL.
            <br/><br/>
            <h3 style="color: #4caf50;">Conditions of Use, Notices, and Revisions
            </h3>
            <br/>
            If you choose to visit SL, your visit and any dispute over privacy is subject to this Notice and our Terms and Conditions, including limitations on damages, arbitration of disputes, and application of the laws of
            {{ $country }}. If you have any concern about privacy at our site, please contact us with a thorough description, and we will try to resolve it. <br/>
            Because our business changes constantly, our Privacy Notice and the Terms and Conditions will also change. We may e-mail periodic reminders of our notices and conditions, unless you have instructed us not to, but you should check our website frequently to see recent changes. <br/>
            Unless stated otherwise, our current Privacy Notice applies to all information that we have about you and your account.
            <br/><br/>
            <h3 style="color: #4caf50;">Links to Other Sites
            </h3>
            <br/>
            We want to provide site visitors valuable information, services and products. Featured programs and other site content within the SL site may link our users to third party sites. SL does not control and is not responsible for practices of any third-party websites. <br/>
            Note: From time to time, we may change this privacy statement. For example, as we update and improve our services, new features may require modifications to the privacy statement. Accordingly, please check back periodically.
            <br/><br/>
            
            {{ $citizenry }} {{ __('stafflife.labourregulatorbody') }} laws shall supersede any SL terms and conditions
            which conflict with the act or any other laws in {{ $country }}.<br />
            SL’s Contact Information – Telephone: {{ $call_centre }} | Email: <a href="mailto:info@stafflife.com">info@stafflife.com</a> | Postal Address: Postnet Suite 56,
            Private Bag 9976, Sandton, South Africa, 2146
        </div>
    </div>

@stop