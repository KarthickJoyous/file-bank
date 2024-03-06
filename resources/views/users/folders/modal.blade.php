<div class="modal fade" id="createFolder" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"><i class="bi bi-patch-plus"></i>&nbsp; {{__('messages.user.folders.create_folder')}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="folderCreateForm" method="POST" action="{{route('user.folders.store')}}">
        @csrf
            <input type="hidden" name="sub_folder" value="{{$folder->id ?? null}}">
            <div class="modal-body">
                <label class="form-label mb-2" for="createFolderText">{{__('messages.user.folders.name')}} *</label>
                <input class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" placeholder="{{__('messages.user.folders.name_placeholder')}}" id="createFolderText" type="text" minlength="1" maxlength="25" name="name" required/>
                <label class="form-label my-2" for="createFolderDescription">{{__('messages.user.folders.description')}}</label>
                <textarea class="form-control @error('description') is-invalid @enderror" placeholder="{{__('messages.user.folders.name_placeholder')}}" id="createFolderDescription" minlength="1" maxlength="255" name="description">{{old('description')}}</textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">{{__('messages.user.folders.cancel')}}</button>
                <button type="submit" id="folderCreateBtn" class="btn btn-warning">{{__('messages.user.folders.submit')}}</button>
            </div>
        </form>
        </div>
    </div>
</div>

@if(isset($folder))
<div class="modal fade" id="updateFolder" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"><i class="bi bi-pen"></i> &nbsp; {{__('messages.user.folders.update', ['name' => $folder->name])}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="folderUpdateForm" method="POST" action="{{route('user.folders.update', $folder)}}">
        @csrf
        @method('put')
            <div class="modal-body">
                <label class="form-label mb-2" for="updateFolderText">{{__('messages.user.folders.name')}} *</label>
                <input class="form-control @error('name') is-invalid @enderror" value="{{old('name', $folder->name)}}" placeholder="{{__('messages.user.folders.name_placeholder')}}" id="updateFolderText" type="text" minlength="1" maxlength="25" name="name" required/>
                <label class="form-label my-2" for="updateFolderDescription">{{__('messages.user.folders.description')}}</label>
                <textarea class="form-control @error('description') is-invalid @enderror" placeholder="{{__('messages.user.folders.name_placeholder')}}" id="updateFolderDescription" minlength="1" maxlength="255" name="description">{{old('description', $folder->description)}}</textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">{{__('messages.user.folders.cancel')}}</button>
                <button type="submit" id="folderUpdateBtn" class="btn btn-info">{{__('messages.user.folders.submit')}}</button>
            </div>
        </form>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteFolder" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"><i class="bi bi-trash3"></i> &nbsp; {{__('messages.user.folders.delete', ['name' => $folder->name])}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="folderDeleteForm" method="POST" action="{{route('user.folders.destroy', $folder)}}">
        @csrf
        @method('delete')
            <div class="modal-body">
                <span class="text-danger"><i class="bi bi-exclamation-triangle text-danger"></i> {{__('messages.user.folders.delete_folder_note', ['name' => $folder->name])}}</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">{{__('messages.user.folders.cancel')}}</button>
                <button type="submit" id="folderDeleteBtn" class="btn btn-danger">{{__('messages.user.folders.submit')}}</button>
            </div>
        </form>
        </div>
    </div>
</div>
@endif