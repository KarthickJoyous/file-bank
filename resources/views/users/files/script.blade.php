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
                notify("success", "{{__('messages.user.files.file_upload_success')}}");
                location.reload();
            });

            this.on("errormultiple", function(files, response) {
                notify("error", "{{__('messages.user.files.file_upload_failed')}}");
                location.reload();
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
</script>