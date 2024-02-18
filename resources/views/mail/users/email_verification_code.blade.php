<x-mail::message>
# {{ __('messages.user.emails.email_verification.welcome_note', ['name' => $name]) }}

{{ __('messages.user.emails.email_verification.sub_title') }}

{{ __('messages.user.emails.email_verification.title')}} {{$verification_code}}

{{$body}}

<x-mail::button :url="$url">
{{__('messages.user.emails.email_verification.btn_text')}}
</x-mail::button>

Thanks,<br>
{{ setting('app_name') }}
</x-mail::message>
