@extends('emails/layouts/default')

@section('content')
<p>Hello {!! $user->first_name !!},</p>

<p>Welcome to @lang('general.site_name')! Please click on the following link to confirm your @lang('general.site_name') account:</p>

<p><a href="{!! $activationUrl !!}">{!! $activationUrl !!}</a></p>

<p>Best regards,</p>

<p>@lang('general.site_name') Team</p>
@stop
