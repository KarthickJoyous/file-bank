<x-mail::message>
# {{ __('messages.admin.emails.password_reset_link.welcome_note', ['name' => $name]) }}

{{$body}}

{{__('messages.admin.emails.password_reset_link.ignore_note')}}

<x-mail::button :url="$url">
{{__('messages.admin.emails.password_reset_link.btn_text')}}
</x-mail::button>

Thanks,<br>
{{ setting('app_name') }}
</x-mail::message>