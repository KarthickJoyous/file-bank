@extends('layouts.user.app')

@section('title', __('messages.user.profile.title'))

@section('breadcrumb') 
<li class="breadcrumb-item active">
	{{__('messages.user.profile.title')}}
</li>
@endsection

@section('content')
<section class="section profile">
	<div class="row">
        {{--<div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img 
              	src="{{auth('web')->user()->avatar ?: asset('assets/placegolders/user/avatar.png')}}" 
              	alt="{{auth('web')->user()->name}}"
              	class="rounded-circle"
              >
              <h2>{{auth('web')->user()->name}}</h2>
              <h3>{{auth('web')->user()->email}}</h3>
              <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

        </div>--}}

        <div class="col-xl-12">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">
                  	{{__('messages.user.profile.overview')}}
                  </button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">
                  	{{__('messages.user.profile.edit_profile')}}
                  </button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">
                  	{{__('messages.user.profile.settings')}}
                  </button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">
                  	{{__('messages.user.profile.change_password')}}
                  </button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-delete-account">
                  	{{__('messages.user.profile.delete_account')}}
                  </button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">{{__('messages.user.profile.about')}}</h5>
                  <p class="small fst-italic">{{auth('web')->user()->about ?? __('messages.user.common.na')}}</p>

                  <h5 class="card-title">{{__('messages.user.profile.details')}}</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">{{__('messages.user.profile.name')}}</div>
                    <div class="col-lg-9 col-md-8">{{auth('web')->user()->name ?? __('messages.user.common.na')}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">{{__('messages.user.profile.mobile')}}</div>
                    <div class="col-lg-9 col-md-8">{{auth('web')->user()->mobile ?? __('messages.user.common.na')}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">{{__('messages.user.profile.email')}}</div>
                    <div class="col-lg-9 col-md-8">{{auth('web')->user()->email ?? __('messages.user.common.na')}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">{{__('messages.user.profile.avatar')}}</div>
                    <div class="col-lg-9 col-md-8">
                    <img 
                        src="{{auth('web')->user()->avatar ?: asset('assets/placegolders/user/avatar.png')}}" 
                        alt="{{auth('web')->user()->name}}"
                        class="img-thumbnail"
                        height="80"
                        width="80"
                      >
                    </div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form method="POST" 
                    class="needs-validation" 
                    id="userUpdateProfileForm" 
                    action="{{route('user.update_profile')}}" 
                    enctype="multipart/form-data"
                    novalidate
                  >
                  	@csrf
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">
                      	{{__('messages.user.profile.avatar')}}
                      </label>
                      <div class="col-md-8 col-lg-9">
                        <img 
                        	src="{{auth('web')->user()->avatar ?: asset('assets/placegolders/user/avatar.png')}}" 
              				    alt="{{auth('web')->user()->name}}"
                          id="avatarPreview" 
                        >
                        <div class="pt-2">
                          {{--<a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>--}}
                          	<input class="form-control @error('avatar') is-invalid @enderror" id="avatar" name="avatar" type="file" accept=".jpg, .jpeg, .png">
                          {{--<a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>--}}
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="name" class="col-md-4 col-lg-3 col-form-label">
                      	{{__('messages.user.profile.name')}} *
                      </label>
                      <div class="col-md-8 col-lg-9">
                        <input name="name"  minlength="3" maxlength="30" type="text" class="form-control @error('avatar') is-invalid @enderror" id="name" value="{{Old('name', auth('web')->user()->name)}}" required>
                        <div class="invalid-feedback">{{__('messages.user.profile.name_invalid_feedback')}}</div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="email" class="col-md-4 col-lg-3 col-form-label">
                      	{{__('messages.user.profile.email')}} *
                      </label>
                      <div class="col-md-8 col-lg-9">
                        <input readonly name="email" maxlength="50" type="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{Old('email', auth('web')->user()->email)}}" required>
                        <div class="invalid-feedback">{{__('messages.user.profile.email_invalid_feedback')}}</div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="mobile" class="col-md-4 col-lg-3 col-form-label">
                      	{{__('messages.user.profile.mobile')}}
                      </label>
                      <div class="col-md-8 col-lg-9">
                        <input name="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" id="mobile" value="{{Old('mobile', auth('web')->user()->mobile)}}">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="about" class="col-md-4 col-lg-3 col-form-label">
                      	{{__('messages.user.profile.about')}}
                      </label>
                      <div class="col-md-8 col-lg-9">
                        <textarea name="about" class="form-control @error('about') is-invalid @enderror" id="about" style="height: 100px">{{Old('about', auth('web')->user()->about)}}</textarea>
                      </div>
                    </div>

                    {{--<div class="row mb-3">
                      <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="twitter" type="text" class="form-control" id="Twitter" value="https://twitter.com/#">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="facebook" type="text" class="form-control" id="Facebook" value="https://facebook.com/#">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Instagram Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="instagram" type="text" class="form-control" id="Instagram" value="https://instagram.com/#">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="linkedin" type="text" class="form-control" id="Linkedin" value="https://linkedin.com/#">
                      </div>
                    </div>--}}
                    
                    <div class="d-flex justify-content-end">
                      <div class="text-center">
                        <button type="submit" class="btn btn-primary" id="userUpdateProfileBtn">{{__('messages.user.profile.save_changes')}}</button>
                      </div>
                    </div>
                  </form>
                  <!-- End Profile Edit Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-settings">

                  <!-- Settings Section -->
                    <div class="row mb-3">
                      <label for="name" class="col-md-4 col-lg-3 col-form-label">
                        {{__('messages.user.profile.tfa_status')}}
                      </label>
                      <div class="col-md-8 col-lg-9">
                        <div class="form-check form-switch">
                          @php
                            $tfa_status = auth('web')->user()->tfa_status;
                          @endphp
                          <input 
                            class="form-check-input"
                            type="checkbox" 
                            id="tfaStatus"
                            value="{{ENABLED}}"
                            {{ $tfa_status ? 'checked' : ''}}
                          >
                          <label class="form-check-label" for="tfaStatus">
                            <span id="tfaStatusBadge" class="badge bg-{{$tfa_status ? 'success' : 'warning'}}">
                            {{$tfa_status ? __('messages.user.common.enabled') : __('messages.user.common.disabled') }}
                          </span>
                        </label>
                        </div>
                      </div>
                    </div>
                    <!-- End settings Section -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form 
                  method="POST" 
                  id="userChangePasswordForm" 
                  action="{{route('user.change_password')}}"
                  class="needs-validation"
                  novalidate
                  >
                    @csrf

                    <div class="row mb-3">
                      <label for="current_password" class="col-md-4 col-lg-3 col-form-label">
                        {{__('messages.user.profile.current_password')}} *
                      </label>
                      <div class="col-md-8 col-lg-9">
                        <input name="current_password" type="password" 
                        class="form-control @if(session('password_error') || $errors->has('current_password')) is-invalid @endif"
                        id="current_password" minlength="8" maxlength="25"
                        required>
                        <div class="invalid-feedback">{{__('messages.user.profile.current_password_invalid_feedback')}}</div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="password" class="col-md-4 col-lg-3 col-form-label">
                        {{__('messages.user.profile.password')}} *
                      </label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" minlength="8" maxlength="25" required>
                        <div class="invalid-feedback">{{__('messages.user.profile.password_invalid_feedback')}}</div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="password_confirmation" class="col-md-4 col-lg-3 col-form-label"> 
                        {{__('messages.user.profile.password_confirmation')}} *
                      </label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password_confirmation" type="password" class="form-control @error('password') is-invalid @enderror" id="password_confirmation" minlength="8" maxlength="25" required>
                        <div class="invalid-feedback">{{__('messages.user.profile.password_confirmation_invalid_feedback')}}</div>
                      </div>
                    </div>

                    <div class="d-flex justify-content-end ">
                      <div class="text-center">
                        <button type="submit" id="userChangePasswordBtn"  class="btn btn-primary">
                          {{__('messages.user.profile.change_password')}}
                        </button>
                      </div>
                    </div>
                  </form>
                  <!-- End Change Password Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-delete-account">
                  <!-- Delete Account Form -->
                  <form 
                  method="POST" 
                  id="userDeleteAccountForm" 
                  action="{{route('user.delete_account')}}"
                  class="needs-validation"
                  novalidate
                  >
                    @csrf
                    @method('delete')

                    <div class="row mb-3">
                      <label for="password" class="col-md-4 col-lg-3 col-form-label">
                        {{__('messages.user.profile.delete_account_password')}} *
                      </label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" 
                        class="form-control @if(session('password_error') || $errors->has('password')) is-invalid @endif"
                        id="deleteAccountPassword" minlength="8" maxlength="25"
                        required>
                        <div class="invalid-feedback">{{__('messages.user.profile.delete_account_password_invalid_feedback')}}</div>
                      </div>
                    </div>
                    <p class="text-danger">{{__('messages.user.profile.delete_account_note')}}</p>
                    <div class="d-flex justify-content-end ">
                      <div class="text-center">
                        <button type="submit" id="userDeleteAccountBtn"  class="btn btn-danger">
                          {{__('messages.user.profile.delete_account')}}
                        </button>
                      </div>
                    </div>
                  </form>
                  <!-- End Delete Account Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
  </div>
</section>
@endsection

@section('script')
  <script type="text/javascript">
    avatar.onchange = e => {
      const[file] = avatar.files;
      if(file) {
        avatarPreview.src = URL.createObjectURL(file);
      }
    }

    $("#userUpdateProfileForm").on('submit', function() {
      var validated = $("#name").val().length >= 3 && $("#email").val();
      if(validated) {
        handleBaseFormSubmit('userUpdateProfile', '{{__("messages.user.profile.update_profile_submit_btn_loading_text")}}')
      }
      return validated;
    });

    $("#userChangePasswordForm").on('submit', function() {
      var validated = $("#current_password").val().length >= 8 && $("#password").val().length >= 8 && $("#password_confirmation").val().length >= 8;
      if(validated) {
        handleBaseFormSubmit('userChangePassword', '{{__("messages.user.profile.change_password_submit_btn_loading_text")}}')
      }
      return validated;
    });

    $("#tfaStatus").on('change', function() {
      $.ajax({
        url: "{{route('user.tfa_status')}}",
        type: 'PUT',
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}",
            'Content-Type': 'application/json',
        },
        data: JSON.stringify({
          "tfa_status": this.checked
        }),
        success: function (response) {
            var type = response.success ? "success" : "error";
            notify(type, response.message);
            var addClass = response.tfa_status ? "bg-success" : "bg-warning";
            var removeClass = response.tfa_status ? "bg-warning" : "bg-success";
            $("#tfaStatusBadge").addClass(addClass).removeClass(removeClass);
            $("#tfaStatusBadge").text(response.formatted_status);
        },
        error: function (error) {
          $("#tfaStatus").prop('checked', !$("#tfaStatus").prop('checked'));
          notify("error", error.responseJSON.message ?? "__('messages.user.profile.tfa_status_updation_failed')");
        }
      });
    });

    $("#userDeleteAccountForm").on('submit', function() {
      var validated = $("#deleteAccountPassword").val().length >= 8;
      if(validated) {
        handleBaseFormSubmit('userDeleteAccount', '{{__("messages.user.profile.delete_account_submit_btn_loading_text")}}')
      }
      return validated;
    });
  </script>
@endsection