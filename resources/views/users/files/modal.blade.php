@section('link')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endsection
<div class="modal fade" id="uploadFile" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <form id="uploadFileForm" class="dropzone" method="POST" action="{{route('user.files.store')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="folder_id" value="{{$folder->id ?? null}}">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-cloud-arrow-up"></i>&nbsp; {{__('messages.user.files.upload_file')}}</h5>
                    <button type="button" class="h1 btn-close cursor-pointer" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                {{--
                    <div class="modal-body">
                        <p class="text-danger"><i class="bi bi-brightness-high"></i>&nbsp; : {{__('messages.user.files.upload_file_note')}}</p>
                        <label class="form-label mb-2" for="uploadFileText">{{__('messages.user.files.name')}}</label>
                        <input class="form-control @error('file_name') is-invalid @enderror" value="{{old('file_name')}}" placeholder="{{__('messages.user.files.name_placeholder')}}" id="uploadFileText" type="text" minlength="1" maxlength="25" name="name" />
                        <label class="form-label mt-2" for="uploadFileInput">{{__('messages.user.files.file')}} *</label>
                        <input class="form-control @error('file') is-invalid @enderror" type="file" name="file" id="uploadFileInput" required>
                    </div>
                --}}
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary cursor-pointer" data-bs-dismiss="modal">{{__('messages.user.files.cancel')}}</button>
                    <button type="submit" id="uploadFileBtn" class="btn btn-success cursor-pointer">{{__('messages.user.files.submit')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>