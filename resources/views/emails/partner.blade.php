@extends('emails/layouts/default')

@section('content')
    <p>Hello ,</p> 

    <p>We have received a new partnership mail.</p>

    <p>The provided details are:</p>
    <p>Name: {{ $data['contact-name'] }}</p>
    <p>Email: {{ $data['contact-email'] }}</p>
    <p>Phone: {{ $data['contact-phone'] }}</p>
    <p>Company/Individual: {{ $data['optionsRadiosInline'] }}</p>
    <p>Company Name: {{ $data['contact-company-name'] }}</p>
    <p>Website: {{ $data['contact-website'] }}</p>
    <p>Primary Service: {{ $data['contact-primary-service'] }}</p>
    <p>Country: {{ $data['contact-country'] }}</p>
    <p>City: {{ $data['contact-city'] }}</p>
    <p>Message: {{ $data['contact-msg'] }}  </p>

@stop
