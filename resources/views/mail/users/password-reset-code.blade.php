<x-mail::message>
# {{ __('messages.user.emails.password_reset_code.welcome_note', ['name' => $name]) }}

{{$body}}

{{ __('messages.user.emails.password_reset_code.title')}} {{$verification_code}}

<x-mail::button :url="$url">
{{__('messages.user.emails.password_reset_code.btn_text')}}
</x-mail::button>

Thanks,<br>
{{ setting('app_name') }}
</x-mail::message>
