@extends('layouts.admin.app')

@section('title', __('messages.admin.login.title'))

@section('content')
<div class="pt-4 pb-2">
  <h5 class="card-title text-center pb-0 fs-4">{{__('messages.admin.login.note')}}</h5>
  <p class="text-center small">{{__('messages.admin.login.sub_note')}}</p>
</div>

<form id="loginForm" method="POST" action="{{route('admin.login')}}" class="row g-3 needs-validation" novalidate>
  @csrf
  {{--<input type="hidden" name="timezone" id="timezone">--}}
  <div class="col-12">
    <label for="email" class="form-label">{{__('messages.admin.login.email')}} *</label>
    <div class="input-group has-validation">
      <span class="input-group-text" id="inputGroupPrepend">@</span>
      <input type="text" id="email" name="email" maxlength="50" class="form-control" placeholder="{{__('messages.admin.login.email_placeholder')}}" value="{{old('email')}}" required>
      <div class="invalid-feedback">{{__('messages.admin.login.email_invalid_feedback')}}</div>
    </div>
  </div>

  <div class="col-12">
    <label for="password" class="form-label">{{__('messages.admin.login.password')}} *</label>
    <input type="password" id="password"  minlength="8" maxlength="25" name="password" class="form-control password" placeholder="{{__('messages.admin.login.password_placeholder')}}" required>
    <div class="invalid-feedback">{{__('messages.admin.login.password_invalid_feedback')}}</div>
  </div>

  <div class="col-12">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" name="remember_me" value="true" id="rememberMe">
      <label class="form-check-label" for="rememberMe">{{__('messages.admin.login.remember_me')}}</label>
    </div>
  </div>
  <div class="col-12">
    <button id="loginFormBtn" class="btn btn-primary w-100" type="submit">
      {{__('messages.admin.login.submit_btn')}}
    </button>
  </div>
  <div class="col-12">
    <p class="small mb-0 text-center">
      <a href="{{route('admin.forgotPasswordForm')}}">
        {{__('messages.admin.login.forgot_password')}}
      </a>
    </p>
  </div>
</form>
@endsection

@section('script')
  <script type="text/javascript">
    $("#loginForm").on("submit", function() {
      var validated = $("#email").val() && $("#password").val().length >= 8;
      if(validated) {
        handleBaseFormSubmit("loginForm", "{{__('messages.admin.login.submit_btn_loading_text')}}");
      }
      return validated;
    });
  </script>
  {{--
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jstimezonedetect/1.0.7/jstz.min.js'></script>
    <script type="text/javascript">
      var tz = jstz.determine();
      var timezone = tz.name();
      $("#timezone").val(timezone);
    </script>
  --}}
@endsection