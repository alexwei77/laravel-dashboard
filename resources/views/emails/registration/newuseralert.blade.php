@extends('emails/layouts/default')

@section('content')
<p>Hello StaffLife</p>

<p>This is to inform you that you have a new user registration with the following details</p>
<p>Name: {!! $user->first_name !!} {!! $user->last_name !!}</p>
<p>Email: {!! $user->email !!}</p>
<p>Company Name: {!! $user->companyname !!}</p>
<p>Phone Number: {!! $user->contact_number !!}</p>
<p>Country Code: {!! $user->country !!}</p>

@stop
