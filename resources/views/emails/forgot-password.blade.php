@extends('emails/layouts/default')

@section('content')
<p>Hello {!! $user->first_name !!} {!! $user->last_name !!},</p>

<p>Please click on the following link to update your password:</p>

<p><a href="{!! $forgotPasswordUrl !!}">{!! $forgotPasswordUrl !!}</a></p>

<p>Best regards,</p>

<p>StaffLife Team</p>
@stop
