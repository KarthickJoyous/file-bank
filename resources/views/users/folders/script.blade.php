<script type="text/javascript">
    $("#folderSearchForm").on('submit', function() {
        var validated = $("#folderSearchBar").val().length;
        if(validated) {
            $("#folderSearchBtn i").remove();
            handleBaseFormSubmit("folderSearch");
        }
        return validated;
    });

    {{--@if(session('create_folder_error') || $errors->has('name') || $errors->has('sub_folder') || $errors->has('description'))
        $(document).ready(function(){
            $('#createFolder').modal('show');
        });
    @endif--}}

    $("#folderCreateForm").on('submit', function() {
        var validated = $("#createFolderText").val().length;
        if(validated) {
            handleBaseFormSubmit("folderCreate", "{{__('messages.user.folders.create_folder_submit_btn_loading_text')}}");
        }
        return validated;
    });

    @if(isset($folder))
        {{--@if(session('update_folder_error') || $errors->has('name') || $errors->has('sub_folder') || $errors->has('description'))
            $(document).ready(function(){
                $('#updateFolder').modal('show');
            });
        @endif--}}

        $("#folderUpdateForm").on('submit', function() {
            var validated = $("#updateFolderText").val().length;
            if(validated) {
                handleBaseFormSubmit("folderUpdate", "{{__('messages.user.folders.update_folder_submit_btn_loading_text')}}");
            }
            return validated;
        });

        $("#folderDeleteForm").on('submit', function() {
            handleBaseFormSubmit("folderDelete", "{{__('messages.user.folders.delete_folder_submit_btn_loading_text')}}");
        });
    @endif
</script>