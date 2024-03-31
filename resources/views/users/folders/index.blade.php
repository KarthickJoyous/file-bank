@extends('layouts.user.app')

@section('title', __('messages.user.folders.title'))

@section('breadcrumb')
    <li class="breadcrumb-item active">{{ __('messages.user.folders.title') }}</li> &nbsp; ({{$folders->total()}})
@endsection

@section('content')
@include('users.folders.modal')
<section class="section">
	@if(request('search'))
		<p class="h6 mb-3 text-danger">{{trans_choice('messages.user.folders.search_result_for', $folders->total(), ["search" => request('search')])}}</p>
	@endif
	<div class="d-flex justify-content-between">
		<div>
			<button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#createFolder"><i class="bi bi-patch-plus"></i>&nbsp;{{__('messages.user.folders.create_folder')}}</button>
			@if($folders->isNotEmpty())
				<button onclick="setFolderColor('{{auth('web')->user()->passbook->folder}}')" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#setFolderColor"><i class="bi bi-palette-fill"></i>&nbsp;{{__('messages.user.folders.folder_color')}}</button>
			@endif
		</div>
		<div>
			<form action="{{route('user.folders.index')}}" id="folderSearchForm">
				<div class="d-flex gap-2 justify-content-end">
					<div class="mb-5">
						{{--<label for="folderSearchBar" class="form-label">{{ __('messages.user.folders.search') }}</label>--}}
						<div class="input-group">
							<input type="text" name="search" value="{{request('search')}}" placeholder="{{ __('messages.user.folders.search_placeholder') }}" class="form-control" id="folderSearchBar" aria-describedby="folderSearchInput" required="">
						</div>
					</div>
					<div>
						<button id="folderSearchBtn" type="submit" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{ __('messages.user.folders.search') }}"><i class="bi bi-search"></i></button>
					</div>
					<div>
						<a class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{ __('messages.user.folders.clear') }}" href="{{route('user.folders.index')}}"><i class="bi bi-x-lg"></i></a>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="row text-center d-flex">
		@forelse($folders as $key => $folder)
		<div class="col-md-3 mb-2">
			<x-folder :folder=$folder :index='$folders->firstItem() + $key'/>
		</div>
		@empty
		<div class="col-md-12 mb-2">
			<img class="no-data" src="{{asset('placeholders/nodata.png')}}" />
		</div>
		@endforelse
	</div>
	@if($folders->hasPages())
		<nav aria-label="Page navigation example">
			<ul class="pagination justify-content-end">
				{{$folders->withQueryString()->links('pagination::bootstrap-4')}}
			</ul>
		</nav>
	@endif
</section>
@endsection

@section('script')
	@include('users.folders.script')
@endsection