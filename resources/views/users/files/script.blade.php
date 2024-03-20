<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<script type="text/javascript">
    $("#fileSearchForm").on('submit', function() {
        var validated = $("#fileSearchBar").val().length;
        if(validated) {
            $("#fileSearchBtn i").remove();
            handleBaseFormSubmit("fileSearch");
        }
        return validated;
    });

    Dropzone.options.uploadFileForm = {

        addRemoveLinks: true,
        autoProcessQueue: false,
        uploadMultiple: true,
        parallelUploads: 10,
        maxFiles: 10,

        init: function() {
            var myDropzone = this;

            this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
                e.preventDefault();
                e.stopPropagation();
                if(myDropzone.files.length) {
                    handleBaseFormSubmit("uploadFile", "{{__('messages.user.files.upload_file_submit_btn_loading_text')}}");
                    myDropzone.processQueue();
                }else{
                    notify("error", "{{__('messages.user.files.files_required')}}");
                    return false;
                }
            });

            {{--
                this.on("addedfile", file => {
                    var inputElement = document.createElement("input");
                    inputElement.setAttribute("type", "text");
                    inputElement.setAttribute("class", "form-control");
                    inputElement.setAttribute("name", "name");
                    inputElement.setAttribute("minlength", 1);
                    inputElement.setAttribute("maxlength", 25);
                    inputElement.setAttribute("placeholder", "{{__('messages.user.files.name_placeholder')}}");
                    file.previewElement.appendChild(inputElement);
                });

                this.on("sendingmultiple", function(file, xhr, formData) {
                    var data = $('#uploadFileForm').serializeArray();
                    $.each(data, function(key, el) {
                        formData.append(el.name, el.value);
                    });
                });
            --}}

            this.on("successmultiple", function(files, response) {
                notify(response.success ? "success" : "error", response.message);
                setTimeout(() => {
                    if(response.success) {
                        $(location).prop('href', response.redirect_to);
                    } else {
                        location.reload();
                    }
                }, 1500);
            });

            this.on("errormultiple", function(files, response) {
                notify("error", "{{__('messages.user.files.file_upload_failed')}}");
                setTimeout(() => {
                    location.reload();
                }, 1500);
            });
        }
    }

    {{--
        Dropzone.options.uploadFileForm = {
            autoProcessQueue: false,
            addRemoveLinks: true,
            "maxFiles": 1,
            
            init: function () {
                var myDropzone = this;

                $("#uploadFileBtn").click(function (e) {
                    e.preventDefault();
                    myDropzone.processQueue();
                });

                this.on('sending', function(file, xhr, formData) {
                    var data = $('#uploadFileForm').serializeArray();
                    $.each(data, function(key, el) {
                        formData.append(el.name, el.value);
                    });
                });

                this.on('sending', function(file, xhr, formData) {
                    var data = $('#uploadFileForm').serializeArray();
                    $.each(data, function(key, el) {
                        formData.append(el.name, el.value);
                    });
                });
            }
        }

        @if(session('file_upload_error') || $errors->has('file_name') || $errors->has('sub_folder') || $errors->has('file'))
            $(document).ready(function(){
                $('#uploadFile').modal('show');
            });
        @endif
    --}}

    function setDeleteFileModal(fileId, fileName) {
        $("#fileId").val(fileId);
        var note = "{{ __('messages.user.files.delete_file_note', ['name' => 'setDeleteFileModalfileName']) }}";
        $("#deleteFileModalNote").text(note.replace("setDeleteFileModalfileName", fileName));
    }

    function deleteFile() {

        handleBaseFormSubmit("deleteFileSubmit", "{{__('messages.user.files.delete_file_submit_btn_loading_text')}}");

        var route = "{{route('user.files.destroy', 'fileId')}}";

        var form = $('<form>', {
            'method': 'POST', 
            'action': route.replace("fileId", $("#fileId").val()),
            'style': 'display:none;'
        });

        var method = $('<input>', {
            'name': '_method',
            'type': 'hidden',
            'value': 'DELETE'
        });

        var csrfToken = $('<input>', {
            'name': '_token',
            'type': 'hidden',
            'value': '{{csrf_token()}}'
        });

        form.append(method, csrfToken);

        $('body').append(form);

        form.submit();
    }

</script>