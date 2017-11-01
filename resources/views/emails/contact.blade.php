@extends('emails/layouts/default')

@section('content')
    <p>Hello ,</p>

    <p>We have received a new contact mail.</p>

    <p>The provided details are:</p>

    <p>Name: {{ $data['contact-name'] }}</p>

    <p>Email: {{ $data['contact-email'] }}</p>

    <p>Phone: {{ $data['contact-tel'] }}</p>

    <p>Message: {{ $data['contact-msg'] }}  </p>

@stop
