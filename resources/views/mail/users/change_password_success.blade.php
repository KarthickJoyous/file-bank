<x-mail::message>
# {{ __('messages.user.emails.change_password_success.welcome_note', ['name' => $name]) }}

{{$body}}

<x-mail::button :url="$url">
{{__('messages.user.emails.change_password_success.btn_text')}}
</x-mail::button>

Thanks,<br>
{{ setting('app_name') }}
</x-mail::message>