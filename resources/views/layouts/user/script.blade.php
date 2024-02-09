<script type="text/javascript">
	$(".password").keypress(function(e) {
		if(e.keyCode == 32) {
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

	function handleBaseFormSubmit(formName, loadingText) {
		$(`#${formName}Btn`).attr('disabled', true);
		$(`#${formName}Btn`).text(loadingText);
	}
</script>

@yield('script')