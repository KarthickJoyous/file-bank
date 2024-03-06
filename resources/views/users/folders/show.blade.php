@extends('layouts.user.app')

@section('title', __('messages.user.folders.title'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('user.folders.index')}}">{{ __('messages.user.folders.title') }}</a></li>
    <li class="breadcrumb-item active">{{ $folder->name }}</li>
@endsection

@section('content')
@include('users.folders.modal')
@include('users.files.modal')
<section class="section">
    <div class="d-flex justify-content-between">
        <div>
            <p class="h2 mb-3">{{__('messages.user.folders.title')}} ({{$folder->subFolders->count()}})</p>
        </div>
        <div class="d-flex gap-2 justify-content-end">
            <div>
                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#createFolder"><i class="bi bi-patch-plus"></i>&nbsp;{{__('messages.user.folders.create_folder')}}</button>
            </div>
            <div>
                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#updateFolder"><i class="bi bi-pen"></i>&nbsp;{{__('messages.user.folders.update_folder')}}</button>
            </div>
            <div>
                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteFolder"><i class="bi bi-trash3"></i>&nbsp;{{__('messages.user.folders.delete_folder')}}</button>
            </div>
        </div>
	</div>
    <div class="row text-center d-flex">
        @forelse($folder->subFolders as $key => $sub_folder)
            <div class="col-md-3 mb-2">
                <x-folder :folder=$sub_folder :index='$key + 1' />
            </div>
        @empty
            <div class="col-md-12 mb-2">
                <img class="no-data" src="{{asset('placeholders/nodata.png')}}" />
            </div>
        @endforelse
    </div>

    <hr />

    <div class="d-flex justify-content-between">
        <div>
            <p class="h2">{{__('messages.user.folders.files')}} ({{$folder->files->count()}})</p>
        </div>
        <div class="d-flex gap-2 justify-content-end">
            <div>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#uploadFile"><i class="bi bi-cloud-arrow-up"></i>&nbsp;{{__('messages.user.files.upload')}}</button>
            </div>
        </div>
	</div>
    <div class="row text-center d-flex my-5">
        @forelse($folder->files as $file)
            <div class="col-md-3">
                <x-file :file=$file/>
            </div>
        @empty
            <div class="col-md-12 mb-2">
                <img class="no-data" src="{{asset('placeholders/nodata.png')}}" />
            </div>
        @endforelse
    </div>
</section>
@endsection

@section('script')
    @include('users.folders.script')
    @include('users.files.script')
@endsection