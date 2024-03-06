<script type="text/javascript">
	$(".password").keypress(function(e) {
		if(e.keyCode == 32) {
			notify("error", "{{__('messages.user.login.password_space_validation_message')}}");
			return false;
		}
	});

	function notify(type, message) {

		toastr.options = {
		  "closeButton": true,
		  "debug": false,
		  "newestOnTop": false,
		  "progressBar": true,
		  "positionClass": "toast-top-right",
		  "preventDuplicates": true,
		  "onclick": null,
		  "showDuration": "300",
		  "hideDuration": "1000",
		  "timeOut": "5000",
		  "extendedTimeOut": "1000",
		  "showEasing": "swing",
		  "hideEasing": "linear",
		  "showMethod": "fadeIn",
		  "hideMethod": "fadeOut"
		};

		switch(type) {
			case "success":
				toastr.success(message, "{{setting('app_name')}}");
			break;
			default:
				toastr.error(message, "{{setting('app_name')}}");
		}

		return true;
	}

	// Notification
	  @if($errors->any())
	    @foreach($errors->all() as $error)
	      notify("error", "{{$error}}")
	    @endforeach
	  @endif

	  @if(session('error'))
	    notify("error", "{{session('error')}}")
	  @endif

	  @if(session('success'))
	    notify("success", "{{session('success')}}")
	  @endif
	// Notification

	function handleBaseFormSubmit(formId, loadingText) {
		$(`#${formId}Btn`).attr('disabled', true);
		$(`#${formId}Btn`).text(loadingText);
		$(`#${formId}Btn`).append(`<span class="spinner-border spinner-border-sm mx-1" role="status" aria-hidden="true"></span>`);
	}

	function handleBaseFormSubmitBack(formId, btnText) {
		$(`#${formId}Btn`).attr('disabled', false);
		$(`#${formId}Btn`).text(btnText);
	}

	@authorized
		$("body").addClass(localStorage.getItem("isSidebarClosed") == "true" ? 'toggle-sidebar' : '');

		$("#sidebarBtn").on('click', function() {
			localStorage.setItem('isSidebarClosed', localStorage.getItem("isSidebarClosed") == "true" ? "false" : "true");
		});
	@endauthorized
</script>

@yield('script')