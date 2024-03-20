<div data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{ trans_choice('messages.user.folders.sub_folders_count', $folder->sub_folders_count) }}">
    <a href="{{route('user.folders.show', $folder)}}">
        <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" viewBox="0 0 16 16"  fill="{{auth('web')->user()->passbook->folder}}" class="w-4 h-4">
            <path d="M2 3.5A1.5 1.5 0 0 1 3.5 2h2.879a1.5 1.5 0 0 1 1.06.44l1.122 1.12A1.5 1.5 0 0 0 9.62 4H12.5A1.5 1.5 0 0 1 14 5.5v1.401a2.986 2.986 0 0 0-1.5-.401h-9c-.546 0-1.059.146-1.5.401V3.5ZM2 9.5v3A1.5 1.5 0 0 0 3.5 14h9a1.5 1.5 0 0 0 1.5-1.5v-3A1.5 1.5 0 0 0 12.5 8h-9A1.5 1.5 0 0 0 2 9.5Z" />
        </svg>
        <p class="h6 lead text-dark">@if($index) {{$index}}. @endif{{Str::limit($folder->name, 25)}}</p>
    </a>
</div>