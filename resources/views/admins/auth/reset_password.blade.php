@extends('layouts.email.app')

@section('title', __('messages.email.reset_password.title'))

@section('content')

  <div class="pt-4 pb-2">
    <h5 class="card-title text-center pb-0 fs-4">{{__('messages.email.reset_password.note')}}</h5>
    <p class="text-center small">{{__('messages.email.reset_password.sub_note')}}</p>
  </div>

  <form id="resetPassword" class="row g-3 needs-validation" action="{{route('email.reset_password', $token)}}" method="POST" novalidate>
    @csrf
    <div class="col-12">
      <label for="password" class="form-label">{{__('messages.email.reset_password.password')}} *</label>
      <input type="password" name="password" minlength="8" maxlength="25" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="{{__('messages.email.reset_password.password_placeholder')}}" required>
      <div class="invalid-feedback">{{__('messages.email.reset_password.password_invalid_feedback')}}</div>
    </div>

    <div class="col-12">
      <label for="confirmPassword" class="form-label">{{__('messages.email.reset_password.confirm_password')}} *</label>
      <input type="password" name="password_confirmation" minlength="8" maxlength="25" class="form-control @error('password') is-invalid @enderror" id="confirmPassword" placeholder="{{__('messages.email.reset_password.confirm_password_placeholder')}}" required>
      <div class="invalid-feedback">{{__('messages.email.reset_password.confirm_password_invalid_feedback')}}</div>
    </div>
    <div class="col-12">
      <button id="resetPasswordBtn" class="btn btn-primary w-100" type="submit">{{__('messages.email.reset_password.submit_btn')}}</button>
    </div>
    <div class="col-12 mt-0">
      <hr />
      <p class="small mb-0 text-center">
        {{__('messages.email.reset_password.login_note')}}
        <a href="{{route('email.loginForm')}}">
          {{__('messages.email.reset_password.login_btn')}}
        </a>
      </p>
    </div>
  </form>
@endsection

@section('script')
  <script type="text/javascript">
    $("#resetPassword").on("submit", function() {
      var validated = $("#password").val().length >= 8 && $("#confirmPassword").val().length >= 8;
      if(validated) {
        handleBaseFormSubmit("resetPassword", "{{__('messages.email.reset_password.submit_btn_loading_text')}}");
      }
      return validated;
    });
  </script>
@endsection