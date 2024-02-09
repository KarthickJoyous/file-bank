@extends('layouts.user.app')

@section('title', __('messages.user.register.title'))

@section('content')

  <div class="pt-4 pb-2">
    <h5 class="card-title text-center pb-0 fs-4">{{__('messages.user.register.note')}}</h5>
    <p class="text-center small">{{__('messages.user.register.sub_note')}}</p>
  </div>

  <form id="createAccount" class="row g-3 needs-validation" action="{{route('user.register')}}" method="POST" novalidate>
    @csrf
    <div class="col-12">
      <label for="name" class="form-label">{{__('messages.user.register.name')}} *</label>
      <input type="text" name="name" minlength="3" maxlength="30" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="{{__('messages.user.register.name_placeholder')}}" required>
      <div class="invalid-feedback">{{__('messages.user.register.name_invalid_feedback')}}</div>
    </div>

    <div class="col-12">
      <label for="email" class="form-label">{{__('messages.user.register.email')}} *</label>
      <div class="input-group has-validation">
        <span class="input-group-text" id="inputGroupPrepend">@</span>
        <input type="email" maxlength="50" name="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="{{__('messages.user.register.email_placeholder')}}" required>
        <div class="invalid-feedback">{{__('messages.user.register.email_invalid_feedback')}}</div>
      </div>
    </div>

    <div class="col-12">
      <label for="password" class="form-label">{{__('messages.user.register.password')}} *</label>
      <input type="password" name="password" minlength="8" maxlength="25" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="{{__('messages.user.register.password_placeholder')}}" required>
      <div class="invalid-feedback">{{__('messages.user.register.password_invalid_feedback')}}</div>
    </div>

    <div class="col-12">
      <label for="confirmPassword" class="form-label">{{__('messages.user.register.confirm_password')}} *</label>
      <input type="password" name="password_confirmation" minlength="8" maxlength="25" class="form-control @error('password') is-invalid @enderror" id="confirmPassword" placeholder="{{__('messages.user.register.confirm_password_placeholder')}}" required>
      <div class="invalid-feedback">{{__('messages.user.register.confirm_password_invalid_feedback')}}</div>
    </div>

    {{--<div class="col-12">
      <div class="form-check">
        <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
        <label class="form-check-label" for="acceptTerms">I agree and accept the <a href="#">terms and conditions</a></label>
        <div class="invalid-feedback">You must agree before submitting.</div>
      </div>
    </div>--}}
    <div class="col-12">
      <button id="createAccountBtn" class="btn btn-primary w-100" type="submit">{{__('messages.user.register.submit_btn')}}</button>
    </div>
    <div class="col-12">
      <p class="small mb-0">
        {{__('messages.user.register.login_note')}}
        <a href="{{route('user.loginForm')}}">
          {{__('messages.user.register.login_btn')}}
        </a>
      </p>
    </div>
  </form>
@endsection

@section('script')
  <script type="text/javascript">
    $("#createAccount").on("submit", function() {
      if($("#name").val() && $("#email").val() && $("#password").val().length >= 8 && $("#confirmPassword").val().length >= 8) {
        $("#createAccountBtn").attr("disabled", true);
        $("#createAccountBtn").text("{{__('messages.user.register.submit_btn_loading_text')}}");
      }
    });
  </script>
@endsection