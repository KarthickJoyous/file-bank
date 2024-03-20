@extends('layouts.user.app')

@section('title', __('messages.user.files.title'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('user.files.index')}}">{{ __('messages.user.files.title') }}</a></li>
    <li class="breadcrumb-item active">{{ $file->name }}.{{ $file->file_type }}</li>
@endsection

@section('content')
@include('users.files.modal')
<section class="section">
    <p class="h2 my-4">{{__('messages.user.files.file')}}</p>
    <div class="row text-center d-flex my-5">
        <div class="col-md-3">
            <x-file :file=$file/>
        </div>
    </div>
</section>
@endsection

@section('script')
@include('users.files.script')
@endsection