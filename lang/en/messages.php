<?php

return [

	"user" => [

		"register" => [
			"title" => "Register",
			"note" => "Create an Account",
			"sub_note" => "Enter your personal details to create account",
			"name" => "Name",
			"name_placeholder" => "Enter name",
			"name_invalid_feedback" => "Please enter your name!",
			"email" => "Email",
			"email_placeholder" => "Enter email",
			"email_invalid_feedback" => "Please enter your email!",
			"password" => "Password",
			"password_placeholder" => "Enter password",
			"password_invalid_feedback" => "Please enter your password!",
			"confirm_password" => "Confirm Password",
			"confirm_password_placeholder" => "Enter confirm password",
			"confirm_password_invalid_feedback" => "Please enter your confirm password!",
			"submit_btn" => "Create Account",
			"submit_btn_loading_text" => "Creating Account...",
			"login_note" => "Already have an account?",
			"login_btn" => "Login",
			"register_failed" => "Create account failed. Please try again.",
			"register_success" => "Account Created."
		],

		"email_verification" => [
			"title" => "Email Verification",
			"note" => "Verify your email to continue.",
			"sub_note" => "Email verification required.",
			"verification_code" => "Verification Code",
			"verification_code_placeholder" => "Enter verification code",
			"verification_code_invalid_feedback" => "Please enter your verification code!",
			"submit_btn" => "Verify",
			"submit_btn_loading_text" => "Verifiying...",
			"cancel_btn" => "Logout",
			"cancel_btn_loading_text" => "Logging Out...",
			"send_verification_code_note" => "Code not received?",
			"send_verification_code_btn" => "Send verification code",
			"verificaion_pending_note" => "Please verify your email to continue.",
			"send_verification_code_failed" => "Send verification code failed. (User ID : :user_id | Email : :email)",
			"send_verification_code_success" => "Verification code send.",
			"code_expired" => "Verification code is expired. New code send to your email.",
			"verificaion_failed" => "Verification Failed. Please try again.",
			"verificaion_success" => "Verification Success.",
			"verification_code_space_validation_message" => "Space not allowed in verification code.",
		],

		"login" => [
			"title" => "Login",
			"note" => "Login to Your Account",
			"sub_note" => "Enter your email & password to login",
			"email" => "Email",
			"email_placeholder" => "Enter email",
			"email_invalid_feedback" => "Please enter your email!",
			"password" => "Password",
			"password_placeholder" => "Enter password",
			"password_invalid_feedback" => "Please enter your password!",
			"remember_me" => "Remember me",
			"submit_btn" => "Login",
			"submit_btn_loading_text" => "Logging In...",
			"register_note" => "Don't have account?",
			"register_btn" => "Create an account",
			"invalid_credentials" => "Invalid Email / Password.",
			"login_success" => "Login Success.",
			"password_space_validation_message" => "Space are not allowed in passwords.",
		],

		"logout" => [
			"title" => "Logout",
			"logout_confirmation" => "Are you sure you want to logout from the current session?",
			"submit_btn_loading_text" => "Logging Out...",
			"logout_success" => "Logout Success.",
			"cancel" => "Cancel"
		],

		"header" => [
			"profile" => "Profile",
			"logout" => "Logout",
		],

		"sidebar" => [
			"home" => "Home",
			"profile" => "Profile",
			"logout" => "Logout",
		],

		"home" => [
			"title" => "Home"
		],

		"profile" => [
			"title" => "Profile",
			"overview" => "Overview",
			"edit_profile" => "Edit Profile",
			"settings" => "Settings",
			"change_password" => "Change Password",
			"about" => "About",
			"details" => "Profile Details",
			"name" => "Name",
			"mobile" => "Mobile",
			"email" => "Email",
			"avatar" => "Avatar",
			"save_changes" => "Save Changes",
			"update_profile_submit_btn_loading_text" => "Saving Changes...",
			"updation_failed" => "Profile updation failed. Please try again.",
			"updation_success" => "Profile updated.",
			"avatar_updation_failed" => "Avatar updation failed. Please try again.",
			"current_password" => "Current Password",
			"password" => "Password",
			"password_confirmation" => "Password Confirmation",
			"password_incorrect" => "Current password is incorrect.",
			"password_repeat_error" => "New password can't be same as current password.",
			"change_password_submit_btn_loading_text" => "Changing Password...",
			"change_password_failed" => "Change password failed. Please try again.",
			"change_password_success" => "Password changed. Please login."
		],

		"common" => [
			"na" => "N/A"
		],

		"errors" => [
			"too_many_attempts" => "Too many attempts. Please wait for a minute and try again."
		],

		"emails" => [
			"email_verification" => [
				"welcome_note" => "Hello :name,",
				"code_for_email_verification_subject" => "Email Verification Code",
				"code_for_email_verification_body" => "{1} This code is valid for the next :count minute. Please use it to complete the email verification process. If you didn't initiate this request, kindly disregard this email. |[2,*] This code is valid for the next :count minutes. Please use it to complete the email verification process. If you didn't initiate this request, kindly disregard this email.",
				"verification_code_preview_sub_title" => "Here is your verification code:",
				"verification_code_preview_title" => "Verification Code: ",
				"btn_text" => "Visit Website"
			]
			
		]
	]
];