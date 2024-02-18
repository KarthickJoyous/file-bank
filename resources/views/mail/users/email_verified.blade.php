<x-mail::message>
# {{ __('messages.user.emails.email_verified.welcome_note', ['name' => $name]) }}

{{$body}}

<x-mail::button :url="$url">
{{__('messages.user.emails.email_verified.btn_text')}}
</x-mail::button>

Thanks,<br>
{{ setting('app_name') }}
</x-mail::message>
