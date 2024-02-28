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
			"register_success" => "Account Created. Verification code send to your email."
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
			"forgot_password" => "Forgot Password ?"
		],

		"forgot_password" => [
			"title" => "Forgot Password",
			"note" => "Email required.",
			"email" => "Email",
			"email_placeholder" => "Enter email",
			"email_invalid_feedback" => "Please enter your email!",
			"submit_btn" => "Send Link",
			"submit_btn_loading_text" => "Sending Link...",
			"send_link_success" => "Link sent to your email.",
			"link_expired" => "Link is expired. New link send to your email.",
			"login_note" => "Already have an account?",
			"login_btn" => "Login"
		],
		
		"reset_password" => [
			"title" => "Reset Password",
			"note" => "Reset Password",
			"sub_note" => "Please enter password & password confirmation",
			"password" => "Password",
			"password_placeholder" => "Enter password",
			"password_invalid_feedback" => "Please enter your password!",
			"confirm_password" => "Confirm Password",
			"confirm_password_placeholder" => "Enter confirm password",
			"confirm_password_invalid_feedback" => "Please enter your confirm password!",
			"submit_btn" => "Reset Password",
			"submit_btn_loading_text" => "Resetting Password...",
			"login_note" => "Already have an account?",
			"login_btn" => "Login",
			"reset_password_failed" => "Reset password failed. Please try again.",
			"reset_password_success" => "Reset password success. Please login to continue."
		],

		"tfa_login" => [
			"title" => "2FA Login",
			"note" => "Verification code required.",
			"verification_code" => "Verification Code",
			"verification_code_placeholder" => "Enter verification code",
			"verification_code_invalid_feedback" => "Please enter your verification code!",
			"submit_btn" => "Verify",
			"submit_btn_loading_text" => "Verifiying...",
			"send_verification_code_note" => "Code not received?",
			"send_verification_code_btn" => "Send verification code",
			"verification_code_send" => "Verifcation code send to your email.",
			"send_verification_code_failed" => "Send verification code failed. (User ID : :user_id | Email : :email)",
			"send_verification_code_success" => "Verification code send.",
			"code_expired" => "Verification code is expired. New code send to your email.",
			"verificaion_failed" => "Verification Failed. Please try again.",
			"verificaion_success" => "Verification Success.",
			"verification_code_space_validation_message" => "Space not allowed in verification code.",
			"forbidden" => "Please login to continue."
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
			"name_invalid_feedback" => "Please enter your name!",
			"email_invalid_feedback" => "Please enter your email!",
			"updation_failed" => "Profile updation failed. Please try again.",
			"updation_success" => "Profile updated.",
			"avatar_updation_failed" => "Avatar updation failed. Please try again.",
			"current_password" => "Current Password",
			"password" => "New Password",
			"password_confirmation" => "Password Confirmation",
			"password_incorrect" => "Current password is incorrect.",
			"password_repeat_error" => "New password can't be same as current password.",
			"change_password_submit_btn_loading_text" => "Changing Password...",
			"current_password_invalid_feedback" => "Please enter your current password.",
			"password_invalid_feedback" => "Please enter the new password.",
			"password_confirmation_invalid_feedback" => "Please enter the password confirmation.",
			"change_password_failed" => "Change password failed. Please try again.",
			"change_password_success" => "Password changed. Please login.",
			"tfa_status" => "Two Factory Authentication",
			"tfa_status_updation_failed" => "Two factory authentication status updation failed. Please try again.",
			"tfa_status_updated" => "Two factory authentication :status.",
			"delete_account_password" => "Password",
			"delete_account_password_invalid_feedback" => "Please enter the password.",
			"delete_account" => "Delete Account",
			"delete_account_submit_btn_loading_text" => "Deleting...",
			"delete_account_note" => "Note : Once you proceed with the deletion of your account, please be aware that all associated data will be permanently lost and cannot be recovered. This includes your profile information, settings, files, and any other data linked to your account.",
			"delete_account_failed" => "Account deletion failed. Please try again.",
			"delete_account_success" => "Account has been deleted.",
		],

		"common" => [
			"na" => "N/A",
			"enabled" => "Enabled",
			"disabled" => "Disabled"
		],

		"errors" => [
			"too_many_attempts" => "Too many attempts. Please wait for a minute and try again."
		],

		"emails" => [
			"email_verification" => [
				"welcome_note" => "Hello :name,",
				"subject" => "Email Verification Code",
				"body" => "{1} This code is valid for the next :count minute. Please use it to complete the email verification process. If you didn't initiate this request, kindly disregard this email. |[2,*] This code is valid for the next :count minutes. Please use it to complete the email verification process. If you didn't initiate this request, kindly disregard this email.",
				"sub_title" => "Here is your email verification code:",
				"title" => "Verification Code: ",
				"btn_text" => "Visit Website"
			],
			
			"email_verified" => [
				"welcome_note" => "Hello :name,",
				"subject" => "Email Verified",
				"body" => "Your email has been successfully verified.",
				"btn_text" => "Visit Website"
			],

			"tfa_verification" => [
				"welcome_note" => "Hello :name,",
				"subject" => "2FA Verification Code",
				"body" => "{1} This code is valid for the next :count minute. Please use it to complete the two factor authentication process. If you didn't initiate this request, kindly disregard this email. |[2,*] This code is valid for the next :count minutes. Please use it to complete the email verification process. If you didn't initiate this request, kindly disregard this email.",
				"sub_title" => "Here is your 2FA verification code:",
				"title" => "Verification Code: ",
				"btn_text" => "Visit Website"
			],

			"password_reset_link" => [
				"welcome_note" => "Hello :name,",
				"subject" => "Password Reset Link",
				"body" => "You're receiving this email because you requested a password reset. To reset your password and regain access to your account, simply click on the link below:",
				"ignore_note" => "If you didn't initiate this request, kindly disregard this email.",
				"btn_text" => "Reset Password"
			],

			"password_reset_success" => [
				"welcome_note" => "Hello :name,",
				"subject" => "Password Reset Success",
				"body" => " Your password has been successfully reset. You can now log in to your account using your new password.",
				"btn_text" => "Visit Website"
			],

			"change_password_success" => [
				"welcome_note" => "Hello :name,",
				"subject" => "Change Password Success",
				"body" => " Your password has been successfully changed. You can now log in to your account using your new password.",
				"btn_text" => "Visit Website"
			],
		]
		],

		"admin" => [
	
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
				"invalid_credentials" => "Invalid Email / Password.",
				"login_success" => "Login Success.",
				"password_space_validation_message" => "Space are not allowed in passwords.",
				"forgot_password" => "Forgot Password ?"
			],
	
			"forgot_password" => [
				"title" => "Forgot Password",
				"note" => "Email required.",
				"email" => "Email",
				"email_placeholder" => "Enter email",
				"email_invalid_feedback" => "Please enter your email!",
				"submit_btn" => "Send Link",
				"submit_btn_loading_text" => "Sending Link...",
				"send_link_success" => "Link sent to your email.",
				"link_expired" => "Link is expired. New link send to your email.",
				"login_note" => "Already have an account?",
				"login_btn" => "Login"
			],
			
			"reset_password" => [
				"title" => "Reset Password",
				"note" => "Reset Password",
				"sub_note" => "Please enter password & password confirmation",
				"password" => "Password",
				"password_placeholder" => "Enter password",
				"password_invalid_feedback" => "Please enter your password!",
				"confirm_password" => "Confirm Password",
				"confirm_password_placeholder" => "Enter confirm password",
				"confirm_password_invalid_feedback" => "Please enter your confirm password!",
				"submit_btn" => "Reset Password",
				"submit_btn_loading_text" => "Resetting Password...",
				"login_note" => "Already have an account?",
				"login_btn" => "Login",
				"reset_password_failed" => "Reset password failed. Please try again.",
				"reset_password_success" => "Reset password success. Please login to continue."
			],
	
			"tfa_login" => [
				"title" => "2FA Login",
				"note" => "Verification code required.",
				"verification_code" => "Verification Code",
				"verification_code_placeholder" => "Enter verification code",
				"verification_code_invalid_feedback" => "Please enter your verification code!",
				"submit_btn" => "Verify",
				"submit_btn_loading_text" => "Verifiying...",
				"send_verification_code_note" => "Code not received?",
				"send_verification_code_btn" => "Send verification code",
				"verification_code_send" => "Verifcation code send to your email.",
				"send_verification_code_failed" => "Send verification code failed. (Admin ID : :user_id | Email : :email)",
				"send_verification_code_success" => "Verification code send.",
				"code_expired" => "Verification code is expired. New code send to your email.",
				"verificaion_failed" => "Verification Failed. Please try again.",
				"verificaion_success" => "Verification Success.",
				"verification_code_space_validation_message" => "Space not allowed in verification code.",
				"forbidden" => "Please login to continue."
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
				"name_invalid_feedback" => "Please enter your name!",
				"email_invalid_feedback" => "Please enter your email!",
				"updation_failed" => "Profile updation failed. Please try again.",
				"updation_success" => "Profile updated.",
				"avatar_updation_failed" => "Avatar updation failed. Please try again.",
				"current_password" => "Current Password",
				"password" => "New Password",
				"password_confirmation" => "Password Confirmation",
				"password_incorrect" => "Current password is incorrect.",
				"password_repeat_error" => "New password can't be same as current password.",
				"change_password_submit_btn_loading_text" => "Changing Password...",
				"current_password_invalid_feedback" => "Please enter your current password.",
				"password_invalid_feedback" => "Please enter the new password.",
				"password_confirmation_invalid_feedback" => "Please enter the password confirmation.",
				"change_password_failed" => "Change password failed. Please try again.",
				"change_password_success" => "Password changed. Please login.",
				"tfa_status" => "Two Factory Authentication",
				"tfa_status_updation_failed" => "Two factory authentication status updation failed. Please try again.",
				"tfa_status_updated" => "Two factory authentication :status."
			],
	
			"common" => [
				"na" => "N/A",
				"enabled" => "Enabled",
				"disabled" => "Disabled"
			],
	
			"errors" => [
				"too_many_attempts" => "Too many attempts. Please wait for a minute and try again."
			],
	
			"emails" => [
	
				"tfa_verification" => [
					"welcome_note" => "Hello :name,",
					"subject" => "2FA Verification Code",
					"body" => "{1} This code is valid for the next :count minute. Please use it to complete the two factor authentication process. If you didn't initiate this request, kindly disregard this email. |[2,*] This code is valid for the next :count minutes. Please use it to complete the email verification process. If you didn't initiate this request, kindly disregard this email.",
					"sub_title" => "Here is your 2FA verification code:",
					"title" => "Verification Code: ",
					"btn_text" => "Visit Website"
				],
	
				"password_reset_link" => [
					"welcome_note" => "Hello :name,",
					"subject" => "Password Reset Link",
					"body" => "You're receiving this email because you requested a password reset. To reset your password and regain access to your account, simply click on the link below:",
					"ignore_note" => "If you didn't initiate this request, kindly disregard this email.",
					"btn_text" => "Reset Password"
				],
	
				"password_reset_success" => [
					"welcome_note" => "Hello :name,",
					"subject" => "Password Reset Success",
					"body" => " Your password has been successfully reset. You can now log in to your account using your new password.",
					"btn_text" => "Visit Website"
				],
	
				"change_password_success" => [
					"welcome_note" => "Hello :name,",
					"subject" => "Change Password Success",
					"body" => " Your password has been successfully changed. You can now log in to your account using your new password.",
					"btn_text" => "Visit Website"
				],
			]
		]
];