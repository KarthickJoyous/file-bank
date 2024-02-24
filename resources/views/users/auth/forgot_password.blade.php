@extends('layouts.user.app')

@section('title', __('messages.user.forgot_password.title'))

@section('content')
<div class="pt-4 pb-2">
  <h5 class="card-title text-center pb-0 fs-4">{{__('messages.user.forgot_password.title')}}</h5>
  <p class="text-center text-danger small">{{__('messages.user.forgot_password.note')}}</p>
</div>

<form id="forgotPassword" method="POST" action="{{route('user.forgot_password')}}" class="row g-3 needs-validation" novalidate>
  @csrf
  <div class="col-12">
    <label for="email" class="form-label">{{__('messages.user.forgot_password.email')}} *</label>
    <input type="email" id="email" name="email" class="form-control" placeholder="{{__('messages.user.forgot_password.email_placeholder')}}" required>
    <div class="invalid-feedback">{{__('messages.user.forgot_password.email_invalid_feedback')}}</div>
  </div>

  <div class="col-12">
    <button id="forgotPasswordBtn" class="btn btn-primary w-100" type="submit">
      {{__('messages.user.forgot_password.submit_btn')}}
    </button>
  </div>
  <div class="col-12 mt-0">
    <hr />
    <p class="small mb-0 text-center">{{__('messages.user.forgot_password.login_note')}}
      <a href="{{route('user.loginForm')}}">
        {{__('messages.user.forgot_password.login_btn')}}
      </a>
    </p>
  </div>
</form>
@endsection

@section('script')
  <script type="text/javascript">

    $("#forgotPassword").on("submit", function() {
        var validated = validateEmail($("#email").val());
        if(validated) {
            handleBaseFormSubmit("forgotPassword", "{{__('messages.user.forgot_password.submit_btn_loading_text')}}");
        }
        return validated;
    });

    function validateEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/; 
        return regex.test(email);
    }
  </script>
@endsection