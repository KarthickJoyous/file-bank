@extends('layouts.user.app')

@section('title', __('messages.user.email_verification.title'))

@section('content')
<div class="pt-4 pb-2">
  <h5 class="card-title text-center pb-0 fs-4">{{__('messages.user.email_verification.note')}}</h5>
  <p class="text-center text-danger small">{{__('messages.user.email_verification.sub_note')}}</p>
</div>

<form id="verifyEmailForm" method="POST" action="{{route('user.verify_email')}}" class="row g-3 needs-validation" novalidate>
  @csrf
  <div class="col-12">
    <label for="verification_code" class="form-label">{{__('messages.user.email_verification.verification_code')}} *</label>
    <input type="text" minlength="6" maxlength="6" id="verification_code" name="verification_code" class="form-control verification_code" placeholder="{{__('messages.user.email_verification.verification_code_placeholder')}}" required>
    <div class="invalid-feedback">{{__('messages.user.email_verification.verification_code_invalid_feedback')}}</div>
  </div>

  <div class="col-12">
    <button id="verifyEmailFormBtn" class="btn btn-primary w-100" type="submit">
      {{__('messages.user.email_verification.submit_btn')}}
    </button>
  </div>
  <div class="col-12">
    <button
    id="verifyEmailLogoutBtn"
    type="button"
    class="btn btn-danger w-100"
    onclick="
      document.getElementById('logoutForm').submit(); 
      handleBaseFormSubmit('verifyEmailLogout', `{{__("messages.user.email_verification.cancel_btn_loading_text")}}`);
    ">
      {{__('messages.user.email_verification.cancel_btn')}}
    </button>
  </div>
  <div class="col-12 mt-0">
    <hr />
    <p class="small mb-0 text-center">{{__('messages.user.email_verification.send_verification_code_note')}}
      <a href="{{route('user.email_verification_code')}}">
        {{__('messages.user.email_verification.send_verification_code_btn')}}
      </a>
    </p>
  </div>
</form>

<form class="d-none" method="GET" id="logoutForm" action="{{route('user.logout')}}">
  @csrf
</form>
@endsection

@section('script')
  <script type="text/javascript">

    $(".verification_code").keypress(function(e) {
      if(e.keyCode == 32) {
        notify("error", "{{__('messages.user.email_verification.verification_code_space_validation_message')}}");
        return false;
      }
    });

    $("#verifyEmailForm").on("submit", function() {
      var validated = $("#verification_code").val().length == 6;
      if(validated) {
        handleBaseFormSubmit("verifyEmailForm", "{{__('messages.user.email_verification.submit_btn_loading_text')}}");
      }
      return validated;
    });
  </script>
@endsection