<x-mail::message>
# {{ __('messages.admin.emails.password_reset_success.welcome_note', ['name' => $name]) }}

{{$body}}

<x-mail::button :url="$url">
{{__('messages.admin.emails.password_reset_success.btn_text')}}
</x-mail::button>

Thanks,<br>
{{ setting('app_name') }}
</x-mail::message>