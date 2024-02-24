@extends('layouts.user.app')

@section('title', __('messages.user.tfa_login.title'))

@section('content')
<div class="pt-4 pb-2">
  <h5 class="card-title text-center pb-0 fs-4">{{__('messages.user.tfa_login.title')}}</h5>
  <p class="text-center text-danger small">{{__('messages.user.tfa_login.note')}}</p>
</div>

<form id="tfaLoginForm" method="POST" action="{{route('user.tfa_login')}}" class="row g-3 needs-validation" novalidate>
  @csrf
  <input type="hidden" name="__token" value="{{request('__token')}}">
  <input type="hidden" name="remember_me" value="{{request('remember_me')}}">
  <div class="col-12">
    <label for="verification_code" class="form-label">{{__('messages.user.tfa_login.verification_code')}} *</label>
    <input type="text" minlength="6" maxlength="6" id="verification_code" name="verification_code" class="form-control verification_code" placeholder="{{__('messages.user.tfa_login.verification_code_placeholder')}}" required>
    <div class="invalid-feedback">{{__('messages.user.tfa_login.verification_code_invalid_feedback')}}</div>
  </div>

  <div class="col-12">
    <button id="tfaLoginFormBtn" class="btn btn-primary w-100" type="submit">
      {{__('messages.user.tfa_login.submit_btn')}}
    </button>
  </div>
  <div class="col-12 mt-0">
    <hr />
    <p class="small mb-0 text-center">{{__('messages.user.tfa_login.send_verification_code_note')}}
      <a href="{{route('user.tfa_verification_code', request()->only(['__token', 'remember_me']))}}">
        {{__('messages.user.tfa_login.send_verification_code_btn')}}
      </a>
    </p>
  </div>
</form>
@endsection

@section('script')
  <script type="text/javascript">

    $(".verification_code").keypress(function(e) {
      if(e.keyCode == 32) {
        notify("error", "{{__('messages.user.tfa_login.verification_code_space_validation_message')}}");
        return false;
      }
    });

    $("#tfaLoginForm").on("submit", function() {
      var validated = $("#verification_code").val().length == 6;
      if(validated) {
        handleBaseFormSubmit("tfaLoginForm", "{{__('messages.user.tfa_login.submit_btn_loading_text')}}");
      }
      return validated;
    });
  </script>
@endsection