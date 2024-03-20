<div class="card file-card-width">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <x-file-type :fileType="$file->file_type" />
            <a class="nav-link nav-icon" href="#" data-bs-toggle="modal" data-bs-target="#deleteFileModal" onclick="setDeleteFileModal('{{$file->id}}', '{{$file->name}}')">
                <span class="text-danger"><i class="bi bi-trash-fill"></i></span>
            </a>
        </div>
    </div>
    <div class="card-body">
        @php $file_name = $file->name.'.'.$file->file_type; @endphp
        <h5 class="card-title" title="{{$file_name}}">{{Str::limit($file_name, 15)}}</h5>
        <a href="{{$url ?: $file->url}}" target="_blank">
            @if(in_array($file->file_type, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg']))
                <img src="{{$file->url}}" alt="{{$file->name}}" class="card-img-top file-card-img">
            @else
                <div class="card-img-top file-card-img">
                    <h1 class="text-danger">.{{$file->file_type}}</h1>
                    <h3 class="text-dark">{{ __('messages.user.files.file') }}</h3>
                </div>
            @endif
        </a>
    </div>
</div>