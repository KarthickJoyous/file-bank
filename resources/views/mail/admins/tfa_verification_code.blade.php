<x-mail::message>
# {{ __('messages.admin.emails.tfa_verification.welcome_note', ['name' => $name]) }}

{{ __('messages.admin.emails.tfa_verification.sub_title') }}

{{ __('messages.admin.emails.tfa_verification.title')}} {{$verification_code}}

{{$body}}

<x-mail::button :url="$url">
{{__('messages.admin.emails.tfa_verification.btn_text')}}
</x-mail::button>

Thanks,<br>
{{ setting('app_name') }}
</x-mail::message>
